<?php
use Illuminate\Support\Facades\Hash;
class DoctorController extends \BaseController
{

	protected $doctor;

	public function __construct(Doctor $doctor,Clinicdetails $clinic)
	{
		$this->doctor = $doctor;
		$this->clinic=$clinic;
	}

	public function index()
	{
		$doctor=$this->doctor->all();
		//print_r($users->count());exit;
		$clinic=$this->clinic->all();
		//print_r($clinic);exit;
		return View::make('doctor.index', ['doctor' => $doctor,'clinic'=>$clinic]);
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
		$doctor = DB::table('doctors')->where('id', '=', $id)->get();
		$clinic=DB::table('clinic_detail')->where('doctor_id','=',$id)->get();
		return View::make('doctor.edit', ['doctor' => $doctor, 'clinic' => $clinic]);
	}

	public function update()
	{
		if(Auth::guest()) return Redirect::to('login');
		$input=Input::all();
		$doctorid=Input::get('doctor_id');
		//print_r(Input::get('doctor_id'));exit;
		//print_r($input);exit;	
			Clinicdetails::where('doctor_id','=',$doctorid)->update(array('clinic_name'=>$input['clinic_name'],
			'clinic_open_time'=>$input['openTime'],
			'clinic_close_time'=>$input['closeTime'],
			'clinic_phn'=>$input['phn'],
			'address'=>$input['address']));
			
			
			Doctor::where('id', '=', $doctorid)
				->update(array('type' => $input['specialization'],
					'phn_number' => $input['mbnumber']));
		
		 return Redirect::route('users.index');
	}
	
	public function clinicaldetails(){
		$doctor_id=Input::get('dr_name');
		$doctorid=Doctor::where('user_id',$doctor_id)->first();
		$clinicaldetails=Clinicdetails::where('doctor_id',$doctorid->id)->first();
		return $clinicaldetails;
	}
	
	public function getAppointments(){
		$getdoctorid=Input::get('doctor_id');
		$doct=User::where('id',$getdoctorid)->first();
		$appointment=AppointmentDetails::where('doctor_id',$doct->id)->get();
		
		$dataappointment=array();
		$array=array();
		$i=0;
		 foreach($appointment as $key=>$value){
		 	$appointmentdate=explode('-',$appointment[$i]->datetime);
		 	$startdate=date('Y-m-d H:i:s',strtotime($appointmentdate[0]));
		 	$enddate=date('Y-m-d',strtotime($appointmentdate[0]));
		 	$dataappointment['title']=$doct->firstname . ' '. $doct->lastname;
		 	$dataappointment['start']=$startdate;
		 	$dataappointment['end']=$enddate.' '.date('H:i:s',strtotime($appointmentdate[1]));
		 	$dataappointment['allDay']='';
		 	
		 	array_push($array,$dataappointment);
		 	//$dataappointment['enddate']=$appointment[$i]->datetime;
		 	$i++;
		 }
		 
		 return $array;	
	}
}
?>