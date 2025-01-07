<?php

namespace App\Http\Services;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function processPayment($amount, $currency, $token, $description)
    {
        try {
            Stripe::setApiKey('sk_test_51ONXM0DCnvSZulvv1v6Sp2LH8mPYzbgkE1sV3ECayqErl3s9pvJvDXGQzZP2tcX1zwhAb1HAmtrI2YLuneio2J6R004uiEGOSU');

            return Charge::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => $currency,
                'source' => $token,
                'description' => $description,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            Log::error('البطاقة مرفوضة: ' . $e->getMessage());
            throw new Exception('البطاقة مرفوضة ');
        } catch (Exception $e) {
            Log::error('حدث خطأ أثناء معالجة الدفع: ' . $e->getMessage());
            throw new Exception('حدث خطأ أثناء معالجة الدفع ');
        }
    }
}
