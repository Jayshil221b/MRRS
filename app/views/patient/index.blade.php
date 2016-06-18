
@extends('layouts.default') @section('title') Dashboard @stop

@section('content')
<?php use Illuminate\Support\Facades\Auth; //print_r($users);exit;?>

<div id="contentwrapper" class="contentwrapper">

	<div class="contenttitle2" style="width: 98%;">
		<h3>
			<?php // print_r($users);exit;?>
			<?php if($users[0]->role_id=="2") echo "PT. "?>
			{{$users[0]->firstname." ".$users[0]->lastname }}
		</h3>

		<div align="right">
			@if(Auth::user()->role_id=='2') @if(isset($users))
			<button onclick="location.href= '/patient/{{$users[0]->id}}/edit';"
				class="stdbtn btn_orange">Edit Details</button>
			@else
			<button onclick="location.href= '/patient/create';"
				class="stdbtn btn_orange">Add Details</button>
			@endif @endif
		</div>
	</div>
	<!--contenttitle-->

	<table cellpadding="0" cellspacing="0" border="0" class="stdtable">
		<colgroup>
			<col class="con0" />
			<col class="con1" />
		</colgroup>
		<thead>
			<tr>
				<td>User Name</td>
				<td>@if(isset($users)) {{$users[0]->username}} @endif</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>@if(isset($users)) {{$users[0]->email}} @endif</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	<br/><br/>
	<div>
	<?php if(Auth::user()->role_id=="2"){?>
	<p>
                        	<div class="title"><h3>Doctor</h3></div>
                            	<select id='doctor_id' name='doctor_id' class="input-sm">
                                   <option value=''>Select a Doctor</option>
                                    @foreach($doctor as $doctor)
                                       <option 
                                       value="{{$doctor->id}}"  >
                                       				{{ $doctor->firstname }} {{$doctor->lastname}}
                                       	</option>
                                    @endforeach
                               	</select>     	
                        </p>
					 <div class="widgetbox" style="display:none;">
                            <div class="title"><h3>Select Appointment Date</h3></div>
                            <div class="widgetcontent">
							<div id="calendar"></div>
          
                            </div><!--widgetcontent-->
                        </div><!--widgetbox-->
	<?php }?>
		<h3>Patient History</h3>
	</div>
	<br />
	<?php if(sizeof($allPrescription) > 0) {
			
			foreach ($allPrescription as $prescriptions){
				foreach ($prescriptions as $prescription ) {?>
	
		<table id="predcription_detail" cellpadding="0" cellspacing="0" border="0" class="stdtable">
			<colgroup>
				<col class="con0" />
				<col class="con1" />
			</colgroup>
			<tbody>
				<tr>
					<td>Doctor Name</td>
					<td>{{$prescription['dr_name']}}</td>
				</tr>
				<tr>
					<td>Last Visited</td>
					<td>{{$prescription['last_visited']}}</td>
				</tr>
				<tr>
					<td>Disease</td>
					<td>{{$prescription['disease']}}</td>
				</tr>
				<tr>
					<td>Symptoms</td>
					<td>{{$prescription['symptoms']}}</td>
				</tr>
				<tr>
					<td>Treatment</td>
					<td>{{$prescription['disease']}}</td>
				</tr>
				<tr>
					<td>Medicine</td>
					<td>{{$prescription['medicine']}}</td>
				</tr>
				<tr>
					<td>Additional Comment</td>
					<td>{{$prescription['dr_comment']}}</td>
				</tr>
				<tr>
					<td>Report Suggested By Doctor</td>
					<td>{{$prescription['report']}}</td>
				</tr>
			</tbody>
		</table>
		<br/><br/>
	<?php   }
		}
		
	}?>
	<br/><br/>
	
	<?php if(Auth::user()->role_id=='3'){
		if(sizeof($allReport) > 0) {
	
			
			foreach ($allReport as $reports){
				foreach ($reports as $report ) {?>
	
		<table id="predcription_detail" cellpadding="0" cellspacing="0" border="0" class="stdtable">
			<colgroup>
				<col class="con0" />
				<col class="con1" />
			</colgroup>
			<tbody>
				<tr>
					<td>Laboratory Name</td>
					<td>{{$report['lab_name']}}</td>
				</tr>
				<tr>
					<td>Report Name</td>
					<td>{{$report['report_name']}}</td>
				</tr>
				<tr>
					<td>Summary</td>
					<td>{{$report['summary']}}</td>
				</tr>
				<tr>
					<td>Report Date</td>
					<td>{{$report['date']}}</td>
				</tr>
			</tbody>
		</table>
		<br/><br/>
	<?php   }
		}
		}
	}?>
	<br/><br/>
	
	<?php if(Auth::user()->role_id==1){?>
	<div>
		<h3>Add Your Prescription</h3>
	</div>
	<br /> <br />
	{{Form::open(['route' => 'prescription.store' , 'id' =>'addPrescription', 'class'=>'stdform'])}}
	<table id="predcription_detail" cellpadding="0" cellspacing="0" border="0" class="stdtable">
		<colgroup>
			<col class="con0" />
			<col class="con1" />
		</colgroup>
		<tbody>
			<tr>
				<td>Doctor Name</td>
				<td>{{Auth::user()->firstname. " " .Auth::user()->lastname}}</td>
			</tr>
			<tr>
				<td>Disease</td>
				<td><span class="field"><input type="text" name="disease" id="disease" class="smallinput" style="width: 60%;" /></span></td>
			</tr>
			<tr>
				<td>Symptoms</td>
				<td><span class="field"><input type="text" name="symptoms" id="symptoms" class="smallinput" style="width: 60%;" /></span></td>
			</tr>
			<tr>
				<td>Treatment</td>
				<td><span class="field"><textarea name="treatment" id="treatment" class="smallinput" style="width: 60%;"></textarea></span></td>
			</tr>
			<tr>
				<td>Medicine</td>
				<td><span class="field"><textarea name="medicine" id="medicine" class="smallinput" style="width: 60%;"></textarea></span></td>
			</tr>
			<tr>
				<td>Additional Comment</td>
				<td><span class="field"><textarea name="doctor_comment" id="doctor_comment" class="smallinput" style="width: 60%;"></textarea></span></td>
			</tr>
			<tr>
				<td>Needed Report</td>
				<td><span class="field"><textarea name="needed_reports" id="needed_reports" class="smallinput" style="width: 60%;"></textarea></span></td>
			</tr>
		</tbody>
	</table>
	<br /> <br />
	{{Form::hidden('patient_id',$users[0]->id,array('class' => 'form-control'))}}
	{{Form::submit('Add Prescription',array('class' => 'stdbtn btn_orange')) }}
	{{Form::close()}}
	<br /> <br />
	<?php }//print_r($users[0]->id);exit;?>
	<?php if(Auth::user()->role_id==3){?>
	<div>
		<h3>Add Patient's Report Detail</h3>
	</div>
	<br /> <br />
	{{Form::open(['route' => 'prescription.Reportstore' , 'id' =>'addReport', 'class'=>'stdform'])}}
	<table id="predcription_detail" cellpadding="0" cellspacing="0" border="0" class="stdtable">
		<colgroup>
			<col class="con0" />
			<col class="con1" />
		</colgroup>
		<tbody>
			<tr>
				<td>Laboratory Name</td>
				<td><?php if(isset($laboratory)) echo $laboratory['laboratory_name'];?></td>
			</tr>
			<tr>
				<td>Report Name</td>
				<td><span class="field"><input type="text" name="report_name" id="report_name" class="smallinput" style="width: 60%;" /></span></td>
			</tr>
			<tr>
				<td>Summary</td>
				<td><span class="field"><textarea name="report_summary" id="report_summary" class="smallinput" style="width: 60%;"></textarea></span></td>
			</tr>
		</tbody>
	</table>
	<br /> <br />
	{{Form::hidden('patient_id',$users[0]->id,array('class' => 'form-control','id'=>'patient_id'))}}
	{{Form::submit('Add Report Detail',array('class' => 'stdbtn btn_orange')) }}
	{{Form::close()}}
	<br /> <br />
	<?php }//print_r($users[0]->id);exit;?>
	
	
