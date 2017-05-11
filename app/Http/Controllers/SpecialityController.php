<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Speciality;

class SpecialityController extends Controller
{
    public function edit($specialityId)
    {
        $speciality = Speciality::find($specialityId);
        $data = request()->all();

        if (isset($data['name'])) {
            $speciality->name = $data['name'];
        }
        if (isset($data['price_per_appointment'])) {
            $speciality->price_per_appointment = $data['price_per_appointment'];
        }
        $speciality->save();

        return response()->json($speciality);
    }

    public function read($specialityId)
    {
        $speciality = Speciality::find($specialityId);

        return response()->json($speciality);
    }

    public function getSpecialities()
    {
        $specialities = DB::table('SPECIALITY')
            ->select('*')
            ->get();

        return response()->json($specialities);
    }
}
