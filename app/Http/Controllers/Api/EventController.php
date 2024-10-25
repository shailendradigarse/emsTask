<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // Fetch all events with their payment configurations
            $events = Event::with('eventPayments')->get();
            return response()->json(['message' => 'success', 'data'=> $events], 200);
        } catch (\Exception $e) {
            // Log the exception (optional)
            Log::error('Error fetching events: ' . $e->getMessage());
            // Return a generic error response
            return response()->json([
                'message' => 'An error occurred while fetching events.',
                'error' => $e->getMessage() // Optional: Remove in production
            ], 500);
        }
    }
}
