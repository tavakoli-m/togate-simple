<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('token',65)->unique();
            $table->foreignId('gateway_id')->constrained('gateways')->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('fee_method')->default(1)->comment('1 => payer | 2 => receiver');
            $table->decimal('amount',15,8);
            $table->decimal('fee_amount',15,8);
            $table->tinyInteger('status')->default(1)->comment('1 => processing | 2 => cancelled | 3 => expired | 4 => paid');
            $table->dateTime('expired_at');
            $table->text('wallet_key');
            $table->text('wallet_address');
            $table->text('callback_url');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
