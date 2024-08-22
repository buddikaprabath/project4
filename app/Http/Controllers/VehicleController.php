<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all(); // Fetch all vehicles
        return view('Admin.pages.vehicle.vehicleHome', compact('vehicles')); // Pass vehicles to the view
    }

    public function create()
    {
        return view('Admin.pages.vehicle.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_no' => 'required|string|max:12|unique:vehicles',
            'vehicle_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'chassis_no' => 'required|string|max:17',
            'engine_no' => 'required|string|max:12',
            'yom' => 'required|date',
            'v_status' => 'required|string|max:255',
            'buying' => 'required|numeric',
            'selling' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $vehicle = Vehicle::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicle_images', 'public');
                VehicleImage::create([
                    'vehicle_no' => $vehicle->vehicle_no,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('Admin.pages.vehicle.vehicleHome')->with('success', 'Vehicle created successfully.');
    }

    public function edit($vehicle_no)
    {
        
        $vehicle = Vehicle::with('images')->findOrFail($vehicle_no);
        return view('Admin.pages.vehicle.edit', compact('vehicle'));
    }

public function update(Request $request, $vehicle_no)
{
    $vehicle = Vehicle::findOrFail($vehicle_no);

    // Validate the incoming data
    $validatedData = $request->validate([
        
        'vehicle_name' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'chassis_no' => 'required|string|max:255',
        'engine_no' => 'required|string|max:255',
        'yom' => 'required|date',
        'v_status' => 'required|string|max:255',
        'buying' => 'required|numeric',
        'selling' => 'required|numeric',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    // Update the vehicle record with the new data
    $vehicle->update($validatedData);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('vehicle_images', 'public');
            VehicleImage::create([
                'vehicle_no' => $vehicle->vehicle_no,
                'image_path' => $path
            ]);
        }
    }

    return redirect()->route('Admin.pages.vehicle.vehicleHome')->with('success', 'Vehicle updated successfully.');
}

    public function delete($vehicle_no)
        {
            $vehicle = Vehicle::find($vehicle_no);            
            $vehicle->delete();
            return redirect()->route('Admin.pages.vehicle.vehicleHome')->with('Deleted', 'Customer deleted successfully!');
        }

        public function showHomePage()
    {
        $vehicles = Vehicle::where('order_status', 'available')->get(); // Fetch only available vehicles// Fetch all vehicles with their images
        return view('home_pages.pages.Home_page', compact('vehicles')); // Pass vehicles to the view
    }
    public function search(Request $request)
{
    $query = $request->input('query');

    $searchResults = Vehicle::with('images')
        ->where(function($queryBuilder) use ($query) {
            $queryBuilder->where('vehicle_name', 'LIKE', "%$query%")
                         ->orWhere('model', 'LIKE', "%$query%")
                         ->orWhere('type', 'LIKE', "%$query%");
        })
        ->where('order_status', 'available')
        ->get();

    $vehicles = Vehicle::with('images')->where('order_status', 'available')->get();

    return view('home_pages.pages.Home_page', compact('vehicles', 'searchResults'));
}


    public function showuserPage()
    {
        $vehicles = Vehicle::where('order_status', 'available')->get(); // Fetch all vehicles with their images
        return view('User.Vehicle.vehicles', compact('vehicles')); // Pass vehicles to the view
    }
    public function searchvehicle(Request $request)
{
    $query = $request->input('query');

    $searchResults = Vehicle::with('images')
        ->where(function($queryBuilder) use ($query) {
            $queryBuilder->where('vehicle_name', 'LIKE', "%$query%")
                         ->orWhere('model', 'LIKE', "%$query%")
                         ->orWhere('type', 'LIKE', "%$query%");
        })
        ->where('order_status', 'available')
        ->get();

    $vehicles = Vehicle::with('images')->where('order_status', 'available')->get();

    return view('User.Vehicle.vehicles', compact('vehicles', 'searchResults'));
}

    public function adminsearch(Request $request)
    {
        $query = $request->input('query');

    $searchResults = Vehicle::with('images')
        ->where('vehicle_name', 'LIKE', "%$query%")
        ->orWhere('model', 'LIKE', "%$query%")
        ->orWhere('type', 'LIKE', "%$query%")
        ->get();

    $vehicles = Vehicle::with('images')->get();

    return view('Admin.pages.vehicle.vehicleHome', compact('vehicles', 'searchResults'));
    }
   
}