</div>
 
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
   
   
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.5.4/fullcalendar/fullcalendar.min.js'></script>
    <link rel='stylesheet' type='text/css' href='http://arshaw.com/js/fullcalendar-1.5.4/fullcalendar/fullcalendar.css' />
<script>
jQuery(document).ready(function() {
	
	var mintime,maxtime;
	$('#doctor_id').on('change', function() {
		$("#calendar").empty();
		jQuery.ajax({
			url:"/doctor/timing",
			data: {dr_name:document.getElementById('doctor_id').value}
		}).done(function(data) {
			mintime=data.clinic_open_time;
			maxtime=data.clinic_close_time;
			$("#calendar").append();
			$(".widgetbox").css('display','block');
			var calendar = jQuery('#calendar').fullCalendar({
			    defaultView: 'agendaWeek',
			    editable: true,
			    selectable: true,
			    events:{
				    url:'getappointments',
				    type:'GET',
				    data:{doctor_id:document.getElementById('doctor_id').value},
			    	error:function(){
			    	}
		    	},
			    minTime:mintime,
			    maxTime:maxtime,
			    type: "POST",
			    //header and other values
			    select: function(start, end, allDay) {
			       
			        if($('#doctor_id :selected').text()=='Select a Doctor'){
			            alert("Please select a doctor");
			            return false;
			        }
			        endtime = $.fullCalendar.formatDate(end,'h:mm tt');
			        starttime = $.fullCalendar.formatDate(start,'ddd, MMM d, h:mm tt');
			        var check=$.fullCalendar.formatDate(start,'yyyy-MM-dd');
			        var today=$.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');

			        var patient_id=<?php echo $users[0]->id;?>;
			        var mywhen = starttime + ' - ' + endtime;
			        jQuery.ajax({
						url:"/patient/appointment",
						data: {date: mywhen,dr_name:document.getElementById('doctor_id').value,patient_id:patient_id}
					}).done(function(msg) {
						  alert(msg);
					});
			        $('#calendar').fullCalendar('unselect');
			     }
			  
			  });
			});
		});


	function doSubmit(){
	 
	 
	 }
    });
		
</script>
@stop

