<?php
class AppointmentDetails extends \Eloquent {
	protected $fillable = ['id','patient_id','doctor_id','status'];

	public $errors;
	public $timestamp=true;
	protected $table = 'appointments';

}