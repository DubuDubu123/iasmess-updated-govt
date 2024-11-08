@extends('admin.layouts.app')

@section('title', 'Admin Profile')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style>
    
.image {
    height: 80px;
    width: 80px;
    /* border-radius: 50%; */
}
img {
    max-width: 100%;
    border-radius: 50%;
}
@media (max-width: 768px) {
    .col-sm-6 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
}
i{
    color:#0A7E8C;
}
.row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    /*margin-left: -15px; */
}


.profile-nav .user-heading {
    background: #fbc02d;
    color: #fff;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    padding: 30px;
    text-align: center;
}

.profile-nav .user-heading.round a  {
    border-radius: 50%;
    -webkit-border-radius: 50%;
    border: 10px solid rgba(255,255,255,0.3);
    display: inline-block;
}

.profile-nav .user-heading a img {
    width: 112px;
    height: 112px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
}

.profile-nav .user-heading h1 {
    font-size: 22px;
    font-weight: 300;
    margin-bottom: 5px;
}

.profile-nav .user-heading p {
    font-size: 12px;
}

.profile-nav ul {
    margin-top: 1px;
}

.profile-nav ul > li {
    border-bottom: 1px solid #ebeae6;
    margin-top: 0;
    line-height: 30px;
}

.profile-nav ul > li:last-child {
    border-bottom: none;
}

.profile-nav ul > li > a {
    border-radius: 0;
    -webkit-border-radius: 0;
    color: #89817f;
    border-left: 5px solid #fff;
}

.profile-nav ul > li > a:hover, .profile-nav ul > li > a:focus, .profile-nav ul li.active  a {
    background: #f8f7f5 !important;
    border-left: 5px solid #fbc02d;
    color: #89817f !important;
}

.profile-nav ul > li:last-child > a:last-child {
    border-radius: 0 0 4px 4px;
    -webkit-border-radius: 0 0 4px 4px;
}

.profile-nav ul > li > a > i{
    font-size: 16px;
    padding-right: 10px;
    color: #bcb3aa;
}

.r-activity {
    margin: 6px 0 0;
    font-size: 12px;
}


.p-text-area, .p-text-area:focus {
    border: none;
    font-weight: 300;
    box-shadow: none;
    color: #c3c3c3;
    font-size: 16px;
}
.col-3 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 25%;
    flex: 0 0 20% !important;
    max-width: 50%;
}
 
.col-7.col-sm-6 {
    max-width: 58% !important;
    flex: 0 0 70%;
}
.profile-align{
    line-height:22px;
}
.box-profile.nav-tabs-custom>.nav-tabs {
    margin: 0;
    border-bottom: none;
    border-radius: 0;
    background-color: transparent !important;
    width: 314px !important;
    display: flex;
}

.nav-tabs-custom>.nav-tabs>li>a.active:hover, .nav-tabs-custom>.nav-tabs>li>a.active {
    background-color: #0a7e8c;
    color: #455a64;
    color: white !important;
}
.box-profile.nav-tabs-custom>.nav-tabs>li {
    margin-bottom: 0px;
    margin-right: 0px !important;
}
.tab-content {
    background: #fff !important;
    border-radius: 3px;
}
.nav-tabs-custom>.nav-tabs>li>a:hover, .nav-tabs-custom>.nav-tabs>li>a {
    background: #e5e5e5;
    color: black !important;
}

.fa-angle-down{
        color: white;
    }
    </style>
<section class="content">

    <div class="row">
      
    <div class="col-12">
        <!-- Profile Image -->
        <div class="box">
          <div class="box-body box-profile">            
            <div class="row text-center">
                            <div class="col-12">
                                <!-- <a href="http://localhost/ias-mess/public/users"> -->
                                <div class="row">
@if(auth()->user()->hasRole("user"))
<div class="col-7 col-sm-6" style="
    /* flex: 0 0 100%; */
    /* max-width: 100%; */
