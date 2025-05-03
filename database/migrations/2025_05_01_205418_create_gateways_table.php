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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('api_key',65)->unique();
            $table->text('allowed_ips')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('min_settlement',15,8)->default(0);
            $table->decimal('fee_amount',15,8)->default(0);
            $table->decimal('current_balance',15,8)->default(0);
            $table->tinyInteger('fee_method')->default(1)->comment('1 => payer | 2 => receiver');
            $table->tinyInteger('status')->default(1)->comment('1 => active | 2 => inactive');
            $table->text('settlement_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
