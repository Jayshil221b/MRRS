<?php
    use Illuminate\Support\Facades\Input;
class SessionsController extends BaseController
    {
        protected $user;

        public  function __construct(User $user)
        {
            $this->user=$user;
        }


        public function create()
        {
            if(Auth::check()) return Redirect::to('users');

            return View::make('Sessions.create');
        }

        public function store()
        {
            if (User::count() == 0)
            {
         	
                return Redirect::to('users/create');
            }
             if(!$this->user->fill(Input::only('email','password'))->isValid1())
            {
            	return Redirect::back()->with('flash_error', 'Your email/password combination is incorrect.')->withInput();
            } 
            
        	$usernameinput=Input::get('email');
            $password=Input::get('password');
            //check username or email.
            $field = filter_var($usernameinput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if(Auth::attempt(array($field => $usernameinput, 'password' => $password)))
            {
                $message="Welcome! Login successful.";
                return Redirect::route('users.index')->with('message',$message);
            }
            else
            {
            	return Redirect::back()->with('flash_error', 'Your email/password combination is incorrect.')->withInput();
            }
        }
        public function destroy()
        {
        	Session::flush();
            //Auth::logout();
            
            return Redirect::route('sessions.create');
        }
        public function patientdashboard(){
        	
        }
    }


?>