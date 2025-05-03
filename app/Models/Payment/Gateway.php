<?php

namespace App\Models\Payment;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gateway extends Model
{
    /** @use HasFactory<\Database\Factories\Payment\GatewayFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'api_key',
        'allowed_ips',
        'user_id',
        'min_settlement',
        'fee_amount',
        'current_balance',
        'fee_method',
        'status',
        'settlement_address',
    ];

    protected function casts() : array
    {
        return [
            'allowed_ips' => 'array'
        ];
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function settlements() : HasMany
    {
        return $this->hasMany(Settlement::class);
    }
}
