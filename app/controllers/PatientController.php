
<?php
use Illuminate\Support\Facades\Hash;
//use Symfony\Component\Security\Core\User\User;
class PatientController extends \BaseController
{

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
		//$this->patient=$clinic;
	}

	public function index()
	{
		$id=Input::get('id');
		
		$userdata=User::where('id','=',$id)->get();
	
		$allPrescription=Prescription::where('patient_id','=',$id)->get();

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
		
		$allReports=Report::where('patient_id','=',$id)->get();
		$doctor=User::all();
		$i=0;
		$Reportarray = array();
		if(sizeof($allReports) > 0)
		{
			foreach ($allReports as $report)
			{
				$laboratoryDetail=Laboratry::where('staff_id','=',$report->user_id)->get();
		
				$Reportarray['report'][$i] = array(
						"lab_name" => $laboratoryDetail[0]->laboratory_name,
						"report_name" => $report->report_name,
						"summary" => $report->summary,
						"date" => $report->created_at
				);
		
				$i++;
			}
		}
		
		$laboratory="";
		if(Auth::user()->role_id == '3')
			$laboratory=Laboratry::where('staff_id','=',Auth::user()->id)->first();
		
		return View::make('patient.index', ['users' => $userdata,'allPrescription'=>$array,'allReport'=>$Reportarray,'laboratory'=>$laboratory,'doctor'=>$doctor]);
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
		'user_id'=>Auth::user()->id,
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
		//print_r($doctor);exit;
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

		return Redirect::back()->with('message','Update Asset insurance Successful !');
	}
	public function recentpatient(){
		$recent=Prescription::where('doctor_id','=',Auth::user()->id)->groupby('patient_id')->get();
		$i=0;
		$array = array();
		if(sizeof($recent) > 0)
		{
			foreach ($recent as $prescription)
			{
				$doctorName = User::where('id','=',$prescription->doctor_id)->get();
				$patientName = User::where('id','=',$prescription->patient_id)->get();
				
				$array['prescription'][$i] = array(
						"dr_name" => $doctorName[0]->firstname ." ". $doctorName[0]->lastname ,
						"pt_name" => $patientName[0]->firstname ." ". $patientName[0]->lastname ,
						"last_visited" => $prescription->created_at,
						"disease" => $prescription->disease,
						"pt_id" => $prescription->patient_id
				);
				
				$i++;
			}
		}
		
		return View::make('patient.recentpatient',['patients'=>$array]);
	}
	
	
	public function search(){
		return View::make('patient.search');
	}
	
	public function searchPatient(){

		$input=Input::all();
		$patient = $input['patient'];
		$field = filter_var($patient, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		
		$searchnewpatient=User::where($field,'=',$patient)->where('role_id','=','2')->get();
		
		if(!sizeof($searchnewpatient)>0){
			$array['patient']= array("noPatient" => "No Patient Exist");
		}else{
		
			$recent=Prescription::where('patient_id','=',$searchnewpatient[0]->id)->orderby('id','desc')->get();
			
			$i=0;
			$array = array();
			if(sizeof($recent) > 0)
			{
			
					$doctorName = User::where('id','=',$recent[0]->doctor_id)->get();
			
					$array['patient'] = array(
							"dr_name" => $doctorName[0]->firstname ." ". $doctorName[0]->lastname ,
							"pt_name" => $searchnewpatient[0]->firstname ." ". $searchnewpatient[0]->lastname ,
							"last_visited" => $recent[0]->created_at,
							"disease" => $recent[0]->disease,
							"pt_id" => $recent[0]->patient_id
					);
			
			}else{
				$array['patient'] = array(
						"pt_name" => $searchnewpatient[0]->firstname ." ". $searchnewpatient[0]->lastname,
						"pt_id" => $searchnewpatient[0]->id
				);
			}
		}
		return $array;
	}
	
	public function appointment(){
		$dr_id=Input::get('dr_name');
		$date=Input::get('date');
		$patientname=Input::get('patient_id');
		$user=User::where('id',$dr_id)->first();
		//print_r($user['email']);exit;
		$patient_name=User::where('id',$patientname)->first();
		

		DB::table('appointments')->insert(array(
		'doctor_id' => $dr_id,
		'patient_id'=>$patientname,
		'datetime'=>$date,
		'status'=>'0'
		));
		
		$array1= array('date'=>$date,'username'=>$patient_name['username']);
		
		Mail::send('emails.appointment', $array1, function($message) use ($date,$user)
			{
				$message->from('jayshil221b@gmail.com', 'eCLINIC');
				$message->to($user['email'], 'eCLINIC')->subject('Patient Appointment');
			});  
			
			return "Your appointment request has been sent to doctor for approval. Once doctor approve your request you will be notified on the email address you have provided in the system.";

			}
}
?>
































































































































































































































































