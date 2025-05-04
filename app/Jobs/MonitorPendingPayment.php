<?php

namespace App\Jobs;

use App\Models\Payment\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MonitorPendingPayment implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Payment $payment
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->payment->expired_at > now()){
            $this->release(60);
            return;
        }

        if($this->payment->expired_at < now() && $this->payment->status === 1){
            $this->payment->update(['status' => 3]);
        }
    }
}
