@extends('layouts.user')

@section('blackbar')
    <h1>Edit Profile</h1>
@stop

@section('content')

     <div class="section">
        <div class="container">
            <div class="col-md-4 col-sm-6"></div>
            <div class="col-md-4 col-sm-6 row">
                <div class="">
                    <div class="basic-login">

                    <script type="text/javascript">
                          document.getElementById('updated_at').value = Date();
                    </script>

                        {{Form::open(['route' => 'users.update','method' => 'PATCH','class'=>'stdform'])}}
                            <div class="form-group">
                               {{Form::label('role_id','Assign a role:') }}
                               @foreach($roles as $role)
                                    @if($user[0]->role_id==$role->id)
                                        <?php $r=$role->role; ?>
                                        <?php $id=$role->id; ?>
                                    @endif
                               @endforeach
                               {{Form::text('role_name',$r,array('class' => 'form-control','disabled'))}}
                               {{Form::hidden('role_id1',$id,array('class' => 'form-control'))}}
                               <select id='role_id' name='role_id' class='form-control'>
                                    <option value=''>Select a Role</option>
                                    @foreach($roles as $role)
                                       <option value={{$role->id}}>{{ $role->role }}</option>
                                    @endforeach
                               </select>
                            </div>

                           <div class="form-group">
                                {{Form::label('username','Username:') }}
                                {{Form::text('username',$user[0]->username,array('class' => 'form-control','disabled'))}}
                                {{Form::hidden('user_id',$user[0]->id,array('class' => 'form-control'))}}

                           </div>

                           <div class="form-group">
                                {{Form::label('firstname','Firstname:') }}
                                {{Form::text('firstname',$user[0]->firstname, array('class' => 'form-control'))}}
                                {{$errors->first('firstname','<span class=error>:message</span>')}}

                           </div>

                           <div class="form-group">
                                {{Form::label('lastname','Lastname:') }}
                                {{Form::text('lastname',$user[0]->lastname, array('class' => 'form-control'))}}
                                {{$errors->first('lastname','<span class=error>:message</span>')}}
                           </div>

                           <div class="form-group">
                                 {{Form::label('email','Email:') }}
                                 {{Form::hidden('email1',$user[0]->email, array('class' => 'form-control'))}}
                                 {{Form::email('email',$user[0]->email, array('class' => 'form-control','disabled'))}}
                                 {{Form::hidden('email','', array('class' => 'form-control'))}}
                                  <div id="myID" class="form-group">
                                      <p id="count" align="right">Add more Features-->{{ HTML::image('img/addfeatures.png','insurance',['border'=>"0", 'align'=>"right", 'width'=>"20px", 'height'=>"20px",'onclick'=>"updateCounter( )"]) }}</p>
                                  </div>
                                 {{$errors->first('email','<span class=error>:message</span>')}}
                           </div>

                           <div class="form-group">
                                 {{Form::label('password','Password:') }}
                                 {{Form::password('password', array('class' => 'form-control'))}}
                                 {{$errors->first('password','<span class=error>:message</span>')}}
                           </div>

                           <div class="form-group">
                                 {{Form::label('confirmpassword','Confirm-Password:') }}
                                 {{Form::password('confirmpassword', array('class' => 'form-control'))}}
                                 {{$errors->first('confirmpassword','<span class=error>:message</span>')}}
                           </div>
                                  {{Form::submit('Update Profile',array('class' => 'btn pull-right')) }}
                                  <div class="clearfix"></div>
                           {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
    </div>
    <div>

    </div>
    <div>

    </div>
    <script type="text/javascript">
                i=1;
                var someText='';
                var str='';
            	$("#myID").click(
            		 function () {
            		 someText =  '<div class="form-group"> ' +
                                 '<input type="text" class="form-control" id="email" placeholder="New Email" name="email1">' +
            		             ' </div>';
            		 var newDiv = $("<div>").append(someText);
            		  $("#myID").hide(100);
            		 $(this).before(newDiv);
              }
            )
    </script>

@stop