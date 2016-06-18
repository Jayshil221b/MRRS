<?php
class Clinicdetails extends \Eloquent {
	protected $fillable = ['id','clinic_name','address','doctor_id','clinic_phn','clinic_open_time','clinic_close_time'];

	public $errors;
	protected $table = 'clinic_detail';

}