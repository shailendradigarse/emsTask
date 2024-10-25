<p>Dear Team,</p>

@if($statusUpdated)
    <p>The status of the payment provider request for <strong>{{ $providerName }}</strong> has been updated to <strong>{{ ucfirst($status) }}</strong>.</p>
@else
    <p>A new payment provider request for <strong>{{ $providerName }}</strong> has been submitted.</p>
@endif

<p>Event: {{ $eventName }}<br>
Company: {{ $companyName }}<br>
Status: {{ ucfirst($status) }}</p>

<p>Thank you,<br>{{ config('app.name') }}</p>
