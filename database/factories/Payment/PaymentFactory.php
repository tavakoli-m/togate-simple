<?php

namespace Database\Factories\Payment;

use App\Models\Payment\Gateway;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gateway = Gateway::all()->random();
        return [
            'token' => str()->random(65),
            'gateway_id' => Gateway::all()->random()->id,
            'fee_method' => $gateway->fee_method,
            'amount' => fake()->numberBetween(1000,100000),
            'fee_amount' => fake()->numberBetween(1,100),
            'status' => fake()->numberBetween(1,4),
            'expired_at' => fake()->dateTime(),
            'wallet_key' => str()->random(20),
            'wallet_address' => str()->random(20),
            'callback_url' => fake()->url(),
            'description' => fake()->numberBetween(0,1) === 1 ? str()->random(20) : null,
        ];
    }
}
