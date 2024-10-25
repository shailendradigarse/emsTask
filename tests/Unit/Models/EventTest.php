<?php

use App\Models\Event;
use App\Models\EventPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(Tests\TestCase::class); // This will ensure the Laravel application is bootstrapped
uses(RefreshDatabase::class); // Ensures database is reset after each test

beforeEach(fn () => $this->refreshDatabase()); // Make sure to reset the database before each test

// Test that the Event model has a one-to-many relationship with EventPayment
test('event has many event payments', function () {
    $event = Event::factory()->create(); // Create an Event
    $eventPayment = EventPayment::factory()->create(['event_id' => $event->id]); // Create an EventPayment related to this event

    expect($event->eventPayments)->toHaveCount(1); // Check if the event has one payment
    expect($event->eventPayments->first())->toBeInstanceOf(EventPayment::class); // Ensure that the related model is an instance of EventPayment
});

// Test the Event model's required fields validation
test('event requires a name and location', function () {
    $event = Event::factory()->make(['name' => '', 'location' => '']);

    $this->expectException(\Illuminate\Database\QueryException::class);

    $event->save();
});

// Test that the Event model has a valid relationship with EventPayment
test('event payments are deleted when event is deleted', function () {
    $event = Event::factory()->create(); // Create an Event
    $eventPayment = EventPayment::factory()->create(['event_id' => $event->id]); // Create EventPayment linked to the Event

    // Delete the event
    $event->delete();

    // Check if the related event payment is also deleted
    expect(EventPayment::where('event_id', $event->id)->exists())->toBeFalse();
});
