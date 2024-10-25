<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Stripe', 'Pay.com', 'Apcopay', 'HiPay', 'BPPay', 'Crypto Pay']),
            'type' => $this->faker->randomElement(['Traditional', 'Crypto']),
            'website' => $this->faker->url,
        ];
    }
}
