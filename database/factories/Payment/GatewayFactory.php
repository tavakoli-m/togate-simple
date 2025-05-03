<?php

namespace Database\Factories\Payment;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment\Gateway>
 */
class GatewayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => str()->random(10),
            'api_key' => str()->random(65),
            'allowed_ips' => fake()->numberBetween(0,1) === 1 ? fake()->ipv4() : null,
            'user_id' => User::all()->random()->id,
            'fee_method' => fake()->numberBetween(1,2),
            'status' => fake()->numberBetween(1,2),
            'settlement_address' => str()->random(65),
        ];
    }
}
