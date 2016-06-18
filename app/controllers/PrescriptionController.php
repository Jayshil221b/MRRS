<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
class PrescriptionController extends \BaseController
{

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		if (Auth::guest()) return Redirect::to('login');
		if (Auth::check()){
			$id = Auth::user()->role_id;
			$userid=Auth::user()->id;
		}
		if($id=='4'){
			$users = $this->user->all();
		}else{
			$usersdetails=User::find($userid);
			$users=$usersdetails->toArray();
		}
		//print_r($users->count());exit;

		if($id=='1'){
			$doctor=DB::table('doctors')->where('user_id', $userid)->first();
			//$clinic=DB::table('clinic_detail')->where('user_id', $userid)->first();
			//	print_r($doctorRecord);exit;
			//$doctor=$doctorRecord->toArray();
		 if(isset($doctor->id) && $doctor->id!=""){
		 	$clinic=DB::table('clinic_detail')->where('doctor_id', $doctor->id)->first();
		 }else{
		 	$clinic = array();
		 }
		 //$clinic = $clinicRecord->toArray();
		 return View::make('users.index', ['users' => $users,'doctor'=>$doctor,'clinic'=>$clinic]);
		}elseif($id=='3'){
			$laboratory=DB::table('laboratory_detail')->where('user_id', $userid)->first();
		 	print_r($laboratory);exit;
		 //$clinic = $clinicRecord->toArray();
		 return View::make('users.index', ['users' => $users,'laboratory'=>$laboratory]);
		 
		}else{
			return View::make('patient.index', array('users' => $users));
		}
	}

	public function  show($username)
	{
		if (Auth::guest()) return Redirect::to('login');
		$user = $this->user->whereUsername($username)->first();
		return View:: make('users.show', ['user' => $user]);
	}

	public function create()
	{
		$rolelist = DB::table('roles')->select('*')->get();
		//return 'show form to create users..';
		return View::make('users.create', ['roles' => $rolelist]);
	}

	public function store()
	{
		$input = Input::all();
		
		//print_r($input);exit;
		DB::table('prescription')->insert(array(
		'patient_id' => Input::get('patient_id'),
		'doctor_id' => Auth::user()->id,
		'disease' => Input::get('disease'),
		'treatment' => Input::get('treatment'),
		'symptoms' => Input::get('symptoms'),
		'medicine' => Input::get('medicine'),
		'doctor_comment' => Input::get('doctor_comment'),
		'needed_reports' => Input::get('needed_reports')
		));

		return Redirect::route('patient.index',['id'=>Input::get('patient_id')]); 
	}
	
	public function Reportstore()
	{
		$input = Input::all();
	
		//print_r($input);exit;
		DB::table('reports')->insert(array(
		'patient_id' => Input::get('patient_id'),
		'user_id' => Auth::user()->id,
		'report_name' => Input::get('report_name'),
		'summary' => Input::get('report_summary'),
		));
	
		return Redirect::route('patient.index',['id'=>Input::get('patient_id')]);
	}


	public function getUsername($role_id){
		$rand = rand(0000,9999);

		if($role_id==1){
			$username='dr_'.$rand;
		}
		elseif($role_id==2){
			$username='pt_'.$rand;
		}elseif($role_id==3){
			$username='st_'.$rand;
		}
		elseif($role_id==4){
			$username='ad_'.$rand;
		}
		$users = $this->user->all();
		foreach ($users as $user){
			if($user->username == $username){
				$this->getUsername($role_id);
			}
		}
		return $username;
	}
	public function edit($id)
	{
		$rolelist = DB::table('roles')->select('*')->get();
		$user = DB::table('users')->where('id', '=', $id)->get();
		return View::make('users.edit', ['user' => $user, 'roles' => $rolelist]);
	}

	public function update()
	{
		if(Auth::guest()) return Redirect::to('login');
		$input=Input::all();
		//print_r($input);exit;
		if($input['email']=='')
		{
			$input['email']='xyz@gmail.com';
		}
		if (!$this->user->fill($input)->isValid2())
		{
			//print_r($this->user->errors);exit;
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}
		else
		{
			$mail=$input['email1'];
			$uid = Input::get('user_id');
			$pwd = Hash::make(Input::get('password'));
			$cpwd = Hash::make(Input::get('confirmpassword'));
			if (Input::get('role_id') == '')
			{
				$rid = Input::get('role_id1');
			}
			else
			{
				$rid = Input::get('role_id');
			}

			User::where('id', '=', $uid)
			->update(array('firstname' => Input::get('firstname'),
			'role_id' => $rid,
			'lastname' => Input::get('lastname'),
			'email' => $mail,
			'password' => $pwd,
			'confirmpassword' => $cpwd
			));
		}
		return Redirect::back()->with('message','Update Asset insurance Successful !');
	}
}
?>