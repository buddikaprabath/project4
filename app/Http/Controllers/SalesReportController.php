<?php
namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        $soldVehiclesCount = Vehicle::where('order_status', 'reserved')->count();
        $ordersCount = Order::count();
        $customersCount = User::where('type', '0')->count();
    
        // Calculate total profit
        $totalProfit = Vehicle::sum(\DB::raw('selling - buying'));
    
        return view('Admin.pages.main', compact('soldVehiclesCount', 'ordersCount', 'customersCount', 'totalProfit'));
    }

}