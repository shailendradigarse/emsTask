<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventPayment;
use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Company;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventPayment>
 */
class EventPaymentFactory extends Factory
{
    protected $model = EventPayment::class;

    public function definition()
    {
        return [
            'event_id' => Event::factory(),  // Reference an Event factory
            'payment_method_id' => PaymentMethod::factory(),  // Reference a PaymentMethod factory
            'company_id' => Company::factory(),  // Reference a Company factory
            'vat_rate' => $this->faker->randomFloat(2, 5, 20),  // Random VAT rate between 5% and 20%
        ];
    }
}
