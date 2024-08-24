<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function update_paid(Request $request)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        // Validate the form data
        $validatedData = $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'price' => 'required|numeric',
        ]);

        $paymentAmount = $validatedData['payment_amount'];
        $price = $validatedData['price'];
        $difference = $paymentAmount - $price;

        $user = Auth::user();

        if ($difference < 0) {
            // User underpaid
            return redirect()->back()->with('error', 'You are still underpaid Rp.' . number_format(-$difference, 2));
        } elseif ($difference > 0) {
            // User overpaid
            return redirect()->route('handle.overpayment', [
                'amount' => $difference,
                'payment_amount' => $paymentAmount,
                'price' => $price
            ]);
        } else {
            // Payment is exact
            $user->has_paid = true;
            $user->save();
            return redirect()->back()->with('success', 'Payment successful!');
        }
    }

    public function handleOverpayment(Request $request)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $amount = $request->input('amount');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');

        // Show a view or dialog to handle overpayment
        return view('overpayment', [
            'amount' => $amount,
            'payment_amount' => $paymentAmount,
            'price' => $price
        ]);
    }

    public function processOverpayment(Request $request)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $action = $request->input('action');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');
        $user = Auth::user();

        if ($action === 'yes') {
            // Add the overpaid amount to the user's wallet balance
            $amount = $request->input('amount');
            // Assume a wallet balance attribute exists on the user
            $user->coins += $amount;
            $user->has_paid = true;
            $user->save();

            return redirect()->route('home')->with('success', 'The excess amount has been added to your wallet.');
        } else {
            // Redirect back to the payment form to correct the amount
            return redirect()->route('pay')->with('error', 'Please enter the correct payment amount.');
        }
    }
}
