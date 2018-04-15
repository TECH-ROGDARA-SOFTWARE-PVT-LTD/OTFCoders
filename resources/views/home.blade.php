@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome Mr. {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    <img src="{{ Auth::user()->image_path }}" height="80px" width="80px" class="pull-right" style="margin-right: 18%;" alt="Picture">
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('updateReg',Auth::user()->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" id="firstNameFGroup">
                            <label for="name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" required  autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                                <span id="firstNameError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}" id="lastNameFGroup">
                            <label for="name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                                <span id="lastNameError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="emailFGroup">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <span id="emailError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}" id="phoneNumberFGroup">
                            <label for="phone_number" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phoneNumber" type="text" class="form-control" name="phone_number" value="{{ Auth::user()->phone_number }}" required  autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                                <span id="phoneNumberError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image_path') ? ' has-error' : '' }}" id="imageFGroup">
                            <label for="image_path" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="imagePath" type="file" class="form-control" name="image_path" required >

                                @if ($errors->has('image_path'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                                <span id="imageError" class="help-block"></span>
                            </div>
                        </div>

                        {{--<div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}" id="passwordFGroup">
                            <label for="oldpassword" class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" required >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                                <span id="passwordError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id="confirmPasswordFGroup">
                            <label for="newpassword" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="newpassword" type="password" class="form-control" name="newpassword" required >
                                <span id="passwordConfirmError" class="help-block"></span>
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="button">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
