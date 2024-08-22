<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['customer', 'vehicle'])->get();
        return view('Admin.pages.Invoice.invoiceIndex', compact('invoices'));
    }

    public function create()
    {
        $customers = User::where('type', '!=', 1)->get();
        $vehicles = Vehicle::all();
        return view('Admin.pages.Invoice.create', compact('customers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'national_id' => 'required|exists:users,national_id',
            'vehicle_no' => 'required|exists:vehicles,vehicle_no',
            'total_amount' => 'required|numeric',
            'total_bill_amount' => 'required|numeric'
        ]);

        $invoice = Invoice::create($validatedData);

        // Update vehicle order status
        $vehicle = Vehicle::where('vehicle_no', $request->vehicle_no)->first();
        $vehicle->order_status = 'reserved';
        $vehicle->save();

        return redirect()->route('Admin.pages.Invoice.invoiceIndex')->with('success', 'Invoice created successfully.');
    }

    public function show($id)
    {
        $invoice = Invoice::with(['customer', 'vehicle'])->findOrFail($id);
        return view('Admin.pages.Invoice.show', compact('invoice'));
    }

    public function generatePDF($id)
    {
        $invoice = Invoice::with(['customer', 'vehicle'])->findOrFail($id);
        $pdf = PDF::loadView('Admin.pages.Invoice.pdf', compact('invoice'));
        return $pdf->download('invoice.pdf');
    }
}