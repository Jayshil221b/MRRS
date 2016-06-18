<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('logout','SessionsController@destroy');
Route::get('users','UserController@index')->before('auth');
Route::get('users/edit/{id}','UserController@edit')->before('auth');

Route::resource('users','UserController');
 Route::get('login','SessionsController@create');
 Route::get('/patient/recentpatient','PatientController@recentpatient');
 Route::get('/patient/search', array('as'=>'patient.search','uses'=>'PatientController@search'));
 Route::get('/patient/searchPatient', array('as'=>'patient.searchPatient','uses'=>'PatientController@searchPatient'));
 Route::post('/prescription/Reportstore', array('as'=>'prescription.Reportstore','uses'=>'PrescriptionController@Reportstore'));
 
 Route::get('/','SessionsController@create');
 
 Route::get('admin',function()
 {
 	return 'Admin page.';
 })->before('auth');
 Route::resource('sessions','SessionsController');
Route::get('/patient/appointment',array('as'=>'patient.appointment','uses'=>'PatientController@appointment'));
Route::get('/doctor/timing',array('as'=>'doctor.timing','uses'=>'DoctorController@clinicaldetails'));
Route::get('getappointments','DoctorController@getAppointments');
 Route::resource('doctor','DoctorController');
 Route::resource('patient','PatientController');
 Route::resource('prescription','PrescriptionController');
 Route::resource('staff','StaffController');
 