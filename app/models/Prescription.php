<?php
class Prescription extends \Eloquent {
	protected $fillable = ['id','patient_id','doctor_id','doctor_comment','symptoms','treatment','medicine','disease','needed_reports'];

	public $errors;
	public $timestamp=true;
	protected $table = 'prescription';

}