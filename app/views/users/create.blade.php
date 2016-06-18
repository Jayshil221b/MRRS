<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from demo.themepixels.com/webpage/amanda/forms.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 11:53:13 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Create User </title>

{{ HTML::style('css/style.default.css') }}


{{ HTML::script('js/plugins/jquery-1.7.min.js') }}
{{ HTML::script('js/plugins/jquery-ui-1.8.16.custom.min.js') }}
{{ HTML::script('js/plugins/jquery.cookie.js') }}
{{ HTML::script('js/plugins/jquery.uniform.min.js') }}
{{ HTML::script('js/plugins/jquery.validate.min.js') }}
{{ HTML::script('js/plugins/jquery.tagsinput.min.js') }}
{{ HTML::script('js/plugins/charCount.js') }}
{{ HTML::script('js/plugins/ui.spinner.min.js') }}
{{ HTML::script('js/plugins/chosen.jquery.min.js') }}
{{ HTML::script('js/custom/general.js') }}
{{ HTML::script('js/custom/forms.js') }}

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

<body class="">

<div class="bodywrapper">
    
        
    <div class="">
    
        <div class="pageheader">
            <h1 class="pagetitle">Register</h1>
            <span class="pagedesc">Register into eClinic document less medical system by filling this form</span>
            
        </div><!--pageheader-->

            	{{Form::open(['route' => 'users.store' , 'id' =>'createUserForm', 'class'=>'stdform'])}}
            	
	            	@if ($errors->first('email') != null)
						<p>
							<label><div class="notibar msgerror" style="width:34%">
								<p>{{ $errors->first('email') }}</p>
							</div></label>
						</p>
					@endif
                    <!-- <form id="form1" class="stdform" method="post" action="#">  -->
                    	<p>
                        	<label>Role</label>
                            <span class="field">
                            	<select id='role_id' name='role_id' class="smallinput" <?php if(Auth::check()){ if(Auth::user()->role_id == '1'){ 
                                       					?> 
                                       					<?php }}?> onchange="roleChange();" >
                                   <option value=''>Select a Role</option>
                                    @foreach($roles as $role)
                                       <option 
                                       value="{{$role->id}}" <?php if(Auth::check()){ if(Auth::user()->role_id == '1'){ 
                                       					if($role->id!=2){?> disabled
                                       					<?php }else{ ?> selected <?php }}}?> >
                                       				{{ $role->role }}
                                       	</option>
                                    @endforeach
                               	</select>
                        	</span>       	
                        </p>
                        
                        <p>
                        	<label>First Name</label>
                            <span class="field"><input type="text" name="firstname" id="firstname" class="smallinput" /></span>
                        </p>
                        
                        <p>
                        	<label>Last Name</label>
                            <span class="field"><input type="text" name="lastname" id="lastname" class="smallinput" /></span>
                        </p>
                        
                        <p id="laboratoryNameDiv" style="display:none;">
                        	<label>Laboratory Name</label>
                            <span class="field"><input type="text" name="laboratory_name" id="laboratory_name" class="smallinput" /></span>
                        </p>
                        
                        <p>
                        	<label>Email</label>
                            <span class="field"><input type="text" name="email" id="email" class="smallinput" /></span>
                        </p>
                        
                        <!-- <p>
                        	<label>Password</label>
                            <span class="field"><input type="password" name="password" id="password" class="smallinput" /></span>
                        </p>
                        
                        <p>
                        	<label>Confirm Password</label>
                            <span class="field"><input type="password" name="confirmpassword" id="confirmpassword" class="smallinput" /></span>
                        </p>  -->
                        
                        <br />
                        
                        <p class="stdformbutton">
                        
                        {{Form::submit('Create User',array('class' => 'stdbtn btn_orange')) }}
                        </p>
                    <!-- </form> -->
					{{Form::close()}}
            </div><!--subcontent-->
        
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>
<script>
	function roleChange(){
		var role = document.getElementById('role_id').value;
		if(role == '3')
			jQuery("#laboratoryNameDiv").show();
		else
			jQuery("#laboratoryNameDiv").hide();
	}
</script>
<!-- Mirrored from demo.themepixels.com/webpage/amanda/forms.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 11:53:18 GMT -->
</html>
