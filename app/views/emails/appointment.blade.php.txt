<?php
$fname = Input::get('firstname');

//$uniq=Input::get('password123');

$date_time = date("F j, Y, g:i a");
$userIpAddress = Request::getClientIp();

//print_r($username);exit;
?>


<p>Dear <?php echo ucwords($fname);?>,<br/> Your username for login in eClinic System is : <b>{{$username}}</b> and your password is <b> {{$password123}} </b></p>