<?php
class Report extends \Eloquent {
	protected $fillable = ['id','user_id','patient_id','summary'];

	public $errors;
	protected $table = 'reports';

}