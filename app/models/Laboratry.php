<?php
class Laboratry extends \Eloquent {
	protected $fillable = ['id','laboratry_name','address','staff_id','laboratry_phn','laboratry_open_time','laboratry_close_time','type'];

	public $errors;
	protected $table = 'laboratory_detail';

}