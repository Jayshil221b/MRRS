<?php
use Illuminate\Support\Facades\Hash;
class UserController extends \BaseController
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

		if(isset($doctor->id) && $doctor->id!=""){
			$clinic=DB::table('clinic_detail')->where('doctor_id', $doctor->id)->first();
		}else{
			$clinic = array();
		}
		//$clinic = $clinicRecord->toArray();
		return View::make('users.index', ['users' => $users,'doctor'=>$doctor,'clinic'=>$clinic]);
		}elseif($id=='2'){
			
			$allPrescription=Prescription::where('patient_id','=',$userid)->get();
			$userdata=User::where('id','=',$userid)->get();
			$i=0;
			$array = array();
			if(sizeof($allPrescription) > 0)
			{
				foreach ($allPrescription as $prescription)
				{
					$doctor=Doctor::where('user_id','=',$prescription->doctor_id)->get();
					$doctorName = User::where('id','=',$prescription->doctor_id)->get();
			
					$array['prescription'][$i] = array(
							"dr_name" => $doctorName[0]->firstname ." ". $doctorName[0]->lastname ,
							"last_visited" => $prescription->created_at,
							"treatment" => $prescription->treatment,
							"disease" => $prescription->disease,
							"symptoms" => $prescription->symptoms,
							"medicine" => $prescription->medicine,
							"dr_comment" => $prescription->doctor_comment,
							"report" => $prescription->needed_reports
					);
			
					$i++;
				}
			}
				$doctor=User::where('role_id','1')->get();
			//print_r($userdata);exit;
			return View::make('patient.index', ['users' => $userdata,'allPrescription'=>$array,'doctor'=>$doctor]);
			
		}elseif($id=='3'){
			//$laboratory='';
			//print_r($report);exit;
			if(isset($userid)){
				$laboratory=DB::table('laboratory_detail')->where('staff_id', $userid)->first();
			}else{
				$laboratory = array();
			}
			
			
			return View::make('staff.index', array('users' => $users,'laboratory'=>$laboratory));
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
		//return 'Create the new user, given the post data..';
			$input = Input::all();
		$this->user->fill(Input::all());
		
		if (!$this->user->fill($input)->isValid())
		{
			//print_r($this->user->errors);exit;
			return Redirect::back()->withInput()->withErrors($this->user->errors);
			//return Redirect::back()->with('flash_error', $this->user->errors)->withInput();
		} else
		{
			
			$role_id=Input::get('role_id');
			
			$username = $this->getUsername($role_id);
			
			$uniq = substr(uniqid(),0,7);
			$pass1=Hash::make($uniq);
			$userTable=new User;
			$userTable->username=$username;
			$userTable->role_id=Input::get('role_id');
			$userTable->firstname=Input::get('firstname');
			$userTable->lastname=Input::get('lastname');
			$userTable->email=Input::get('email');
			$userTable->password=$pass1;
			$userTable->save();
		
			if(Input::get('role_id') == '3'){
				DB::table('laboratory_detail')->insert(array(
				'laboratory_name' => Input::get('laboratory_name'),
				'staff_id' => $userTable->id, 
				));
			}
			
			$array1= array('password123'=>$uniq,'username'=>$username);

			Mail::send('emails.password', $array1, function($message) use ($uniq,$username)
			{
				$message->from('poojan6@gmail.com', 'eCLINIC');
				$message->to(Input::get('email'), 'eCLINIC')->subject('eCLinic Registration');
			});  

			//$doctor=DB::table('doctors')->where('user_id', $userid)->first();
			
			if(Auth::check()){
				if(Auth::user()->role_id=='1'){
					$user=User::where('username','=',$username)->get();
					return Redirect::route('patient.index',['id'=>$user[0]->id]);
				}
			}else{
				return Redirect::to('sessions/create')->with('flash_error', 'Thanks for registering! Please, check your email for username and password');
			}
		}
		return Redirect::to('users/create');
	}


	public function getUsername($role_id){
		$rand = rand(0000,9999);
		//print_r($role_id);exit;
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