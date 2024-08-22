<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\NationalId;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all customers except those with type = 1 (admin)
        $customers = User::where('type', '!=', 1)->get();
    
        return view('Admin.pages.Customer.customerHome', compact('customers'));
    }
    

    public function create()
    {
        return view('Admin.pages.Customer.create');
    }
    
    
    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'national_id' => ['required', 'string', 'max:20', new NationalId],
        'Customer_Name' => 'required|string|max:255',
        'Customer_Address' => 'required|string|max:255',
        'Customer_Phone' => 'required|string|max:10|min:10',
        'type' => 'required|in:buyer,seller',
    ]);

    // Create the User record
    $user = User::create([
        'name' => $validatedData['Customer_Name'],
        'national_id' => $validatedData['national_id'],
        'customer_address' => $validatedData['Customer_Address'],
        'customer_phone' => $validatedData['Customer_Phone'],
        'ctype' => $validatedData['type'],
    ]);

    // Redirect to the customers home page with a success message
    return redirect()->route('Admin.pages.Customer.customerHome')->with('success', 'Customer created successfully!');
}
    public function edit($Customer_id)
    {
        $response['Customer'] = User::find($Customer_id);
        return view('Admin.pages.Customer.edit')->with($response);
    }
    
    public function update(Request $request, $id)
{
    // Find the customer record by national_id
    $customer = User::findOrFail($id);

    // Validate the incoming data
    $validatedData = $request->validate([
        'Customer_Name' => 'required|string|max:255',
        'Customer_Address' => 'required|string|max:255',
        'Customer_phone' => 'required|string|max:10|min:10',
        'ctype' => 'required|in:buyer,seller',
    ]);

    // Update the customer record with the new data
    $customer->update([
        
        'name' => $validatedData['Customer_Name'],
        'customer_address' => $validatedData['Customer_Address'],
        'customer_phone' => $validatedData['Customer_phone'],
        'ctype' => $validatedData['ctype'],
    ]);

    // Redirect to the customers home page with a success message
    return redirect()->route('Admin.pages.Customer.customerHome')->with('success', 'Customer updated successfully!');
}


    
    public function delete($Customer_id)
    {
        $customer = User::find($Customer_id);
        
       
        $customer->delete();
        return redirect()->route('Admin.pages.Customer.customerHome')->with('Deleted', 'Customer deleted successfully!');
    }

    public function search(Request $request)
{
    $search = $request->get('search');
    
    $customers = User::where('national_id', 'like', '%'.$search.'%')
                    ->orWhere('name', 'like', '%'.$search.'%')
                    ->get();

    return view('Admin.pages.Customer.customerHome', compact('customers'));
}
}