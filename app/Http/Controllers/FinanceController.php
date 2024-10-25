<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Company;
use App\Models\EventPayment;
use Illuminate\Http\Request;
use App\Mail\PaymentConfiguredNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FinanceController extends Controller
{
    public function index()
    {
        try {
            $events = Event::all();
            return view('finance.dashboard', compact('events'));
        } catch (\Exception $e) {
            Log::error('Error fetching events: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch events. Please try again later.');
        }
    }

    public function editPayment($eventId)
    {
        try {
            $event = Event::findOrFail($eventId);
            $paymentMethods = PaymentMethod::all();
            $companies = Company::all();
            $eventPayment = EventPayment::where('event_id', $event->id)->first();

            return view('finance.editPayment', compact('event', 'paymentMethods', 'companies', 'eventPayment'));
        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());
            return redirect()->route('finance.dashboard')->with('error', 'Event not found.');
        } catch (\Exception $e) {
            Log::error('Error fetching payment details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch payment details. Please try again later.');
        }
    }

    public function updatePayment(Request $request, $eventId)
    {
        $validated = $request->validate([
            'payment_method' => 'required',
            'vat_rate' => 'required|numeric',
            'company' => 'required',
        ]);

        try {
            
            $eventPayment = EventPayment::updateOrCreate(
                ['event_id' => $eventId],
                [
                    'payment_method_id' => $request->payment_method,
                    'company_id' => $request->company,
                    'vat_rate' => $request->vat_rate,
                ]
            );
            $event = Event::findOrFail($eventId);
            Mail::to(Auth::user()->email)->send(new PaymentConfiguredNotification($event));
            return redirect()->route('finance.dashboard')->with('success', 'Payment updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to update payment. Please try again later.');
        }
    }
}
