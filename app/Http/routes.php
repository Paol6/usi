<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::post('/doctor/create', array('as' => 'doctor.create', 'uses' => 'DoctorController@create'));
Route::post('/doctor/{doctorId}/edit', array('as' => 'doctor.edit', 'uses' => 'DoctorController@edit'));
Route::delete('/doctor/{doctorId}/delete', array('as' => 'doctor.delete', 'uses' => 'DoctorController@delete'));
Route::get('/doctor/{doctorId}', array('as' => 'doctor.get', 'uses' => 'DoctorController@read'));
Route::get('/doctor/{doctorId}/appointment', array('as' => 'doctor_appointments.get', 'uses' => 'DoctorController@getAppointments'));
Route::get('/doctor/{doctorId}/appointment/{appointmentId}', array('as' => 'doctor_appointment.get', 'uses' => 'DoctorController@getAppointment'));
Route::post('/doctor/{doctorId}/appointment', array('as' => 'doctor_appointment_by_date.get', 'uses' => 'DoctorController@getAppointmentByDate'));
Route::get('/doctor', array('as' => 'doctors.get', 'uses' => 'DoctorController@getDoctors'));
Route::get('/doctor/speciality/{specialityId}', array('as' => 'doctors_by_speciality.get', 'uses' => 'DoctorController@getDoctorsBySpeciality'));
Route::post('/patient/create', array('as' => 'patient.create', 'uses' => 'PatientController@create'));
Route::post('/patient/{patientId}/edit', array('as' => 'patient.edit', 'uses' => 'PatientController@edit'));
Route::delete('/patient/{patientId}/delete', array('as' => 'patient.delete', 'uses' => 'PatientController@delete'));
Route::get('/patient/{patientId}', array('as' => 'patient.get', 'uses' => 'PatientController@read'));
Route::get('/patient/{patientId}/appointment', array('as' => 'patient_appointments.get', 'uses' => 'PatientController@getAppointments'));
Route::get('/patient/{patientId}/appointment/{appointmentId}', array('as' => 'patient_appointment.get', 'uses' => 'PatientController@getAppointment'));
Route::post('/patient/{patientId}/appointment', array('as' => 'patient_appointment_by_date_and_speciality.get', 'uses' => 'PatientController@getAppointmentByDateAndSpeciality'));
Route::get('/patient', array('as' => 'patients.get', 'uses' => 'PatientController@getPatients'));
Route::post('/appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentController@create'));
Route::post('/appointment/{appointmentId}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentController@edit'));
Route::delete('/appointment/{appointmentId}/delete', array('as' => 'appointment.delete', 'uses' => 'AppointmentController@delete'));
Route::get('/appointment/{appointmentId}', array('as' => 'appointment.get', 'uses' => 'AppointmentController@read'));
Route::get('/appointment', array('as' => 'appointments.get', 'uses' => 'AppointmentController@getAppointments'));
Route::post('/speciality/{specialityId}/edit', array('as' => 'speciality.edit', 'uses' => 'SpecialityController@edit'));
Route::get('/speciality/{specialityId}', array('as' => 'speciality.get', 'uses' => 'SpecialityController@read'));
Route::get('/speciality', array('as' => 'specialities.get', 'uses' => 'SpecialityController@getSpecialities'));


