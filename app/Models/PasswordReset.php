<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordReset extends Model
{
    protected $fillable = [
        'token',
        'status',
        'user_id',
        'expired_at'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