"> 
<div class="box p-5" style="text-align: left;border-radius:10px;padding-left: 25px !important;background: #fff !important;">
                                    <div style="color:black;font-size:18px;margin-top: 20px;">
                                        <h5 class="font-weight-600 p-5" style="color:black;font-size:17px">User Profile</h5> 
                                        <div class="row" style="
    padding: 5px;
    padding-right: 0px;
">
 <div class="col-3 col-sm-6" style="
    /* margin-left: 15px; */
    /* margin-right: 30px; */
">
<div class="image">


<img src="{{ $user->profile_picture ?? asset('assets/img/user-dummy.svg') }}" width="100%" height="100%"> 
</div>
@if(!auth()->user()->hasRole("super-user"))
<p style="margin-top: 10px;font-size: 15px; text-align: center;   color: #0a7e8c;  font-weight: 600;
">#{{auth()->user()->userid}}</p>
@endif


 
                                        </div>
                                        <div class="col-8 col-sm-6" style="
    margin-left: 15px;
    margin-right: 30px;
    /* margin-top: 20px; */
">


<p class="profile-align"><i class="fa fa-user" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{auth()->user()->salutation}} {{auth()->user()->name}} </span></p>




<p class="profile-align"><i class="fa fa-phone" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{auth()->user()->mobile}} </span></p>

<p class="profile-align"><i class="fa fa-envelope" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{auth()->user()->email}} </span></p><p class="profile-align" style="
    width: 400px; /* Adjust the width as needed */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    /* border: 1px solid #000; */ /;
"><i class="fa fa-home" aria-hidden="true"></i> <span style="
    font-size: 14px;
    width: 200px; /* Adjust the width as needed */
    /* white-space: nowrap; */
    overflow: hidden;
    text-overflow: ellipsis;
    /* border: 1px solid #000; */
">{{auth()->user()->address}}</span></p>


                                        </div>
                                        </div>
                                        </div>


                                    </div></div>
                                    @else
                                    <div class="col-7 col-sm-12" style="
    /* flex: 0 0 100%; */
    /* max-width: 100%; */
">
<div class="box p-5" style="text-align: left;border-radius:10px;padding-left: 25px !important;background: #fff !important;">
                                    <div style="color:black;font-size:18px;margin-top: 20px;">
                                        <h5 class="font-weight-600 p-5" style="color:black;font-size:17px">User Profile</h5> 
                                        <div class="row" style="
    padding: 20px;
    padding-right: 0px;
">
 <div class="col-3 col-sm-6" style="
    /* margin-left: 15px; */
    /* margin-right: 30px; */
">
<div class="image" style="
    height: 150px;
    width: 150px;
">

<img src="{{ $user->profile_picture ?? asset('assets/img/user-dummy.svg') }}" width="100%" height="100%" style="
    width: 100px;
"> 
</div>


 
                                        </div>
                                        <div class="col-7 col-sm-6" style="
    margin-left: 15px;
    margin-right: 30px;
    /* margin-top: 20px; */
">


<p class="profile-align"><i class="fa fa-user" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{auth()->user()->name}} </span></p>




<p class="profile-align"><i class="fa fa-phone" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{auth()->user()->mobile}}</span></p>

<p class="profile-align"><i class="fa fa-envelope" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{auth()->user()->email}} </span></p><p class="profile-align" style="
    /* width: 400px; */ /* Adjust the width as needed */
    /* white-space: nowrap; */
    /* overflow: hidden; */
    text-overflow: ellipsis;
    /* border: 1px solid #000; */ /;
"><i class="fa fa-home" aria-hidden="true"></i> <span style="
    font-size: 14px;
    width: 200px; /* Adjust the width as needed */
    /* white-space: nowrap; */
    overflow: hidden;
    text-overflow: ellipsis;
    /* border: 1px solid #000; */
">{{auth()->user()->address}}</span></p>


                                        </div>
                                        </div>
                                        </div>


                                    </div></div>
                                    @endif
                                    @if(auth()->user()->hasRole("user"))
                                    <div class="col-5"><div class="box p-5" style="text-align: left;border-radius:10px;/* padding-left: 25px !important; *//* padding-bottom: 25px !important; */background: #fff !important;">
                                    <div style="color:black;font-size:18px;margin-top: 20px;">
                                        <h5 class="font-weight-600 p-5" style="color:black;font-size:17px;padding-left: 20px !important;">Subscription Details</h5> 
                                        <div class="row" style="
    padding: 20px;
