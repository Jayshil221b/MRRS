<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	protected $fillable =['role_id','username','firstname','lastname','email','password'];

	use UserTrait, RemindableTrait;

	public static $rules=[
		'email'=>'required|unique:users,email,{USER_ID}',
		'firstname'=>'required',
		'lastname'=>'required',
		'role_id'=>'required',
	//	'username'=>'required|min:5|unique:users,username',
			];

	public static $rules2=[
		'email'=>'required|unique:users,email,{USER_ID}',
		'firstname'=>'required',
		'lastname'=>'required',
		//'username'=>'required',
		];

	public static $rules1 =[
		'email'=>'required',
		'password'=>'required' 
		];
		 

	public $errors;
	public $errors1;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	public function isValid()
	{
		//This Validation is for  Registration Page
		$validation = Validator::make($this->attributes,static::$rules);
		if($validation->passes())
		{
			return true;
		}
		$this->errors=$validation->messages();
		return false;
	}

	public function isValid2()
	{
		//This Validation is for  Registration Page
		$validation = Validator::make($this->attributes,static::$rules2);
		if($validation->passes())
		{
			return true;
		}
		$this->errors=$validation->messages();
		return false;
	}

	public function isValid1()
	{
		// This validation is for Login Page
		$validation1 = Validator::make($this->attributes,static::$rules1);
		if($validation1->passes())
		{
			return true;
		}
		$this->error=$validation1->messages();
		return false;
	}

 	public function beforeSave($forced)
	{
		if(isset($this->password) && isset($this->confirmpassword) && ($this->password!='') && ($this->confirmpassword!=''))
		{
			$this->password = Hash::make($this->password);
			$this->confirmpassword = Hash::make($this->confirmpassword);
		}
	}

}
