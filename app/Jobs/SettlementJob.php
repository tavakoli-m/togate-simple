<?php

namespace App\Jobs;

use App\Models\Payment\Gateway;
use App\Models\Payment\Settlement;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SettlementJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Gateway $gateway
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payments = $this->gateway->payments()->where('status',4)->get();
        $gateway = $this->gateway;

        $site_wallet = 'TJUcSwY37FyY3vB1UkSKcsbkZytTUh3Yx8';

        foreach($payments as $payment){
            try{
                DB::beginTransaction();

                $payment->update([
                    'status' => 2
                ]);

                // Payer
                if($payment->fee_method === 1)
                {
                    $send_to_customer = Http::post('http://127.0.0.1:3000/send-tron',[
                        'privateKey' => $payment->wallet_key,
                        'toAddress' => $gateway->settlement_address,
                        'amount' => (float)$payment->amount - (float)$payment->fee_amount,
                        'senderAddress' => $payment->wallet_address
                    ]);

                    $send_to_site = Http::post('http://127.0.0.1:3000/send-tron',[
                        'privateKey' => $payment->wallet_key,
                        'toAddress' => $site_wallet,
                        'amount' => $payment->fee_amount,
                        'senderAddress' => $payment->wallet_address
                    ]);

                    $gateway->update([
                        'fee_amount' => (float)$gateway->fee_amount - (float)$payment->fee_amount,
                        'current_balance' => (float)$gateway->current_balance - ((float)$payment->amount - $payment->fee_amount),
                    ]);

                    $send_to_customer_settelement = Settlement::create([
                        'settlement_address' => $gateway->settlement_address,
                        'gateway_id' => $gateway->id,
                        'amount' => $payment->amount,
                        'settlement_transaction_id' => $send_to_customer->json('tx'),
                        "fee" => $payment->fee_amount,
                        "fee_transaction_id" => $send_to_site->json('tx')
                    ]);
                }
                // Ricever
                else{
                    $send_to_customer = Http::post('http://127.0.0.1:3000/send-tron',[
                        'privateKey' => $payment->wallet_key,
                        'toAddress' => $gateway->settlement_address,
                        'amount' => (float)$payment->amount - (float)$payment->fee_amount,
                        'senderAddress' => $payment->wallet_address
                    ]);
                    sleep(5);
                    $send_to_site = Http::post('http://127.0.0.1:3000/send-tron',[
                        'privateKey' => $payment->wallet_key,
                        'toAddress' => $site_wallet,
                        'amount' => $payment->fee_amount,
                        'senderAddress' => $payment->wallet_address
                    ]);

                    $gateway->update([
                        'fee_amount' => (float)$gateway->fee_amount - (float)$payment->fee_amount,
                        'current_balance' => (float)$gateway->current_balance - ((float)$payment->amount - $payment->fee_amount),
                    ]);

                    $send_to_customer_settelement = Settlement::create([
                        'settlement_address' => $gateway->settlement_address,
                        'gateway_id' => $gateway->id,
                        'amount' => $payment->amount,
                        'settlement_transaction_id' => $send_to_customer->json('tx'),
                        "fee" => $payment->fee_amount,
                        "fee_transaction_id" => $send_to_site->json('tx')
                    ]);
                }







                DB::commit();

            }
            catch(Exception $e){
               DB::rollBack();
            }
        }
    }
}