">
 
                                        <div class="col-6 col-sm-12" style="
    margin-left: 15px;
    margin-right: 30px;
    /* margin-top: 20px; */
"> 
<p> <span style="
    
    font-size: 15px;
"><strong>MemberShip Type &nbsp;:</strong> &nbsp;   &nbsp;  &nbsp;  &nbsp; 
@if($membership_data->is_lifetime_member == 1)
Life Time Members
@else
Associate Member
@endif
 </span></p>
<p> <span style="
    
    font-size: 15px;
"><strong>MemberShip Fee &nbsp;&nbsp; :</strong> &nbsp;   &nbsp;  &nbsp;  &nbsp; 

₹{{$membership_data->amount}}

</span></p><p>
@if($membership_data->is_lifetime_member == 1)
<p style="
    
    font-size: 15px;    height: 20px;

">
</p>
@else 
<span style="
    
    font-size: 15px;
"><strong>Next Renewal On &nbsp;&nbsp; :</strong> &nbsp;   &nbsp;  &nbsp;  &nbsp; <?php echo date('Y-m-d', strtotime($membership_data->expiry_date)); ?>
</span>
 @endif
</p> 
                                        </div>
                                        </div>
                                        </div>


                                    </div></div>
                                    @endif
                                    <!-- </a> -->
                                </div>
                                
                            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-12">
        <div class="nav-tabs-custom box-profile">
        <ul class="nav nav-tabs">
            <li style="/* border-top-left-radius: 40px; */ border-radius: 40px;"><a class="active show" href="#basic_info" data-toggle="tab" style=" border-top-left-radius: 25px;  border-top-right-radius: 25px;">Basic Information</a>
            </li>
            <li>
                <a class="" href="#manage_password" data-toggle="tab" style=" border-top-right-radius: 25px;">Manage Password</a>
            </li>
        </ul>
                      
          <div class="tab-content">  
            <div class="{{ old('tab','basic_info') == 'basic_info' ? 'active' : ''}} tab-pane" id="basic_info">	
                <style>
/* Full-screen overlay for loading spinner */
#loading-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
    z-index: 9999;
    text-align: center;
}

#loading-overlay img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px; /* Adjust size of the spinner */
}
</style>

<!-- Loading Overlay -->
<div id="loading-overlay">
    <img src="https://cdn.pixabay.com/animation/2023/10/08/03/19/03-19-26-213_512.gif" alt="Loading..." />
</div>

<!-- Profile Update Form -->
<form method="post" class="form-horizontal" action="{{ url('admins/profile/update', $user->id) }}" id="profileForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="tab" value="basic_info">
    <div class="box p-15">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="first_name">@lang('view_pages.name')</label>
                    <input class="form-control" type="text" id="first_name" name="first_name" value="{{ old('name', $user->name) }}" required placeholder="@lang('view_pages.enter_first_name')">
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">@lang('view_pages.email')</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="@lang('view_pages.enter_email')">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="mobile">@lang('view_pages.mobile')</label>
                    <input class="form-control" type="text" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}" placeholder="@lang('view_pages.enter_mobile')">
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="address">@lang('view_pages.address')</label>
                    <textarea id="address" name="address" class="form-control" placeholder="@lang('view_pages.enter_address')" rows="1">{{ old('address', $user->address) }}</textarea>
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                </div>
            </div>
        </div>
        <input type="hidden" id="user_id" value="{{ $user->id }}">
        <div class="form-group">
            <div class="col-6">
                <label for="profile_picture">@lang('view_pages.profile')</label><br>
                <img id="blah" src="{{ $user->profile_picture ?? asset('assets/img/user-dummy.svg') }}" class="rounded-circle mb-4" alt="" style="max-width: 50%;"><br>
                <input type="file" id="profile_picture" name="profile_picture" style="display:none">
                <button class="btn btn-primary btn-sm" type="button" onclick="$('#profile_picture').click()" id="browse">@lang('view_pages.browse')</button>
                <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">@lang('view_pages.remove')</button><br>
                <span class="text-danger" id="profile_picture_error"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-12">
                <button class="btn btn-primary btn-sm pull-right" type="submit">
                    @lang('view_pages.update')
                </button>
            </div>
        </div>
    </div>
