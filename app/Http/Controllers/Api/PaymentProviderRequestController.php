<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProviderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentProviderRequestController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // Fetch all payment provider requests with their status
            $requests = PaymentProviderRequest::all();
            return response()->json(['message' => 'success', 'data'=> $requests], 200);
        } catch (\Exception $e) {
            // Log the exception (optional)
            Log::error('Error fetching payment provider requests: ' . $e->getMessage());
            // Return a generic error response
            return response()->json([
                'message' => 'An error occurred while fetching payment provider requests.',
                'error' => $e->getMessage() // Optional: remove in production
            ], 500);
        }
    }
}
