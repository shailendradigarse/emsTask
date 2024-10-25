<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentProviderRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentProviderRequest;
    public $statusUpdated;

    /**
     * Create a new message instance.
     */
    public function __construct($paymentProviderRequest, $statusUpdated = false)
    {
        $this->paymentProviderRequest = $paymentProviderRequest;
        $this->statusUpdated = $statusUpdated;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->statusUpdated
                ? 'Payment Provider Request Status Updated'
                : 'New Payment Provider Request Submitted'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.paymentProviderRequest',
            with: [
                'providerName' => $this->paymentProviderRequest->payment_method_name,
                'eventName' => $this->paymentProviderRequest->event->name,
                'companyName' => $this->paymentProviderRequest->company->name,
                'status' => $this->paymentProviderRequest->status,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
