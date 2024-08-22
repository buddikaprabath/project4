<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewmain(){
        return view('Admin.pages.main');
    }

    public function viewVehicle (){
        return view('Admin.pages.vehicle.vehicleHome');
    }
    
}