<?php

use App\Models\PaymentMethod;
use App\Models\EventPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(Tests\TestCase::class); // Ensure this uses Laravel's TestCase for bootstrapping the app
uses(RefreshDatabase::class); // This ensures the database is reset for each test

beforeEach(fn () => $this->refreshDatabase()); // Ensure the database is refreshed before each test

// Test that the PaymentMethod model has a one-to-many relationship with EventPayment
test('payment method has many event payments', function () {
    $paymentMethod = PaymentMethod::factory()->create();
    $eventPayment = EventPayment::factory()->create(['payment_method_id' => $paymentMethod->id]);

    expect($paymentMethod->eventPayments)->toHaveCount(1);
    expect($paymentMethod->eventPayments->first())->toBeInstanceOf(EventPayment::class);
});
