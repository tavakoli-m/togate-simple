<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settlement extends Model
{
    /** @use HasFactory<\Database\Factories\Payment\SettlementFactory> */
    use HasFactory;

    protected $fillable = [
        'settlement_address',
        'gateway_id',
        'amount',
        'settlement_transaction_id',
        'fee',
        'fee_transaction_id',
    ];

    public function gateway() : BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }
}
