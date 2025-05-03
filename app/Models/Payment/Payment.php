<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\Payment\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'token',
        'gateway_id',
        'fee_method',
        'amount',
        'fee_amount',
        'status',
        'expired_at',
        'wallet_key',
        'wallet_address',
        'callback_url',
        'description'
    ];

    public function gateway() : BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }
}
