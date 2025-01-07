<?PHP
namespace App\Http\Services;

use Exception;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionService{
    protected $assetsService;

    public function __construct(AssetsService $assetsService)
    {
        $this->assetsService = $assetsService;
    }

    public function createTransaction($data)
    {
        try {
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'city_id' => $data['city_id'],
            'contact_method_id' => $data['contact_method_id'],
            'payment_method_id' => $data['payment_method_id'],
            'transaction_type_id' => $data['transaction_type_id'],
            'cost' => $data['cost'],
            'description' => $data['description'],
            'contact_info' => $data['contact_info'],
            'property_area' => $data['property_area'],
            'property_rooms' => $data['property_rooms'],
            'property_status' => $data['property_status'],
            'property_address' => $data['property_address'],
            'transaction_status' => 'معلقة'
        ]);
       log::info($transaction);
       return $transaction;
    } catch (Exception $e) {
        log::error('Errorprocessing transaction: ' . $e->getMessage());
        return null;
    }
    }

    public function handleAttachments($files, $transactionId)
    {
        $attachments = [];

        if ($files) {
            foreach ($files as $file) {
                try {
                    $attachment = $this->assetsService->storeAttachment($file, $transactionId);
                    $attachments[] = $attachment['attachment'];
                } catch (Exception $e) {
                    Log::error("خطأ في رفع الملف: {$e->getMessage()}");
                    throw new Exception("خطأ في رفع الملف");
                }
            }
        }
        return $attachments;
    }
}
