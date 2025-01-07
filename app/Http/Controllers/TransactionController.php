<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ContactMethod;
use App\Models\PaymentMethod;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AssetsService;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PaymentService;
use App\Http\Services\TransactionService;
use App\Http\Controllers\SupportController;
use App\Http\Requests\StroreTransactionRequest;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $paymentService;

    protected $supportController;
    /**
     * injection services
     * @param \App\Http\Services\TransactionService $transactionService
     * @param \App\Http\Services\PaymentService $paymentService
     */
    public function __construct(TransactionService $transactionService, PaymentService $paymentService, SupportController $supportController)
    {
        $this->transactionService = $transactionService;
        $this->paymentService = $paymentService;
        $this->supportController = $supportController;
    }

    /**
     * Display the transaction creation form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createTransaction()
    {
        $cities = City::all(); // Fetch all cities
        $contactMethods = ContactMethod::all(); // Fetch all contact methods
        $transaction_types = TransactionType::all();
        $payment_methods = PaymentMethod::all();

        return view('pages.transaction', compact('cities', 'contactMethods', 'transaction_types', 'payment_methods'));
    }

    /**
     * Display user transactions page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getViewTransaction($id)
    {
        $transactions = Transaction::where('user_id', $id)->get();

        return view('pages.userTransaction', compact('transactions'));
    }

    public function getusersTransaction()
    {
        $transactions = Transaction::all();
        return view('pages.admin', compact('transactions'));
    }

    public function updateTransaction(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $data['transaction_status'] = $request->transaction_status ?? $transaction->transaction_status;
        $data['note'] = $request->note ?? $transaction->note;
        $transaction->update($data);

        $this->supportController->sendUserTransactionMessage($transaction);

        return redirect()->route('admin');
    }
    /**
     *  Store a newly created transaction in the database.
     * @param \App\Http\Requests\StroreTransactionRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(StroreTransactionRequest $request)
    {
        $trasaction_data = $request->validated();

        try {
            DB::beginTransaction();
            log::info('start transaction');
            $this->paymentService->processPayment($request->amount, 'usd', $request->stripeToken, 'Transaction fee');
            $transaction = $this->transactionService->createTransaction($trasaction_data);
            $this->transactionService->handleAttachments($request->file('required_documents'), $transaction->id);
            $this->transactionService->handleAttachments($request->file('property_images'), $transaction->id);
            DB::commit();
            return response()->json(['success' => true , 'transaction' => $transaction])->header('Content-Type', 'application/json');
        } catch (\Stripe\Exception\CardException $e) {
            DB::rollBack();
            Log::error('Stripe error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'خطأ في البطاقة: ' . $e->getMessage()], 400);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in transaction: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء معالجة الطلب.'], 500);
        }
    }
}
