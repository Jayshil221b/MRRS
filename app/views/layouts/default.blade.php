<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html
	xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from demo.themepixels.com/webpage/amanda/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 11:51:21 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title') | eClinic</title> 
{{HTML::style('css/style.default.css')}} 
{{HTML::script('js/plugins/jquery-1.7.min.js') }} 
{{HTML::script('js/plugins/jquery-ui-1.8.16.custom.min.js') }} 
{{HTML::script('js/plugins/jquery.cookie.js') }} 
{{HTML::script('js/plugins/jquery.uniform.min.js') }} 
{{HTML::script('js/plugins/jquery.dataTables.min.js') }} 
{{HTML::script('js/plugins/jquery.flot.min.js') }} 
{{HTML::script('js/plugins/jquery.flot.resize.min.js') }} 
{{HTML::script('js/plugins/jquery.slimscroll.js') }} 
{{HTML::script('js/custom/general.js') }} 
{{HTML::script('js/custom/dashboard.js') }} 
{{HTML::script('js/custom/tables.js') }} 
{{HTML::script('js/custom/widgets.js') }}
{{HTML::script('js/custom/forms.js') }}


<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/plugins/excanvas.min.js"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>
<?php 
if (Auth::check()){
		$id = Auth::user()->id;
		$currentuser = User::find($id);
		$is_admin=$currentuser->isadmin;
	}
	?>
<body class="withvernav">

	<div class="bodywrapper">
		<div class="topheader">
			<div class="left">
				<h1 class="logo">eCLINIC</h1>
				<span class="slogan">Document less medical system</span>

				
				<!--search-->

				<br clear="all" />

			</div>
			<!--left-->

			<div class="right">
				<!-- 	<div class="notification">
                <a class="count" href="ajax/notifications.html"><span>9</span></a>
        	</div>  -->
				<div class="userinfo">
					<img src="images/thumbs/avatar.png" alt="" /> <span><?php if (Auth::check()){
						$id = Auth::user()->id;
							
						$currentuser = User::find($id);
						$username=ucwords($currentuser->firstname)." ".ucwords($currentuser->lastname);
						echo $username;
					}
					?></span>
				</div>
				<!--userinfo-->

				<div class="userinfodrop">
					<div class="avatar">
						<a href="#"><img src="images/thumbs/avatarbig.png" alt="" /> </a>
					</div>
					<!--avatar-->
					<div class="userdata">
						<h4>
							<?php if (Auth::check()){
								$id = Auth::user()->id;
									
								$currentuser = User::find($id);
								$username=ucwords($currentuser->firstname)." ".ucwords($currentuser->lastname);
								echo $username;
							}
							?></h4>
						<span class="email"><?php if (Auth::check()){
							$id = Auth::user()->id;

							$currentuser = User::find($id);
							$email=$currentuser->email;
							echo $email;
						}
						?></span>
						<ul>
							<li><a
								href="/users/<?php if (Auth::check()){ $id = Auth::user()->id;echo $id;}?>/edit">Edit
									Profile</a></li>
							<!--    <li><a href="accountsettings.html">Account Settings</a></li>  -->
							<!--    <li><a href="help.html">Help</a></li>  -->
							<li><a href="/logout">Sign Out</a></li>
						</ul>
					</div>
					<!--userdata-->
				</div>
				<!--userinfodrop-->
			</div>
			<!--right-->
		</div>
		<!--topheader-->
		<?php if (Auth::check()){
							$id = Auth::user()->id;

							$currentuser = User::find($id);
							$role=$currentuser->role_id;
							if($role=='1'){
						
						?>
		<div class="vernav2 iconmenu">
			<ul>
				<li><a href="/users" class="btn_home">Dashboard</a></li>
				<li><a href="/patient/recentpatient" class="gallery">Recent Patient</a></li>
				<li><a href="/patient/search" class="elements">Search New Patient</a></li>
				<li><a href="/users/create" class="widgets">Create New Patient</a></li>
				<li><a href="/users" class="support">Patient Detail View</a></li>
				<span class="arrow"></span>
			</ul>
			<a class="togglemenu"></a> <br /> <br />
		</div>
		<?php }elseif($role=='3'){?>
		<div class="vernav2 iconmenu">
			<ul>
				
		<li><a href="/users" class="btn_home">Dashboard</a></li>
		<li><a href="/patient/search" class="elements">Search New Patient</a></li>
		</ul>
			<a class="togglemenu"></a> <br /> <br />
		</div>
<?php 		}else{?>
		<div class="vernav2 iconmenu">
			<ul>
				<li><a href="/users" class="editor">Dashboard</a></li>
						<span class="arrow"></span>
			</ul>
			<a class="togglemenu"></a> <br /> <br />
		</div>
		<!--leftmenu-->
			<?php }}?>
		<div class="centercontent">@yield('content')</div>
		<!-- centercontent -->


	</div>
	<!--bodywrapper-->

</body>

<!-- Mirrored from demo.themepixels.com/webpage/amanda/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 11:51:58 GMT -->
</html>
