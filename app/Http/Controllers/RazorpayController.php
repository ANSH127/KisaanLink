<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Razorpay\Api\Api;
use Exception;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmMail;



class RazorpayController extends Controller
{
    //
    public function store(Request $request)
    {

        // Check if the user is logged in
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Purchaser') {
            return redirect('/dashboard')->with('error', 'You are not authorized to access this page');
        }

        echo "Payment ID: " . $request->input('razorpay_payment_id') . "<br>";
        // Fetch the order details
        $order_id = $request->input('order_id');
        $order = Order::find($order_id);
        if (!$order) {
            return redirect('/dashboard')->with('error', 'Order not found');
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            // If the signature is valid, capture the payment
            $payment = $api->payment->fetch($request->input('razorpay_payment_id'));
            if ($payment->capture(array('amount' => $payment['amount']))) {
                // Update the order status to 'paid'
                $order->payment_status = 'Completed';
                $order->delivery_date = now()->addDays(7);
                $order->delivery_status = 'Processing';
                $order->payment_method = 'Razorpay';
                $order->razorpay_payment_id = $request->input('razorpay_payment_id'); // Store the Razorpay payment ID
                $order->save();


                // send the   email
                try {
                    Mail::to("anshagrawal12348@gmail.com")->send(new OrderConfirmMail($order));
                } catch (Exception $e) {
                    \Log::error('Failed to send order confirmation email: ' . $e->getMessage());


                }
                // Redirect to a success page

                return redirect('/orders')->with('success', 'Payment successful! Your order has been placed successfully.');


            } else {
                return redirect()->back()->with('error', 'Payment failed. Please try again.');
            }



        } catch (Exception $e) {
            // Handle exception
            return redirect()->back()->with('error', 'Payment failed. Please try again. Error: ' . $e->getMessage());
        }
    }



}
