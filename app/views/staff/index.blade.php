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
							<h1 class="pagetitle"><?php if(isset($laboratory) && isset($laboratory->laboratory_name))?>{{$laboratory->laboratory_name }}</h1>
							<span class="pagedesc">
								@if(isset($laboratory) && isset($laboratory->type))
                            		{{$laboratory->type}}
                            	@endif
                            </span>
						</div>
						<div align = "right">
	                		@if(isset($laboratory))
	                			<button onclick="location.href= '/staff/{{$laboratory->id}}/edit';" class="stdbtn btn_orange">Edit Details</button>
		                  	@else
		                  	<button onclick="location.href= '/staff/{{$laboratory->id}}/edit';" class="stdbtn btn_orange">Add Details</button>
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
                            <td>Laboratory Address</td>
                            <td>
                            	@if(isset($laboratory) && isset($laboratory->address))
                            		{{$laboratory->address}}
                            	@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Laboratory Phone Number</td>
                            <td>
                            	@if(isset($laboratory) && isset($laboratory->laboratory_phn))
                            		{{$laboratory->laboratory_phn}}
                            	@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Laboratory Timing</td>
                            <td>
                            	@if(isset($laboratory) && isset($laboratory->laboratory_open_time) && isset($laboratory->laboratory_close_time))
                            		<span>From &nbsp;</span>{{$laboratory->laboratory_open_time}}  <span>&nbsp; To &nbsp;</span>  {{$laboratory->laboratory_close_time}}
                            	@endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br /><br />
                
          	</div>

@stop