@extends('layouts.default')
@section('title')
	Dashboard
@stop

@section('content')
		<div id="contentwrapper" class="contentwrapper">
                 <?php if(sizeof($patients) > 0){ 
                 	
                 	//$i = 0;
                 	foreach($patients as $patient){
						foreach($patient as $patdetail){?>       
                <div class="contenttitle2" style="width: 98%;">
					<h3><a href="/patient?id=<?php echo $patdetail['pt_id']?>" >{{$patdetail['pt_name']}}</a></h3>
					<br />
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td style="width: 11%;"><b>Last Visited Doctor: </b></td>
								<td style="width: 25%;">Dr. {{$patdetail['dr_name']}} </td>
								<td style="width: 10%;"><b>Last Visited at: </b></td>
								<td>{{$patdetail['last_visited']}}</td>
							</tr>
							
							<tr>
								<td><b>Disease: </b></td>
								<td>{{$patdetail['disease']}}</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
					
                </div><!--contenttitle-->
                <?php
                		//$i++; 
                		//print_r($i);
					}}
				}else{?>
					<div class="profiletitle">
						<h1 class="pagetitle">No recent patient found.</h1>
					</div>
				<?php }?>
                <br /><br />
                
          	</div>

@stop

