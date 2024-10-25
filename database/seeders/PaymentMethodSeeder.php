<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create(['name' => 'Stripe', 'type' => 'Traditional', 'website' => 'https://stripe.com']);
        PaymentMethod::create(['name' => 'Pay.com', 'type' => 'Traditional', 'website' => 'https://pay.com']);
        PaymentMethod::create(['name' => 'Crypto Pay', 'type' => 'Crypto', 'website' => 'https://cryptopay.com']);
    }
}
