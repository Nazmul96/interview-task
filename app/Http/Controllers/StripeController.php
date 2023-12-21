<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripePaymentRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripe(){
        return view('stripe');
    }

    public function stripePayment(StripePaymentRequest $request){
            $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SK'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'T-shirt',
                            ],
                            'unit_amount' => $request->amount*100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('failure'),
            ]);

        if(isset($response->id) && $response->id != ''){
            session()->put('user_id', $request->user_id);
            session()->put('amount', $request->amount);
            return redirect($response->url);
        } else {
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SK'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);


            $transaction = new Transaction();
            $transaction->transaction_id = $response->id;
            $transaction->user_id = session()->get('user_id');
            $transaction->amount  = session()->get('amount');
            $transaction->status  = $response->status;
            $transaction->save();

            session()->forget('user_id');
            session()->forget('amount');

            return "Payment is successfully done";

        } else {
            return redirect()->route('failure');
        }
    }

    public function failure()
    {
        return "Payment is Failed.";
    }
}
