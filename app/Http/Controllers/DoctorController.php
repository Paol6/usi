<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Doctor;


class DoctorController extends Controller
{
    public function create(Request $request)
    {
        $doctor = new Doctor();
        
        $doctor->first_name = $request->input('first_name');
        $doctor->last_name = $request->input('last_name');
        $doctor->speciality_id = $request->input('speciality_id');
        $doctor->phone = $request->input('phone');
        $doctor->gender = $request->input('gender');
        $doctor->birthday = $request->input('birthday');
        $doctor->email = $request->input('email');
        $doctor->room = $request->input('room');
        $doctor->save();

        return response()->json([
            'id' => $doctor->id,
        ]);
    }

    public function edit($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        
        $data = request()->all();
        if (isset($data['phone'])) {
            $doctor->phone = $data['phone'];
        }
        if (isset($data['first_name'])) {
            $doctor->first_name = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $doctor->last_name = $data['last_name'];
        }
        if (isset($data['gender'])) {
            $doctor->gender = $data['gender'];
        }
        if (isset($data['bithday'])) {
            $doctor->birthday = $data['birthday'];
        }
        if (isset($data['room'])) {
            $doctor->room = $data['room'];
        }
        if (isset($data['email'])) {
            $doctor->email = $data['email'];
        }

        $doctor->save();

        return response()->json($doctor);
    }

    public function delete($doctorId)
    {
        $doctor = Doctor::find($doctorId);

        $appointments = DB::table('appointment')
            ->select('*')
            ->where('doctor_id', '=', $doctorId)
            ->get();

        foreach ($appointments as $appointment) {
            DB::table('APPOINTMENT')->where('id', '=', $appointment->id)
                ->delete();
        }

        DB::table('DOCTOR')->where('id', '=', $doctorId)
             ->delete();

        return response()->json([
            'id' => $doctorId,
        ]);
    }

    public function read($doctorId)
    {
        $doctor = Doctor::find($doctorId);

        return response()->json($doctor);
    }

    public function getAppointments($doctorId)
    {
        $appointments = DB::table('APPOINTMENT')
            ->select('APPOINTMENT.id', 'APPOINTMENT.doctor_id', 'APPOINTMENT.patient_id', 'APPOINTMENT.date', 'APPOINTMENT.duration')
            ->join('DOCTOR', 'DOCTOR.id', '=', 'APPOINTMENT.doctor_id')
            ->where('APPOINTMENT.doctor_id', '=', $doctorId)
            ->get();

        return response()->json($appointments);
    }

    public function getAppointment($doctorId, $appointmentId)
    {
        $appointment = \App\Appointment::find($appointmentId);

        return response()->json($appointment);
    }

    public function getAppointmentByDate(Request $request, $doctorId)
    {
        $date = $request->input('date');

        $appointments = DB::table('APPOINTMENT')
                     ->select('APPOINTMENT.id', 'APPOINTMENT.doctor_id', 'APPOINTMENT.patient_id', 'APPOINTMENT.date', 'APPOINTMENT.duration')
                     ->join('DOCTOR', 'DOCTOR.id', '=', 'APPOINTMENT.doctor_id')
                     ->where('APPOINTMENT.doctor_id', '=', $doctorId)
                     ->whereDate('APPOINTMENT.date', '=', $date)
                     ->get();

        return response()->json($appointments);
    }

    public function getDoctors()
    {
        $doctors = DB::table('DOCTOR')
                     ->select('*')
                     ->get();

        return response()->json($doctors);
    }

    public function getDoctorsBySpeciality($specialityId)
    {
        $doctors = DB::table('DOCTOR')
                     ->select('*')
                     ->where('speciality_id', '=', $specialityId)
                     ->get();

        return response()->json($doctors);
    }
}
