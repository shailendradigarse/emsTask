<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Company;
use App\Models\User;
use App\Mail\PaymentProviderRequestNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RequestPaymentProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_new_payment_provider_and_send_notification()
    {
        // Fake the mail system
        Mail::fake();

        // Create a user with the finance role and authenticate the user
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);  // Simulate the user being logged in

        // Create test data
        $event = Event::factory()->create();
        $company = Company::factory()->create();

        // Perform the form submission for requesting a new payment provider
        $response = $this->post(route('paymentProviderRequests.store'), [
            'payment_method_name' => 'New Payment Provider',
            'website' => 'https://example.com',
            'event_id' => $event->id,
            'company_id' => $company->id,
        ]);

        // Ensure redirection to dashboard with success message
        $response->assertRedirect(route('finance.dashboard'));
        $response->assertSessionHas('success', 'Payment provider request submitted successfully.');

        // Assert that the notification email was sent to 'prashant.canopus@gmail.com'
        Mail::assertSent(PaymentProviderRequestNotification::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        // Test Validation: Try with missing required fields
        $response = $this->post(route('paymentProviderRequests.store'), [
            'website' => 'https://example.com', // Missing payment_method_name
            'event_id' => $event->id,
            'company_id' => $company->id,
        ]);

        // Expect validation error
        $response->assertSessionHasErrors(['payment_method_name']);
    }
}
