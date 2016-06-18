
@extends('layouts.default') @section('title') Dashboard @stop

@section('content')
<?php //print_r($users);exit;?>
<div id="contentwrapper" class="contentwrapper">

	<!--contenttitle-->
		<br/><br/>
	<?php if(Auth::user()->role_id==1 || Auth::user()->role_id==3){?>
	<div>
		<h3>Search Patient</h3>
	</div>
	<br /> <br />
	{{Form::open(['route' => 'patient.search' , 'id' =>'searchPatientForm', 'class'=>'stdform'])}}
		<table id="predcription_detail" cellpadding="0" cellspacing="0" border="0" class="stdtable">
		<colgroup>
			<col class="con0" />
			<col class="con1" />
		</colgroup>
		<tbody>
			<tr>
				<td>Patient UserName/Email</td>
				<td>  {{Form::text('ptusername','', array('class' => 'form-control','id'=>'searchpatient'))}}</td>
			</tr>
		</tbody>
	</table>
	<br /> <br />
	<?php }//print_r($users[0]->id);exit;?>
		{{Form::button('Search Patient',array('class' => 'stdbtn btn_orange','onclick'=>'getsearchedusers();')) }}
	{{Form::close()}}
	<br /> <br />
	<div id="noPatientDiv"display:none;">
		<h3 id="noPatient"></h3>
	</div>
	<div style="width: 98%; display:none;" id="patientDetail">
					<br />
					<h3><a href="" id="patient_name" ></a></h3>
					<br/>
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td style="width: 15%;"><b>Last Visited Doctor: </b></td>
								<td id='doc_name' style="width: 25%;">Dr.  </td>
								<td style="width: 10%;"><b>Last Visited at: </b></td>
								<td id="last_visited"></td>
							</tr>
							
							<tr>
								<td><b>Disease: </b></td>
								<td id="disease"></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
					
                </div>
		</div>
<script type="text/javascript">

function getsearchedusers(){
	var patient=document.getElementById('searchpatient').value;
	jQuery.ajax({
		url:"/patient/searchPatient",
		data:'patient='+patient,
		success:function(data){
			
			if(data.patient.noPatient != null)
			{
				jQuery("#patientDetail").hide();
				jQuery("#noPatientDiv").show();	
				jQuery("#noPatient").html(data.patient.noPatient);
			}else{
				jQuery("#noPatientDiv").hide();
				jQuery("#patientDetail").show();
				jQuery("#patient_name").attr('href','/patient?id='+data.patient.pt_id);
				jQuery("#patient_name").html(data.patient.pt_name);
				jQuery("#doc_name").html(data.patient.dr_name);
				jQuery("#last_visited").html(data.patient.last_visited.date);
				jQuery("#disease").html(data.patient.disease);
				
			}
		}
	});
}
</script>
@stop
