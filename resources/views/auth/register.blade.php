@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" name="UserRegistration" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" id="firstNameFGroup">
                            <label for="name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"  autofocus>

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
                                <input id="lastName" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"  autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

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
                                <input id="phoneNumber" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}"  autofocus>

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
                                <input id="imagePath" type="file" class="form-control" name="image_path" >

                                @if ($errors->has('image_path'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                                <span id="imageError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" id="passwordFGroup">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <span id="passwordError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id="confirmPasswordFGroup">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="passwordConfirm" type="password" class="form-control" name="password_confirmation" >
                                <span id="passwordConfirmError" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('validation_choice') ? ' has-error' : '' }}" id="validation_choice">
                            <label for="validation_choice" class="col-md-4 control-label">Validation Choice</label>

                            <div class="col-md-6">
                                <input type = "radio" name="validation_choice" id="HTML5" value="HTML5" checked required>Validation by HTML5 (recommended)<br>
                                <input type = "radio" name="validation_choice" id="laravel" value="laravel">Validation by Laravel<br>
                                <input type = "radio" name="validation_choice" id="jquery" value="jquery">Validation by JQuery and Ajex request
                                <span id="phoneNumberError" class="help-block"></span>
                            </div>
                        </div>


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
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>


    $(document).ready(function(){

        $("#firstName").attr("required","required");
        $("#firstName").attr("pattern","[a-zA-Z\\s]+");
        $("#lastName").attr("required","required");
        $("#lastName").attr("pattern","[a-zA-Z\\s]+");
        $("#email").attr("required","required");
        $("#email").attr("pattern","[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,3}$");
        $("#phoneNumber").attr("required","required");
        $("#phoneNumber").attr("pattern","[0-9]{10}");
        $("#phoneNumber").attr("maxlength","10");
        $("#imagePath").attr("required","required");
        $("#password").attr("required","required");
        $("#passwordConfirm").attr("required","required");

        $("#HTML5").click(function(){
            $("#firstName").attr("required","required");
            $("#firstName").attr("pattern","[a-zA-Z\\s]+");
            $("#lastName").attr("required","required");
            $("#lastName").attr("pattern","[a-zA-Z\\s]+");
            $("#email").attr("required","required");
            $("#email").attr("pattern","[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,3}$");
            $("#phoneNumber").attr("required","required");
            $("#phoneNumber").attr("pattern","[0-9]{10}");
            $("#phoneNumber").attr("maxlength","10");
            $("#imagePath").attr("required","required");
            $("#password").attr("required","required");
            $("#passwordConfirm").attr("required","required");
        });
        $("#laravel").click(function(){
            $("#firstName").removeAttr("required");
            $("#firstName").removeAttr("pattern");
            $("#lastName").removeAttr("required");
            $("#lastName").removeAttr("pattern");
            $("#email").removeAttr("required");
            $("#email").removeAttr("pattern");
            $("#phoneNumber").removeAttr("required");
            $("#phoneNumber").removeAttr("pattern");
            $("#phoneNumber").removeAttr("maxlength");
            $("#imagePath").removeAttr("required");
            $("#password").removeAttr("required");
            $("#passwordConfirm").removeAttr("required");
        });
        $("#jquery").click(function(){
            $("#firstName").removeAttr("required");
            $("#firstName").removeAttr("pattern");
            $("#lastName").removeAttr("required");
            $("#lastName").removeAttr("pattern");
            $("#email").removeAttr("required");
            $("#email").removeAttr("pattern");
            $("#phoneNumber").removeAttr("required");
            $("#phoneNumber").removeAttr("pattern");
            $("#phoneNumber").removeAttr("maxlength");
            $("#imagePath").removeAttr("required");
            $("#password").removeAttr("required");
            $("#passwordConfirm").removeAttr("required");
        });

        $("form[name='UserRegistration']").submit(function(){

            if ( $('input[name=validation_choice]:checked').val()) {
                var choice = $('input[name=validation_choice]:checked').val();
                if ( choice == "laravel" ) {
                    return true;
                } else if ( choice == "jquery" ) {

                if ($("#firstName").val() == "" || $("#lastName").val() == "" || $("#phoneNumber").val() == "" || $("#email").val() == "" || $("#password").val() == "" || $("#passwordConfirm").val() == "" || $("#imagePath").val() == "" ) {
                    if ($("#firstName").val() == "") {
                        $("#firstNameError").html("<strong>The first name field is required.</strong>");
                        $("#firstNameFGroup").addClass("has-error");
                    }
                    if ($("#lastName").val() == "") {
                        $("#lastNameError").html("<strong>The last name field is required.</strong>");
                        $("#lastNameFGroup").addClass("has-error");
                    }
                    if ($("#phoneNumber").val() == "") {
                        $("#phoneNumberError").html("<strong>The phone number field is required.</strong>");
                        $("#phoneNumberFGroup").addClass("has-error");
                    } else {
                        if ($("#phoneNumber").val().length != 10) ;
                        $("#phoneNumberError").html("<strong>The phone number should be 10 digits.</strong>");
                        $("#phoneNumberFGroup").addClass("has-error");
                    }
                    if ($("#email").val() == "") {
                        $("#emailError").html("<strong>The email field is required.</strong>");
                        $("#emailFGroup").addClass("has-error");
                    }
                    if ($("#password").val() == "") {
                        $("#passwordError").html("<strong>The password field is required.</strong>");
                        $("#passwordFGroup").addClass("has-error");
                    }
                    if ($("#passwordConfirm").val() == "") {
                        $("#passwordConfirmError").html("<strong>The confirm password field is required.</strong>");
                        $("#confirmPasswordFGroup").addClass("has-error");
                    }
                    if ($("#imagePath").val() == "") {
                        $("#imageError").html("<strong>The image field is required.</strong>");
                        $("#imageFGroup").addClass("has-error");
                    }
                    if ($("#password").val() && $("#passwordConfirm").val()) {
                        if ($("#password").val() != $("#passwordConfirm").val()) {
                            $("#passwordError").html("<strong>The password fields should be matched.</strong>");
                            $("#passwordFGroup").addClass("has-error");
                        }
                    }
                    return false;
                } else {

                    jQuery.noConflict();
                    formdata = new FormData();

                    var fileInput = document.getElementById('imagePath');
                    var file = fileInput.files[0];

                        if (formdata) {
                            formdata.append("image_path", file);
                            formdata.append("_token", $('input[name=_token]').val());
                            formdata.append("first_name", $('#firstName').val());
                            formdata.append("last_name", $('#lastName').val());
                            formdata.append("phone_number", $('#phoneNumber').val());
                            formdata.append("email", $('#email').val());
                            formdata.append("password", $('#password').val());
                            formdata.append("password_confirmation", $('#passwordConfirm').val());

                            jQuery.ajax({
                                url: "UserRegistration/",
                                type: "POST",
                                data: formdata,
                                processData: false,
                                contentType: false,
                                success: function () {
                                    alert("We have sent you an email confirmation on "+$('#email').val());
                                    window.location.href = "http://localhost:8000/login";
                                }
                            });
                        }

                    return false;
                    /*$.post('/storeRegData',{'id': this.delete_product_id,'from':'inventory','_token':$('input[name=_token]').val()},function(data){
                        if(data==1){
                            location.reload();
                        }
                        else{
                            alert('sorry');
                        }
                    });*/
                }
                }
            }


        });
    });
</script>
@endsection
