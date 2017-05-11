<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Appointment;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $appointment = new Appointment();
        
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->patient_id = $request->input('patient_id');
        $appointment->date = $request->input('date');
        $appointment->duration = $request->input('duration');
        $appointment->save();

        return response()->json([
             'id' => $appointment->id,
        ]);
    }

    public function edit($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $data = request()->all();

        if (isset($data['doctor_id'])) {
            $appointment->doctor_id = $data['doctor_id'];
        }
        if (isset($data['patient_id'])) {
            $appointment->patient_id = $data['patient_id'];
        }
        if (isset($data['date'])) {
            $appointment->date = $data['date'];
        }
        if (isset($data['duration'])) {
            $appointment->duration = $data['duration'];
        }
        $appointment->save();

        return response()->json($appointment);
    }

    public function delete($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);

        DB::table('APPOINTMENT')->where('id', '=', $appointmentId)
             ->delete();

        return response()->json([
            'id' => $appointmentId,
        ]);
    }

    public function read($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);

        return response()->json($appointment);
    }

    public function getAppointments()
    {
        $appointments = DB::table('APPOINTMENT')
            ->select('*')
            ->get();

        return response()->json($appointments);
    }
}
