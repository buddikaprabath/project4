<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Vehicle $vehicle)
    {
        return view('User.Order.create', compact('vehicle'));
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        // Check if the user has already ordered this vehicle
        $existingOrder = Order::where('national_id', Auth::user()->national_id)
                              ->where('vehicle_no', $vehicle->vehicle_no)
                              ->exists();
    
        if ($existingOrder) {
            return redirect()->back()->with('error', 'You have already ordered this vehicle.');
        }
    
        // Create a new order
        Order::create([
            'national_id' => Auth::user()->national_id,
            'vehicle_no' => $vehicle->vehicle_no,
        ]);
    
        return redirect()->route('User.Order.index')->with('success', 'Vehicle reserved sent successfully!');
    }
    
    

    public function index()
    {
        $orders = Auth::user()->orders()->with('vehicle')->get();
        return view('User.Order.index', compact('orders'));
    }

    public function adminIndex()
    {
        $orders = Order::with('user', 'vehicle')->get()->groupBy('national_id');
        return view('Admin.pages.orders.index', compact('orders'));
    }
    public function confirm(Order $order)
{
    // Update order status to confirmed
    $order->update(['status' => 'confirmed']);

    // Update vehicle order status to reserved
    $order->vehicle->update(['order_status' => 'reserved']);

    // Cancel other pending orders for the same vehicle
    Order::where('vehicle_no', $order->vehicle_no)
        ->where('status', 'pending')
        ->where('id', '!=', $order->id)
        ->update(['status' => 'canceled']);

    return redirect()->route('Admin.pages.Orders.index')->with('success', 'Order confirmed and other orders for the same vehicle canceled!');
}

public function cancel(Order $order)
{
    $order->update(['status' => 'canceled']);
    $order->vehicle->update(['order_status' => 'available']);

    return redirect()->route('Admin.pages.Orders.index')->with('success', 'Order canceled!');
}

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        
        $orders = Auth::user()->orders()
                        ->where('id', 'like', '%' . $searchQuery . '%')
                        ->orWhereHas('vehicle', function ($query) use ($searchQuery) {
                            $query->where('vehicle_name', 'like', '%' . $searchQuery . '%')
                                  ->orWhere('vehicle_no', 'like', '%' . $searchQuery . '%');
                        })
                        ->orWhereDate('created_at', $searchQuery)
                        ->get();
    
        return view('User.Order.index', compact('orders'));
    }
    public function destroy($id)
{
    $order = Order::find($id);

    // Check if the order exists and belongs to the authenticated user
    if ($order && $order->national_id == Auth::user()->national_id) {
        $order->delete();

        return redirect()->route('User.Order.index')->with('success', 'Order deleted successfully.');
    } else {
        return redirect()->route('User.Order.index')->with('error', 'Order not found or you are not authorized to delete it.');
    }
}

    

}