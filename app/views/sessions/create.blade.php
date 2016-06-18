@extends('layouts.login') 
@section('content')
<style>
.loginbuttonCustom {
	border: 0 none;
	border-radius: 2px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
	font-family: "RobotoCondensed", Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: normal;
	padding: 15px 0;
	text-align: center;
	text-transform: uppercase;
	width: 100%;
	background: #666666;
  	color: antiquewhite;
}

.loginboxinnerCust {
  padding: 20px;
  -moz-border-radius: 0 2px 2px 0;
  -webkit-border-radius: 0 0 2px 2px;
  border-radius: 0 0 2px 2px;
}

.loginbox .keepCust {
  margin-top: 20px;
  font-weight: bold;
  font-size: 11px;
}

.loginbox .logo p {
  font-weight: bold;
  color: #666 !important; 
  font-style: italic;
}

.loginbox .logo h1 span {
  color: #666 !important;
}

.loginbox {
  width: 350px;
  padding: 5px;
  background: #ededf3 !important;
  margin: 7% auto 0 auto;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0 0 2px rgba(0,0,0,0.3);
  -webkit-box-shadow: 0 0 2px rgba(0,0,0,0.3);
  box-shadow: 0 0 2px rgba(0,0,0,0.3);
}

</style>

<div class="loginbox">
	<div class="loginboxinnerCust">

		<div class="logo">
			<h1>
				<span>eCLINIC</span>
			</h1>
			<p>Document less medical system</p>
		</div>
		<!--logo-->

		<br clear="all" /> <br /> {{Form::open(['route'=>'sessions.store'])}}
		<div class="nousername">

			@if (Session::has('flash_error'))
			<div class="loginmsg" id="flash_error">{{ Session::get('flash_error')}}</div>
			@endif

		</div>

			<!--  <form id="login" action="http://demo.themepixels.com/webpage/amanda/dashboard.html" method="post"> -->

			<div class="username">
				<div class="usernameinner">{{Form::text('email','',array('placeholder' => 'Username/Email'))}}</div>
			</div>

			<div class="password">

				<div class="passwordinner">

					<!-- {{Form::password('password',array('id' => 'password'))}} -->
					{{Form::password('password',array('placeholder' => 'Password'))}}

				</div>
			</div>
			{{Form::submit('Sign In',array('class' => 'loginbuttonCustom')) }}
			
			<br/>
			
			<div class="keepCust">
				<a href="{{{ URL::to('/users/create') }}}" class="keepCust" style="font-size: 16px;">
					Not a member yet? Register Now
				</a>
			</div>

			{{Form::close()}}
			<!-- </form>  -->

		</div>
		<!--loginboxinner-->
	</div>
	<!--loginbox-->
	@stop