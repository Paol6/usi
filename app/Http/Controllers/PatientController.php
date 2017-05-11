<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Patient;

class PatientController extends Controller
{
    public function create(Request $request)
    {
        $patient = new Patient();
        $patient->first_name = $request->input('first_name');
        $patient->last_name = $request->input('last_name');
        $patient->phone = $request->input('phone');
        $patient->gender = $request->input('gender');
        $patient->birthday = $request->input('birthday');
        $patient->email = $request->input('email');
        $patient->save();

        return response()->json([
            'id' => $patient->id,
        ]);
    }

    public function edit($patientId)
    {
        $patient = Patient::find($patientId);
        
        $data = request()->all();
        if (isset($data['phone'])) {
            $patient->phone = $data['phone'];
        }
        if (isset($data['first_name'])) {
            $patient->first_name = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $patient->last_name = $data['last_name'];
        }
        if (isset($data['gender'])) {
            $patient->gender = $data['gender'];
        }
        if (isset($data['bithday'])) {
            $patient->birthday = $data['birthday'];
        }
        if (isset($data['email'])) {
            $patient->email = $data['email'];
        }
        $patient->save();

        return response()->json($patient);
    }

    public function delete($patientId)
    {
        $patient = Patient::find($patientId);

        $appointments = DB::table('APPOINTMENT')
            ->select('*')
            ->where('patient_id', '=', $patientId)
            ->get();

        foreach ($appointments as $appointment) {
            DB::table('APPOINTMENT')->where('id', '=', $appointment->id)
                ->delete();
        }

        DB::table('PATIENT')->where('id', '=', $patientId)
             ->delete();

        return response()->json([
            'id' => $patientId,
        ]);
    }

    public function read($patientId)
    {
        $patient = Patient::find($patientId);

        return response()->json($patient);
    }

    public function getAppointments($patientId)
    {
        $appointments = DB::table('APPOINTMENT')
            ->select('*')
            ->join('PATIENT', 'PATIENT.id', '=', 'APPOINTMENT.patient_id')
            ->where('APPOINTMENT.patient_id', '=', $patientId)
            ->get();

        return response()->json($appointments);
    }

    public function getAppointment($patientId, $appointmentId)
    {
        $appointment = \App\Appointment::find($appointmentId);

        return response()->json($appointment);
    }

    public function getAppointmentByDateAndSpeciality(Request $request, $patientId)
    {
        $date = $request->input('date');
        $specialityId = $request->input('speciality_id');
        if($date){
            $appointments = DB::table('APPOINTMENT')
                ->select('APPOINTMENT.id', 'APPOINTMENT.doctor_id', 'APPOINTMENT.patient_id', 'APPOINTMENT.date', 'APPOINTMENT.duration')
                ->join('PATIENT', 'PATIENT.id', '=', 'APPOINTMENT.patient_id')
                ->where('APPOINTMENT.patient_id', '=', $patientId)
                ->whereDate('APPOINTMENT.date', '=', $date)
                ->get();
        }
        if($specialityId){
            $appointments = DB::table('APPOINTMENT')
                ->select('APPOINTMENT.id', 'APPOINTMENT.doctor_id', 'APPOINTMENT.patient_id', 'APPOINTMENT.date', 'APPOINTMENT.duration')
                ->join('PATIENT', 'PATIENT.id', '=', 'APPOINTMENT.patient_id')
                ->join('DOCTOR', 'DOCTOR.id', '=', 'APPOINTMENT.doctor_id')
                ->where('APPOINTMENT.patient_id', '=', $patientId)
                ->where('DOCTOR.speciality_id', '=', $specialityId)
                ->get();
        }

        return response()->json($appointments);
    }

    public function getPatients()
    {
        $patients = DB::table('PATIENT')
                     ->select('*')
                     ->get();

        return response()->json($patients);
    }
}
