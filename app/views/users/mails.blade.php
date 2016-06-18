<!-- form to add new features like RAM for the laptop and pc,Screen For PC, House for the real estate  -->

@extends('layouts.user')

@section('blackbar')
    <h1>Mailing Detail</h1>
@stop

@section('content')
         <div class="section">
                <div class="container">
                    <div class="col-md-4 col-sm-6"></div>
                    <div class="col-md-4 col-sm-6 row">
                            <div class="">
                                <div class="basic-login">

                                <script type="text/javascript">
                                      document.getElementById('created_at').value = Date();
                                      document.getElementById('updated_at').value = Date();
                                </script>

                                    {{Form::open(['route' => 'mails.store'])}}

                                       <div class="form-group">
                                            {{Form::label('semail','Sender Email:(xyz@gmail.com)') }}
                                            {{Form::email('semail',$mail[0]->semail, array('class' => 'form-control'))}}
                                            {{$errors->first('semail','<span class=error>:message</span>')}}
                                       </div>

                                       <div class="form-group">
                                           {{Form::label('sendername','Sender Recipient name:') }}
                                           {{Form::text('sendername',$mail[0]->sendname, array('class' => 'form-control'))}}
                                           {{$errors->first('email','<span class=error>:message</span>')}}
                                      </div>

                                       <div class="form-group">
                                            {{Form::label('password','Password of Sender Email:') }}
                                            {{Form::password('password', array('class' => 'form-control'))}}
                                            {{$errors->first('password','<span class=error>:message</span>')}}
                                       </div>

                                       <div class="form-group">
                                             {{Form::label('remail','Email for Reply:') }}
                                             {{Form::email('remail',$mail[0]->remail, array('class' => 'form-control'))}}
                                             {{$errors->first('remail','<span class=error>:message</span>')}}
                                       </div>

                                       <div class="form-group">
                                            {{Form::label('replyname','Reply Recipient name:') }}
                                            {{Form::text('replyname',$mail[0]->replyname, array('class' => 'form-control'))}}
                                            {{$errors->first('replyname','<span class=error>:message</span>')}}
                                      </div>

                                              {{Form::submit('Update Detail',array('class' => 'btn pull-right')) }}
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
@stop