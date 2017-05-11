<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Http\Requests;

class HomeController extends Controller
{
    //
    public function index(){
        return view("welcome");
    }
    
    public function readDoctors(){
        $doctors = Doctor::all();
        return response()->json($doctors);
    }
}
