<?php

namespace App\Http\Controllers;

use App\Models\ApartmentApplication;
use App\Models\Payment;
use App\Models\PaymentType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{

    public function showPaymentForm()
    {

        $residentId = auth()->user()->id;

        $apartmentApplication = ApartmentApplication::where('resident_id', $residentId)
            ->where('status', 2)
            ->first();

        if (!$apartmentApplication) {
            return back()->with('error', 'No lease application found for the authenticated user.');
        }
        $paymentTypes = PaymentType::all();

        return view('payment.payment', [
            'apartmentApplicationId' => $apartmentApplication->apartment_application_id,
            'apartmentId' => $apartmentApplication->apartment_id,
            'residentId' => $apartmentApplication->resident_id,
            'paymentTypes' => $paymentTypes,
        ]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_type_id' => 'required|exists:payment_types,payment_type_id',
            'stripeToken' => 'required',
        ]);

        $amountInCents = $request->amount * 100;

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $amountInCents,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment in LKR',
            ]);

            $paymentMonth = Carbon::now()->format('F');
            $paymentYear = Carbon::now()->year;

            Payment::create([
                'transaction_id' => $charge->id,
                'amount' => $request->amount,
                'apartment_application_id' => $request->apartment_application_id,
                'resident_id' => $request->resident_id,
                'apartment_id' => $request->apartment_id,
                'payment_type_id' => $request->payment_type_id,
                'currency' => 'lkr',
                'status' => $charge->status,
                'payment_month' => $paymentMonth,
                'payment_year' => $paymentYear,
            ]);

            return redirect()->route('apartment_payment.index')->with('success_msg', 'Payment successfully processed!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
