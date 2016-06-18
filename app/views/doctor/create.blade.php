<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from demo.themepixels.com/webpage/amanda/forms.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 11:53:13 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Add Details </title>

{{ HTML::style('css/style.default.css') }}
{{ HTML::style('css/jquery.timepicker.css') }}
{{ HTML::style('css/bootstrap-datepicker.css') }}
{{ HTML::style('css/site.css') }}


{{ HTML::script('js/plugins/jquery-1.7.min.js') }}
{{ HTML::script('js/plugins/jquery-ui-1.8.16.custom.min.js') }}
{{ HTML::script('js/jquery.timepicker.js') }}
{{ HTML::script('js/bootstrap-datepicker.js') }}
{{ HTML::script('js/site.js') }}
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
            <h1 class="pagetitle">Add Detail</h1>
            <span class="pagedesc">Add clinic detail</span>
            
        </div><!--pageheader-->
        
            
            <div>
            	
            	{{Form::open(['route' => 'doctor.store' , 'id' =>'doctordetails', 'class'=>'stdform'])}}
						
						<p>
                        	<label>Mobile Number</label>
                            <span class="field"><input type="text" name="mbnumber" id="mbnumber" class="smallinput" /></span>
                        </p>
                        
                        <p>
                        	<label>Specialization</label>
                            <span class="field"><input type="text" name="specialization" id="specialization" class="smallinput" /></span>
                        </p>            	
                        
                        <p>
                        	<label>Clinic Name</label>
                            <span class="field"><input type="text" name="clinic_name" id="clinic_name" class="smallinput" /></span>
                        </p>
                        
                        <p>
                        	<label>Address</label>
                            <span class="field"><textarea name="address" id="address" class="smallinput"></textarea></span>
                        </p>
                        
                        <p>
                        	<label>Clinic Phone</label>
                            <span class="field"><input type="text" name="phn" id="phn" class="smallinput" /></span>
                        </p>
                        
                        <p>
                        	<label>Clinic Open Time</label>
                            <span class="field"><input type="text" name="openTime" id="openTime" class="smallinput" /></span>
                        </p>
			            
                        <p>
                        	<label>Clinic Close Time</label>
                            <span class="field"><input type="text" name="closeTime" id="closeTime" class="smallinput" /></span>
                        </p>
                        
                        <br />
                        
                        <p class="stdformbutton">
                        
                        {{Form::submit('Add Detail',array('class' => 'stdbtn btn_orange')) }}
                        </p>
				{{Form::close()}}
            </div><!--subcontent-->
        
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

<!-- Mirrored from demo.themepixels.com/webpage/amanda/forms.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 11:53:18 GMT -->
</html>
