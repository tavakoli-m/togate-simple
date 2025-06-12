<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SettlementJob;
use App\Models\Payment\Payment;
use App\Services\TronService;
use Illuminate\Support\Facades\Http;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="ToGate Api Doc",
 * )
 * @OA\PathItem(path="/api")
 */
class PaymentFormController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/start.json/{token}",
     *     summary="start payment",
     *     @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function start(Payment $payment)
    {
        if ($payment->expired_at < now() || $payment->status !== 1) {
            return response()->json([
                'msg' => 'payment not found !!'
            ]);
        }

        return view('payment.start', compact('payment'));
    }

    public function check(Payment $payment, TronService $tronService)
    {
        if ($payment->expired_at < now() || $payment->status !== 1) {
            return response()->json([
                'msg' => 'payment not found !!'
            ]);
        }

        // $wallet = Http::get('http://localhost:3000/check-balance/' . $payment->wallet_address);
        $wallet = $tronService->getTrxBalance($payment->wallet_address);

        if ($wallet >= $payment->amount) {

            $payment->update([
                'status' => 4
            ]);

            $gateway = $payment->gateway;

            // Payer
            if ($payment->fee_method === 1) {
                $gateway->update([
                    'current_balance' => (float)$gateway->current_balance + (float)((float)$payment->amount - (float)$payment->fee_amount),
                    'fee_amount' => $gateway->fee_amount + $payment->fee_amount,
                ]);
            }
            // Acceptor
            if ($payment->fee_method === 2) {
                $gateway->update([
                    'current_balance' => (float)$gateway->current_balance + (float)((float)$payment->amount - (float)$payment->fee_amount),
                    'fee_amount' => $gateway->fee_amount + $payment->fee_amount,
                ]);
            }

            if ($gateway->current_balance >= $gateway->min_settlement) {
                SettlementJob::dispatch($gateway);
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

    /**
     * @OA\Get(
     *     path="/api/status.json/{token}",
     *     summary="check payment",
     *     @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function status(Payment $payment)
    {
        if ($payment->status == 4 || $payment->status == 2) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
