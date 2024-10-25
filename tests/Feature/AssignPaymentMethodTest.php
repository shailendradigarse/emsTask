<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Company;
use App\Models\User;  // Add this to create a user
use App\Mail\PaymentConfiguredNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AssignPaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_assign_payment_method_to_event_with_validation_and_notification()
    {
        // Fake the mail system
        Mail::fake();

        // Create a user with the finance role and authenticate the user
        $user = User::factory()->create(['role' => 'finance']);
        $this->actingAs($user);  // Simulate the user being logged in

        // Create test data
        $event = Event::factory()->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $company = Company::factory()->create();

        // Perform the form submission for assigning a payment method using PUT method
        $response = $this->put(route('finance.updatePayment', $event->id), [
            'payment_method' => $paymentMethod->id,
            'vat_rate' => 18.00, // Valid VAT rate
            'company' => $company->id,
        ]);

        // Ensure redirection to dashboard with success message
        $response->assertRedirect(route('finance.dashboard'));
        $response->assertSessionHas('success', 'Payment updated successfully.');

        // Assert that the notification email was sent to the correct email address
        Mail::assertSent(PaymentConfiguredNotification::class, function ($mail) use ($event) {
            return $mail->event->id === $event->id;
        });

        // Test Validation: Try with an invalid VAT rate (e.g., missing vat_rate)
        $response = $this->put(route('finance.updatePayment', $event->id), [
            'payment_method' => $paymentMethod->id,
            'company' => $company->id, // Missing VAT rate
        ]);

        // Expect validation error
        $response->assertSessionHasErrors(['vat_rate']);
    }
}
