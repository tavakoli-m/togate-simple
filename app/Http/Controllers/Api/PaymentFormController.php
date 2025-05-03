<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SettlementJob;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentFormController extends Controller
{
    public function start(Payment $payment)
    {
        if($payment->expired_at < now() || $payment->status !== 1){
            return response()->json([
                'msg' => 'payment not found !!'
            ]);
        }

        return view('payment.start',compact('payment'));
    }

    public function check(Payment $payment){
        if($payment->expired_at < now() || $payment->status !== 1){
            return response()->json([
                'msg' => 'payment not found !!'
            ]);
        }

        $wallet = Http::get('http://localhost:3000/check-balance/' . $payment->wallet_address);

        if($wallet->json('balance') >= $payment->amount){

            $payment->update([
                'status' => 4
            ]);

            $gateway = $payment->gateway;

            // Payer
            if($payment->fee_method === 1)
            {
                $gateway->update([
                    'current_balance' => (float)$gateway->current_balance + (float)((float)$payment->amount - (float)$payment->fee_amount),
                    'fee_amount' => $gateway->fee_amount + $payment->fee_amount,
                ]);
            }
            // Acceptor
            if($payment->fee_method === 2)
            {
                $gateway->update([
                    'current_balance' => (float)$gateway->current_balance + (float)((float)$payment->amount - (float)$payment->fee_amount),
                    'fee_amount' => $gateway->fee_amount + $payment->fee_amount,
                ]);
            }

            return response()->json([
                'success' => true,
                'call_back_url' => $payment->callback_url . '?token=' . $payment->token
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
