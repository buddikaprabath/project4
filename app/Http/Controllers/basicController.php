<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class basicController extends Controller
{
    public function about(){
        return view('home_pages.pages.About');
    }
    public function contact(){
        return view('home_pages.pages.Contact');
    }
}