<?php
class Doctor extends \Eloquent {
	protected $fillable = ['id','user_id','type','phn_number'];

	public $errors;
	
}