</form>

		  <style>
        .form-control {
            position: relative;
            transition: box-shadow 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        .toggle-password {
            position: absolute;
            right: 25px;
            top: 55%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
                </div>

            <div class="{{ old('tab') == 'manage_password' ? 'active' : ''}} tab-pane" id="manage_password">		
                <div class="box p-15">		
                   <form method="post" class="form-horizontal" action="{{ url('admins/profile/update_password', $user->id) }}" enctype="multipart/form-data" onsubmit="return validatePassword()">
        @csrf	
        <input type="hidden" name="tab" value="manage_password">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password">@lang('view_pages.password')</label>
                    <div class="input-container">
                        <input class="form-control" type="password" id="password" name="password"  required placeholder="@lang('view_pages.enter_password')">
                        <!--<i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>-->
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password_confirmation">@lang('view_pages.confirm_password')</label>
                    <div class="input-container">
                        <input class="form-control" type="password" id="password_confirmation1" name="password_confirmation"  required placeholder="@lang('view_pages.enter_password_confirmation')">
                        <!--<i class="fas fa-eye toggle-password" onclick="togglePassword('password_confirmation')"></i>-->
                    </div>
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-12">
                <button class="btn btn-primary btn-sm pull-right" name="action" value="password" type="submit">
                    @lang('view_pages.update')
                </button>
            </div>
        </div>
    </form>

                </div>			  
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
        
    </div>
    <!-- /.row -->
    
    <!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        // Toastr options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "5000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    });
</script>

<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const icon = passwordField.nextElementSibling;
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<script>
    function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password_confirmation1").value;

    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Password and confirmation password do not match.");
        return false;
    }

    return true;
}




</script>
<script>$(document).ready(function() {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Preview selected image
    $('#profile_picture').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result); // Update image preview
                $('#remove_img').show(); // Show remove button
            };
            reader.readAsDataURL(file);
        } else {
            $('#blah').attr('src', '{{ $user->profile_picture ? asset('storage/profile_pictures/' . $user->profile_picture) : asset('assets/img/user-dummy.svg') }}'); // Default image
            $('#remove_img').hide(); // Hide remove button
        }
    });

    // Handle profile form submission with loading overlay and success/error messages
    $('#profileForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        // Show loading overlay
        $('#loading-overlay').show();

        $.ajax({
            url: "{{ url('admins/profile/update', $user->id) }}", // Correct route
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Hide loading overlay after 4 seconds
                setTimeout(function() {
                    $('#loading-overlay').hide();

                    if (response.success) {
                        toastr.success('Profile updated successfully!');
                        window.location.href = response.redirectUrl; // Redirect to the profile page
                    } else {
                        toastr.error(response.message); // Display error message
                    }
                }, 3500);
            },
            error: function(xhr) {
                // Hide loading overlay after 4 seconds
                setTimeout(function() {
                    $('#loading-overlay').hide();

                    // Handle validation errors and display them
                    if (xhr.status === 422) { // Laravel validation error
                        var errors = xhr.responseJSON.errors;

                        if (errors.first_name) {
                            $('#first_name').next('.text-danger').text(errors.first_name[0]);
                        }
                        if (errors.email) {
                            $('#email').next('.text-danger').text(errors.email[0]);
                        }
                        if (errors.mobile) {
                            $('#mobile').next('.text-danger').text(errors.mobile[0]);
                        }
                        if (errors.address) {
                            $('#address').next('.text-danger').text(errors.address[0]);
                        }
                        if (errors.profile_picture) {
                            $('#profile_picture_error').text(errors.profile_picture[0]);
                        }
                    } else {
                        toastr.error('An unexpected error occurred.');
                    }
                }, 4000);
            }
        });
    });
});


</script>

  </section>

@endsection