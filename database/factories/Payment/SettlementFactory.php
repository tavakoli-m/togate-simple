<?php

namespace Database\Factories\Payment;

use App\Models\Payment\Gateway;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\Settlement>
 */
class SettlementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'settlement_address' => str()->random(20),
            'gateway_id' => Gateway::all()->random()->id,
            'amount' => fake()->numberBetween(1,100000),
            'settlement_transaction_id' => str()->random(20),
            'fee' => fake()->numberBetween(1,100),
            'fee_transaction_id' => str()->random(20),
        ];
    }
}
