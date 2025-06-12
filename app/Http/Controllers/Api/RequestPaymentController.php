<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RequestPaymentRequest;
use App\Jobs\MonitorPendingPayment;
use App\Models\Payment\Gateway;
use App\Models\Payment\Payment;
use Exception;
use Illuminate\Support\Facades\Http;


class RequestPaymentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/request.json",
     *     summary="Request Payment",
     *          @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="api_key",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="amount",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="callback_url",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          )
     *      )
     * )
     */
    public function __invoke(RequestPaymentRequest $request)
    {
        $api_token = $request->input('api_key');

        $gateWay = Gateway::whereApiKey($api_token)->first();

        if ($gateWay && $gateWay->status === 1 && $gateWay->user->status === 2) {
            try {
                $wallet = Http::post('http://localhost:3000/create-wallet');

                $trxPrice = Http::get('https://api.wallex.ir/v1/markets')->json('result')['symbols']['TRXTMN']['stats']['lastPrice'];
            } catch (Exception $e) {
                return response()->json([
                    'msg' => 'server is busy, try agin !!'
                ], 500);
            }

            $amount = $request->input('amount');

            $payment_amount =  $amount / $trxPrice;

            $fee = 0.5;

            $payment_fee = $payment_amount * $fee;

            // Fee For Payer
            if ($gateWay->fee_method === 1) {
                $payment = Payment::create([
                    'gateway_id' => $gateWay->id,
                    'token' => str()->random(65),
                    'fee_method' => 1,
                    'amount' => (float)$payment_amount + (float)$payment_fee,
                    'fee_amount' => $payment_fee,
                    'expired_at' => now()->addMinutes(15),
                    'wallet_key' => $wallet->json('privateKey'),
                    'wallet_address' => $wallet->json('address'),
                    'callback_url' => $request->input('callback_url'),
                    'description' => $request->input('description')
                ]);
            } else {
                $payment = Payment::create([
                    'gateway_id' => $gateWay->id,
                    'token' => str()->random(65),
                    'fee_method' => 2,
                    'amount' => (float)$payment_amount,
                    'fee_amount' => $payment_fee,
                    'expired_at' => now()->addMinutes(15),
                    'wallet_key' => $wallet->json('privateKey'),
                    'wallet_address' => $wallet->json('address'),
                    'callback_url' => $request->input('callback_url'),
                    'description' => $request->input('description')
                ]);
            }

            MonitorPendingPayment::dispatch($payment)->delay(now()->addMinutes(15));

            return response()->json([
                'success' => true,
                'token' => $payment->token
            ]);
        }

        return response()->json([
            "msg" => 'api key not correct !!'
        ], 401);
    }
}
