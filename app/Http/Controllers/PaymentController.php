<?php

namespace App\Http\Controllers;
use App\Models\Vehicle;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentPage($orderId)
    {
        $order = Order::find($orderId);

        // Check if the order exists and belongs to the authenticated user
        if ($order && $order->national_id == Auth::user()->national_id) {
            return view('User.Payment.payment', compact('order'));
        } else {
            return redirect()->route('User.Order.index')->with('error', 'Order not found or you are not authorized to make a payment for it.');
        }
    }

    public function processPayment(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'bankslip_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $order = Order::find($orderId);

        if ($order && $order->national_id == Auth::user()->national_id) {
            $bankslipPath = $request->file('bankslip_path')->store('bankslips', 'public');

            Payment::create([
                'order_id' => $order->id,
                'national_id' => Auth::user()->national_id,
                'vehicle_no' => $order->vehicle_no,
                'payment_method' => $request->payment_method,
                'bankslip_path' => $bankslipPath,
            ]);

            return redirect()->route('User.Order.index')->with('success', 'Payment processed successfully.');
        } else {
            return redirect()->route('User.Order.index')->with('error', 'Order not found or you are not authorized to make a payment for it.');
        }
    }
    public function showpayment(Request $request){
        $searchQuery = $request->input('query');
    
    $payments = Payment::whereHas('vehicle', function ($query) use ($searchQuery) {
        $query->where('vehicle_name', 'LIKE', "%$searchQuery%")
            ->orWhere('vehicle_no', 'LIKE', "%$searchQuery%");
    })
    ->orWhereHas('user', function ($query) use ($searchQuery) {
        $query->where('national_id', 'LIKE', "%$searchQuery%");
    })
    ->with('vehicle', 'user')
    ->get();

        return view('Admin.pages.payment.paymentdetail', compact('payments'));
    }
    public function addAdvancePayment(Request $request)
{
    $request->validate([
        'vehicle_no' => 'required|string|exists:vehicles,vehicle_no',
        'amount' => 'required|numeric|min:0',
    ]);

    $vehicle = Vehicle::find($request->vehicle_no);
    $vehicle->advancepayment += $request->amount;
    $vehicle->save();

    return redirect()->route('Admin.pages.payment.paymentdetail')->with('success', 'Advance payment added successfully.');
}
    }