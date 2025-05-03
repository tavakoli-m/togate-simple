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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->text('settlement_address');
            $table->foreignId('gateway_id')->constrained('gateways')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('amount',15,8);
            $table->text('settlement_transaction_id');
            $table->decimal('fee',15,8);
            $table->text('fee_transaction_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
