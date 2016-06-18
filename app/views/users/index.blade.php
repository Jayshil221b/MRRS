@extends('layouts.default')
@section('title')
	Dashboard
@stop

@section('content')
		@if(isset($_GET['message']))
			<fieldset style="background:#c8fab8; border:none; font-color:Green; ">
					<h3 align="center">{{$_GET['message']}}</h3></fieldset>
		@endif

		<div id="contentwrapper" class="contentwrapper">
                        
                <div class="contenttitle2" style="width: 98%;">
                	<div class="pageheader">
						<div class="profiletitle">
							<h1 class="pagetitle"><?php if($users['role_id']=="1") echo "DR. "?>{{$users['firstname']." ".$users['lastname'] }}</h1>
							<span class="pagedesc">
								@if(isset($doctor) && isset($doctor->type))
                            		{{$doctor->type}}
                            	@endif
                            </span>
						</div>
						<div align = "right">
	                		@if(isset($doctor))
	                			<button onclick="location.href= '/doctor/{{$doctor->id}}/edit';" class="stdbtn btn_orange">Edit Details</button>
		                  	@else
		                  	<button onclick="location.href= '/doctor/create';" class="stdbtn btn_orange">Add Details</button>
		                    @endif
	                	</div>
					</div>
                </div><!--contenttitle-->
                		
                <table cellpadding="0" cellspacing="0" border="0" class="stdtable">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mobile Number</td>
                            <td>
                            	@if(isset($doctor) && isset($doctor->phn_number))
                            		{{$doctor->phn_number}}
                            	@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Clinic Name</td>
                            <td>
                            	@if(isset($clinic) && isset($clinic->clinic_name))
                            		{{$clinic->clinic_name}}
                            	@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Clinic Address</td>
                            <td>
                            	@if(isset($clinic) && isset($clinic->address))
                            		{{$clinic->address}}
                            	@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Clinic Phone Number</td>
                            <td>
                            	@if(isset($clinic) && isset($clinic->clinic_phn))
                            		{{$clinic->clinic_phn}}
                            	@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Clinic Timing</td>
                            <td>
                            @if(isset($clinic) && isset($clinic->clinic_open_time) && isset($clinic->clinic_close_time))
                            		<span>From &nbsp;</span>{{$clinic->clinic_open_time}}  <span>&nbsp; To &nbsp;</span>  {{$clinic->clinic_close_time}}
                            	@endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br /><br />
                
          	</div>

@stop

@section('blackbar')

	<h1>User List</h1>

                    <script type="text/javascript">
                    $(document).ready(function() {
                    	$('#userstable').DataTable();
                    });
                  	</script>
@stop

