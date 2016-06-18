<?php

class Role extends \Eloquent {
	protected $fillable = ['role_id','permission_id','role_name'];

	public $errors;
	public $timestamp=true;
	public static $rules = [
		'role_name' => 'required',
	];

	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if ($validation->passes()) {
			return true;
		}
		$this->errors = $validation->messages();

		return false;
	}

	protected $table = 'rolesandpermissions';
}