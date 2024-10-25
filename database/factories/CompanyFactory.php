<?php

namespace Database\Factories;

use App\Models\Company;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Company Malta', 'Company Cyprus', 'Company Brazil', 'Company Dubai']),
            'bank_account' => $this->faker->bankAccountNumber,
            'vat_rate' => $this->faker->randomFloat(2, 5, 20),  // Generate random VAT rate
        ];
    }
}
