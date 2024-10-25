<?php

namespace App\Http\Controllers;

use App\Models\PaymentProviderRequest;
use App\Models\Event;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Mail\PaymentProviderRequestNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentProviderRequestController extends Controller
{

    public function index()
    {
        try {
            $paymentProviderRequests = PaymentProviderRequest::where('status', 'pending')->get();
            return view('finance.approveRequests', compact('paymentProviderRequests'));
        } catch (\Exception $e) {
            Log::error('Error fetching payment provider requests: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch payment provider requests. Please try again later.');
        }
    }


    public function create()
    {
        try {
            // Fetch events and companies for the form
            $events = Event::all();
            $companies = Company::all();
            // Return the form view with events and companies
            return view('finance.requestPaymentProvider', compact('events', 'companies'));
        } catch (\Exception $e) {
            Log::error('Error fetching events or companies: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch events or companies. Please try again later.');
        }
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'payment_method_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'event_id' => 'required|exists:events,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        try {

            // Create the payment provider request
            $paymentProviderRequest = PaymentProviderRequest::create([
                'payment_method_name' => $request->payment_method_name,
                'website' => $request->website,
                'event_id' => $request->event_id,
                'company_id' => $request->company_id,
                'status' => 'pending',  // Initially, all requests will have a pending status
            ]);
            $users = User::where('role', "admin")->get();
            foreach ($users as $key => $user) {
                Mail::to($user->email)->send(new PaymentProviderRequestNotification($paymentProviderRequest));
            }
            
            return redirect()->route('finance.dashboard')->with('success', 'Payment provider request submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Error submitting payment provider request: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to submit payment provider request. Please try again later.');
        }
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        try {
            $paymentProviderRequest = PaymentProviderRequest::findOrFail($id);
            $paymentProviderRequest->update([
                'status' => $request->status,
            ]);

            
            $users = User::where('role', "finance")->get();
            foreach ($users as $key => $user) {
                Mail::to($user->email)->send(new PaymentProviderRequestNotification($paymentProviderRequest, true));
            }
            return redirect()->route('finance.dashboard')->with('success', 'Payment provider request status updated.');
        } catch (ModelNotFoundException $e) {
            Log::error('Payment provider request not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Payment provider request not found.');
        } catch (\Exception $e) {
            Log::error('Error updating payment provider request status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to update payment provider request status. Please try again later.');
        }
    }
}
