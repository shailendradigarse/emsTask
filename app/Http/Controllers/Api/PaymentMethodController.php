<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentMethodController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // Fetch all available payment methods
            $paymentMethods = PaymentMethod::all();
            return response()->json(['message' => 'success', 'data'=> $paymentMethods], 200);
        } catch (\Exception $e) {
            // Log the exception (optional)
            Log::error('Error fetching payment methods: ' . $e->getMessage());
            // Return a generic error response
            return response()->json([
                'message' => 'An error occurred while fetching payment methods.',
                'error' => $e->getMessage() // Optional: Remove in production
            ], 500);
        }
    }
}
