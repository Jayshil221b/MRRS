<?php
use Illuminate\Support\Facades\Hash;
class StaffController extends \BaseController
{


	public function __construct(Laboratry $laboratry)
	{
		$this->laboratry=$laboratry;
	}

	public function index()
	{
		$userid=Auth::user()->id;
		$usersdetails=User::find($userid);
		$users=$usersdetails->toArray();
		
		//$clinic = $clinicRecord->toArray();
		return View::make('staff.index', ['users' => $users,'report'=>$report,'laboratory'=>$laboratory]);
	}

	public function  show($username)
	{
		if (Auth::guest()) return Redirect::to('login');
		$user = $this->user->whereUsername($username)->first();
		return View:: make('users.show', ['user' => $user]);
	}

	public function create()
	{
	//	$rolelist = DB::table('roles')->select('*')->get();
		//return 'show form to create users..';
		return View::make('doctor.create');
	}

	public function store()
	{
		//return 'Create the new user, given the post data..';

		$clinicname = Input::get('clinic_name');
		$address = Input::get('address');
		$phn=Input::get('phn');
		$opentime=Input::get('openTime');
		$closetime=Input::get('closeTime');
		$mobile=Input::get('mbnumber');
		$spl=Input::get('specialization');
		
		$doctor=new Doctor();
		
		$doctor->user_id=Auth::user()->id;
					$doctor->type=$spl;
			$doctor->phn_number=$mobile;
			//print_r($doctor);exit;
			$doctor->save();
			
			//print_r($doctor->id);exit;
		
			DB::table('clinic_detail')->insert(array(
			'clinic_name' => $clinicname,
			'address'=>$address,
			'doctor_id'=>$doctor->id,
			'clinic_phn'=>$mobile,
			'clinic_open_time'=>$opentime,
			'clinic_close_time'=>$closetime
			));
				
		$user=User::where('id','=',Auth::user()->id)->get();
				

			return Redirect::to('login')->with('message', 'Thanks for registering!');
	
		return Redirect::to('users/create');
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
		$laboratory = DB::table('laboratory_detail')->where('id', '=', $id)->get();
		return View::make('staff.edit', ['laboratory' => $laboratory]);
	}

	public function update()
	{
		if(Auth::guest()) return Redirect::to('login');
		$input=Input::all();
		$id=Input::get('id');
		//print_r(Input::get('doctor_id'));exit;
		//print_r($input);exit;	
			Laboratry::where('id','=',$id)->update(array('laboratory_name'=>$input['laboratory_name'],
			'type'=>$input['laboratory_type'],
			'laboratory_open_time'=>$input['openTime'],
			'laboratory_close_time'=>$input['closeTime'],
			'laboratory_phn'=>$input['phn'],
			'address'=>$input['address']));
		
		 return Redirect::route('users.index');
	}
}
?>