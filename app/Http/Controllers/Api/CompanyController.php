<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // Fetch all companies
            $companies = Company::all();
            return response()->json(['message' => 'success', 'data'=> $companies], 200);
        } catch (\Exception $e) {
            // Log the exception (optional)
            Log::error('Error fetching companies: ' . $e->getMessage());
            // Return a generic error response
            return response()->json([
                'message' => 'An error occurred while fetching companies.',
                'error' => $e->getMessage() // Optional: Remove in production
            ], 500);
        }
    }
}
