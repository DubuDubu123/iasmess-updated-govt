@extends('admin.layouts.app') @section('title', 'Main page') @section('content')
    <style>
        .book-now.spinner {
        font-size: 0px;
        width: 40px;
        height: 40px;
        padding: 0px !important;
        background: none !important;
        border-radius: 50% !important;
        border-left-color: transparent !important;
        animation: rotate 0.5s ease 0.5s infinite;
        border: 3px solid blue;
    }
    @keyframes rotate{
    0%{
        transform: rotate(360deg);
    }
    }
        .btn-primary {
    background-color: #EC9E9C !important;
    border-color: #EC9E9C !important;
    color: var(--btn_text);
}
.skin-blue-light .main-header .navbar {
    background-color: #EC9E9C !important;
    /* background-color: #fff; */
}
.skin-blue-light .sidebar-menu>li.active>a {
    border-left-color: #EC9E9C !important;
}



.skin-blue-light .sidebar-menu>li.active>a, .skin-blue-light .sidebar-menu>li.menu-open>a {
    color: #fff !important;
    background: #EC9E9C !important;
}
        input {
        width: 200px;
        padding: 10px;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-gap: 20px;
    }
    input[readonly] {
                border: none;
                width: 200px;
                padding-left: 60px;
                padding-top: 19px;
                font-size: 15px;
                outline: none;
                cursor: pointer;
                padding-bottom: 7px;
                user-select: none; /* Prevent text selection */
                background-color: transparent; /* Optional: if you want no background */
            }
            .col-3 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 25%;
        flex: 0 0 20% !important;
        max-width: 50%;
    }
    .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
    @media (max-width: 1000px) {
        .col-sm-6 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 50%;
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
    }
    .col-2 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667% !important;
    }
    /*.party-msg{*/
    /*    font-size: 13px;*/
    /*    position: absolute;*/
    /*    top: -40px;*/
    /*    width: 351px;*/
    /*    right: 316px;*/
    /*    font-weight: 800;*/
    /*    padding: 6px;*/
    /*}*/
    .party-msg{
        font-size: 13px;
    position: relative;
    top: 0px;
    width: 351px;
    left: 8px;
    font-weight: 800;
    padding: 6px;
    }
    .party-msg.error{
        background-color: #ffa7a7;
        color: #d50808;
        text-align: center;
    
    }
    .party-msg.active{
        background: #aaf6aa;
        color: green;
        text-align:center;
        
    }
    .book-now.active{
        background:#EC9E9C !important;
        color:white;
    }
    .skin-blue-light .sidebar-menu .treeview-menu>li.active>a, .skin-blue-light .sidebar-menu .treeview-menu>li>a:hover {
    color: #EC9E9C !important;
}
.alert-success, .callout.callout-success, .label-success, .modal-success .modal-body{
    background-color: #EC9E9C !important;
}
    button.btn.btn-primary.btn-sm.m-5.book-now.active {
        cursor: pointer !important;
    }
    .btn-outline.btn-success {
    color: black;
    background-color: #EC9E9C;
    border-color: #EC9E9C;
}
.btn-outline.btn-success:hover {
    color: black;
    background-color: #EC9E9C;
    border-color: #EC9E9C;
}
.book-now{
    padding: 10px;
    padding-left: 30px;
    padding-right: 30px;
    cursor: not-allowed;
    background: #dfdddd !important;
    border: 1px solid grey;
    color: black;
}
.book-now.active{
    background:#EC9E9C !important;
    color:white;
}

.book-now.spinner {
        font-size: 0px;
        width: 40px;
        height: 40px;
        padding: 0px !important;
        background: none !important;
        border-radius: 50% !important;
        border-left-color: transparent !important;
        animation: rotate 0.5s ease 0.5s infinite;
        border: 3px solid blue;
    }
    @keyframes rotate{
    0%{
        transform: rotate(360deg);
    }
    }
    span#select2-user-container {
    font-size: 14px;
}
span.select2.select2-container.select2-container--default.select2-container--below {
    width: 100% !important;
}
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 11px 12px;
    height: 43px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 35px;
    right: 3px;
}

table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }
        tbody#tariff tr td {
            border: 1px solid #d1d1d1;
            padding: 5px 10px 5px 10px;
            text-align: center;
            width: 33.33%; /* Ensure equal width */
            font-size:15px;
        }
        thead tr td {
            border: 1px solid #d1d1d1;
            padding: 5px 10px 5px 10px;
            text-align: center;
            width: 33.33%; /* Ensure equal width */
            font-size:15px;
        }
        /* th {
            background-color: #f2f2f2;
        } */
        .checkbox-cell {
            text-align: center;
        }
        [type="checkbox"]:checked, [type="checkbox"]:not(:checked){
            position: relative !important;
    opacity: 1 !important;
    left: 0px;
    transform: scale(1.5); /* Make checkbox larger */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -moz-transform: scale(1.5); /* Firefox */
            -o-transform: scale(1.5); /* Opera */
            -ms-transform: scale(1.5); /* IE 9 */

        }
        tr.total td{
                border:none;
        }
        span.party-msg {
    position: relative;
    top: 0px;
    right: 100px;
    font-size: 15px;
    
    padding: 5px;
    
    font-weight: 600;
    padding-left: 30px;
    padding-right: 30px;
}
input[type="checkbox"] {
    cursor: pointer;
}
.switch2, .switch3,.switch4,.switch6,.switch8,.switch9,.switch4.actv {
  position: relative;
  top:-10px;
  display: inline-block;
  margin: 0 5px;
}

.switch2 > span,.switch3 > span,.switch4 > span,.switch6 > span,.switch8 > span,.switch9 > span,.switch,.switch4.actv > span {
  position: absolute;
  top:30px;
  pointer-events: none;
  font-family: 'Helvetica', Arial, sans-serif;
  font-weight: bold;
  font-size: 12px;
  text-transform: uppercase;
  text-shadow: 0 1px 0 rgba(0, 0, 0, .06);
  width: 50%;
  text-align: center;
}

input.check-toggle-round-flat:checked ~ .off {
  color: #fff;
}

input.check-toggle-round-flat:checked ~ .on {
  color: #fff;
}

.switch2 > span.on,.switch3 > span.on,.switch4 > span.on,.switch6 > span.on,.switch8 > span.on,.switch9 > span.on,.switch4.actv > span.on {
  left: 0;
  padding-left: 2px;
  color: #fff;
}

.switch2 > span.off,.switch3 > span.off,.switch4 > span.off,.switch6 > span.off,.switch8 > span.off,.switch9 > span.off,.switch4.actv > span.off {
  right: 0;
  padding-right: 4px;
  color: #000;
}

.check-toggle {
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}
.check-toggle + label {
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

input.check-toggle-round-flat + label {
  padding: 2px;
  width: 97px;
  height: 34px;
  background-color:#d4d7d4;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
}
input.check-toggle-round-flat + label:before, input.check-toggle-round-flat + label:after {
  display: block;
  position: absolute;
  content: "";
}

input.check-toggle-round-flat + label:before {
  top: 2px;
  left: 2px;
  bottom: 2px;
  right: 2px;
  background-color: #d4d7d4; 
  border-radius: 60px;
}
input.check-toggle-round-flat + label:after {
  top: 4px;
  left: 4px;
  bottom: 4px;
  width: 46px;
  background-color: #e31b1b;
  -webkit-border-radius: 52px;
  -moz-border-radius: 52px;
  -ms-border-radius: 52px;
  -o-border-radius: 52px;
  border-radius: 52px;
  -webkit-transition: margin 0.2s;
  -moz-transition: margin 0.2s;
  -o-transition: margin 0.2s;
  transition: margin 0.2s;
}

input.check-toggle-round-flat:checked + label {
}

input.check-toggle-round-flat:checked + label:after {
  margin-left: 44px;
  background: #46a31d;
}
[type="checkbox"]:not(.filled-in)+label:after {
    border: 0;
  
    transform: none !important;
}
[type="checkbox"]+label:before, [type="checkbox"]:not(.filled-in)+label:after {
    border:none !important;
}
input.check-toggle-round-flat + label:after {
    top: 3px !important;
    left: 4px !important;
    bottom: 23px !important;
    width: 46px !important;
    height: 25px !important;
    background-color: #e31b1b;
    -webkit-border-radius: 52px;
    -moz-border-radius: 52px;
    -ms-border-radius: 52px;
    -o-border-radius: 52px;
    border-radius: 52px !important;
    -webkit-transition: margin 0.2s;
    -moz-transition: margin 0.2s;
    -o-transition: margin 0.2s;
    transition: margin 0.2s;
}
input.check-toggle-round-flat + label:before {
    top: 2px !important;
    left: 2px !important;
    bottom: 2px;
    right: 2px;
    background-color: #d4d7d4;
    border-radius: 60px;
}

table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }
        tbody#tariff tr td {
            border: 1px solid #d1d1d1;
            padding: 5px 10px 5px 10px;
            text-align: center;
            width: 33.33%; /* Ensure equal width */
            font-size:15px;
        }
        thead tr td {
            border: 1px solid #d1d1d1;
            padding: 5px 10px 5px 10px;
            text-align: center;
            width: 33.33%; /* Ensure equal width */
            font-size:15px;
        }
        /* th {
            background-color: #f2f2f2;
        } */
        .checkbox-cell {
            text-align: center;
        }
        [type="checkbox"]:checked, [type="checkbox"]:not(:checked){
            position: relative !important;
    opacity: 1 !important;
    left: 0px;
    transform: scale(1.5); /* Make checkbox larger */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -moz-transform: scale(1.5); /* Firefox */
            -o-transform: scale(1.5); /* Opera */
            -ms-transform: scale(1.5); /* IE 9 */

        }
        tr.total td{
                border:none;
        }
        span.party-msg.pull-right {
    position: relative;
    top: 10px;
    right: 100px;
    font-size: 15px;
    
    padding: 5px;
    
    font-weight: 600;
    padding-left: 30px;
    padding-right: 30px;
}
i.mdi.mdi-keyboard-backspace.mr-2 {
    color: white;
}
    /* .btn:not(:disabled):not(.disabled){
        cursor: not-allowed !important;
    }
    .btn {
        cursor: not-allowed !important;
    } */
    </style>
    <!-- Start Page content -->
    <section class="content" style="margin-left:25px">
        {{--
        <div class="container-fluid"> --}}


            <div class="row" style="margin-top:30px;margin-left:0px">
                <div class="col-12">

                    <div class="box" style="margin-bottom:0px;">
                        <div class="box-header with-border">
                            <div style="color:black;font-size:18px">
                                <h5 class="font-weight-600 p-5" style="color:black;font-size:21px">Party Hall Management </h5>
                            </div>

                        </div>

                        <div class="box-body " style="  padding: 30px;">
                            <!-- <input name='range' id='cal' />  -->
                            <div class="row text-center">
                                <div class="col-12">
                                    <!-- <a href="http://localhost/ias-mess/public/users"> -->
                                    <div class="box p-5" style="text-align: left;border-radius:10px;padding-left: 25px !important;background: #fff !important;">
                                        <div style="color:black;font-size:18px;margin-top: 20px;">
                                            <div class="font-weight-600 p-5" style="color:black;font-size:17px">Book Party Hall
                                            <span class="danger-book party-msg"></span>
                                            </div>
                                            <form id="party-booking" method="post" action="">
                                                @csrf
                                                @if(auth()->user()->hasRole(("super-user")))
                                                <div class="row" style="
    padding: 20px;
">
 <div class="col-4 col-sm-4" style="
    margin-left: 15px;
    margin-right: 30px;
">
<div class="form-group">
  <label for="from_date" style=" font-size: 14px;">Select user<span class="text-danger">*</span></label>
                                            <select name="user" id="user" class="form-control select2"   data-placeholder="Select User" style="margin-top: 5px;padding:10px;    height: 42px;">
                                            <option value="" selected >Arun</option>
                                                @foreach($user as $key=>$value)
                                                <option value="{{$value->id}}" >{{$value->name}} - {{$value->mobile}}</option>
                                                @endforeach
                                           
    </select>

</div>
</div>

<div class="col-2 col-sm-6" style="
    margin-left: 15px;
">
                                                    <div class="form-group">
                                                        <label for="room" style="
    font-size: 14px;
">User ID </label>
                                                        <input class="form-control" type="text" id="user_id" name="user_id" value="" required="" placeholder="" style="padding:10px;" disabled>
                                                        <span class="text-danger"></span>

                                                    </div>
                                                </div>

                                                <div class="col-2 col-sm-6" style="
    margin-left: 15px;
">
                                                    <div class="form-group">
                                                        <label for="room" style="
    font-size: 14px;
">Mobile Number </label>
                                                        <input class="form-control" type="text" id="mobile_no" name="mobile_no" value="" required="" placeholder="" style="padding:10px;" disabled>
                                                        <span class="text-danger"></span>

                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-6" style="
    margin-left: 15px;
">
                                                    <div class="form-group">
                                                        <label for="room" style="
    font-size: 14px;
">Email Address </label>
                                                        <input class="form-control" type="text" id="email_address" name="email_address" value="" required="" placeholder="" style="padding:10px;" disabled>
                                                        <span class="text-danger"></span>

                                                    </div>
                                                </div>
</div>
@endif
                                            <div class="row" style="
        padding: 20px;
    ">




                                                    <div class="col-md-4 col-sm-6" style="
        margin-left: 15px;
        margin-right: 15p;
    ">
                                                        <div class="form-group">
                                                            <label for="from_date" style="
        font-size: 14px;
    ">Select Date<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="date" id="from_date" name="from_date" value="" requi#d50808="" placeholder="Enter Name" style="padding:10px">
                                                            <span class="text-danger"></span>

                                                        </div>
                                                    </div> 

                                                    <div class="col-md-3 col-sm-6" style="font-size: 14px;margin-left:15px">
                                                        <div class="form-group">
                                                            <label for="role">Select Guest type<span class="text-danger">*</span>
                                                            </label>
                                                            <select name="guest_type" id="guest_type" class="form-control" requi#d50808="" style="margin-top: 5px;padding:10px;    height: 42px;">
                                                                <option value="" selected="" disabled="">Select Guest</option>
                                                                <option value="self">Self
                                                                </option>
                                                                <option value="family">Family
                                                                </option>
                                                                <option value="guest">Guest
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>  
                    <div class="col-md-4 col-sm-6" style="  font-size: 13px;margin-left:15px ">
                     <div class="form-group">
                     <label for="role">Would you be using the lawn for your event? </label>
                        <!-- <input type="checkbox" name="lawn" value="1" style=" position: relative;   top: 38px;  width: 50px;   padding: 10px !important;" > -->
                        <div class="switch4" style="vertical-align:middle">
        <input id="is_lawn" class="check-toggle check-toggle-round-flat" type="checkbox" name="is_lawn" >
        <label for="is_lawn"></label>
        <span class="on">No</span>
        <span class="off">Yes</span>
    </div>

    <p id="text-info" class="text-danger" style="display: none; font-weight:600;font-size: 13px;">Rs. 1000 for Lawn would be added</p>

  
                                      
                     </div>
                    </div>
                                                   
                     <div class="col-md-12" style="padding-right: 30px !important;">
                        <div class="form-group">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm pull-right m-5 check_availability" type="button" style="padding: 10px;cursor: pointer;">Check Availability
                                </button>
                                <button class="btn btn-primary pull-right btn-sm m-5 book-now " type="button" disabled="">Book Now</button>
                                
                            </div>
                        </div>
                    </div>
                                                    
        </form>
                                                </div>
                                        


                                        </div>
                                        <!-- </a> -->
                                    </div>

                                </div>

                            </div>
                            <!-- on boarding  -->


                            <!-- end -->
                        </div>
                        <div style="color:black;font-size:18px">
                            <h5 class="font-weight-600 p-5" style="color:black;font-size: 17px;padding-left: 20px !important;">My Bookings </h5>
                        </div>
                        <div class="box" style="padding:15px">

<div class="box-header with-border">
    <div class="row text-right">
        <div class="col-8 col-md-3" style="margin-right:20px">
            <div class="form-group">
                <div class="controls">
                    <input type="text" id="search_keyword" name="search" class="form-control" placeholder="Enter Keyword">
                </div>
            </div>
        </div>

        <div class="col-4 col-md-2 text-left">
            <button id="search" class="btn btn-success btn-outline btn-sm py-2" type="submit">
                Search                                    </button>
        </div> 
    </div>

</div>

<div class="row text-center" style="
width: 97%;
padding: 10px 20px 20px 20px;
background-color: white;
margin-left: 5px;
">

<div id="js-types-partial-target" style=" width: 100%;">
                                <include-fragment src="party/fetch">
                            <span style="text-align: center;font-weight: bold;"> @lang('view_pages.loading')</span>
                            </include-fragment> 
                            </div> 
</div>

</div>
                    </div>
                </div>

                {{-- </div> --}}
            <!-- container -->


            <script src="{{ asset('assets/js/fetchdata.min.js') }}"></script>
            
            
            
              <script>
        document.getElementById('is_lawn').addEventListener('change', function() {
            var textInfo = document.getElementById('text-info');
            if (this.checked) {
                textInfo.style.display = 'none';
            } else {
                textInfo.style.display = 'none';
            }
        });
    </script>
            <script>

    $(document).ready(function() {
                    // Get current date in Indian Standard Time (IST)
                    var currentDateIST = new Date().toLocaleString('en-US', { timeZone: 'Asia/Kolkata' });
                    console.log('Current IST Date: ' + currentDateIST);

                    // Create a new Date object using the IST date string
                    var currentDate = new Date(currentDateIST);
                    console.log('Current Date Object: ' + currentDate);

                    // Extract date components
                    var year = currentDate.getFullYear();
                    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
                    var day = currentDate.getDate().toString().padStart(2, '0');

                    // Format date as YYYY-MM-DD
                    var currentDateFormatted = year + '-' + month + '-' + day;
                    console.log('Formatted Current Date: ' + currentDateFormatted);

                    // Set min attribute of date inputs to current date in IST
                    $('#from_date').attr('min', currentDateFormatted);
                    // $('#to_date').attr('min', currentDateFormatted);
                    console.log('Min attribute for #from_date and #to_date set to: ' + currentDateFormatted);

                    // Set the default value of the date inputs to current date
                    // $('#from_date').val(currentDateFormatted);
                    // $('#to_date').val(currentDateFormatted);
            
        });
                var search_keyword = '';
$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, $('#search').serialize(), function(data) {
            $('#js-types-partial-target').html(data);
        });
    });

    $('#search').on('click', function(e) {
        e.preventDefault();
        search_keyword = $('#search_keyword').val();

        fetch('party/fetch?search=' + search_keyword)
            .then(response => response.text())
            .then(html => {
                document.querySelector('#js-types-partial-target').innerHTML = html;
            });
    });
});


                $(document).on('click', '.sweet-delete', function(e) {
                    e.preventDefault();

                    let url = $(this).attr('data-url');

                    swal({
                        title: "Are you sure to delete ?",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        cancelButtonText: "No! Keep it",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }, function(isConfirm) {
                        if (isConfirm) {
                            swal.close();

                            $.ajax({
                                url: url,
                                cache: false,
                                success: function(res) {

                                    fetch('party/fetch?search=' + search_keyword)
                                        .then(response => response.text())
                                        .then(html => {
                                            document.querySelector('#js-types-partial-target')
                                                .innerHTML = html
                                        });

                                    $.toast({
                                        heading: '',
                                        text: res,
                                        position: 'top-right',
                                        loaderBg: '#ff6849',
                                        icon: 'success',
                                        hideAfter: 5000,
                                        stack: 1
                                    });
                                }
                            });
                        }
                    });
                });
                var dates = [];
    $(document).ready(function() {
    $("#cal").daterangepicker();
    $("#cal").on('apply.daterangepicker', function(e, picker) {
        e.preventDefault();
        const obj = {
        "key": dates.length + 1,
        "start": picker.startDate.format('MM/DD/YYYY'),
        "end": picker.endDate.format('MM/DD/YYYY')
        }
        dates.push(obj);
        showDates();
    })
    $(".remove").on('click', function() {
        removeDate($(this).attr('key'));
    })
    })
    function showDates() {
    $("#ranges").html("");
    $.each(dates, function() {
        const el = "<li>" + this.start + "-" + this.end + "<button class='remove' onClick='removeDate(" + this.key + ")'>-</button></li>";
        $("#ranges").append(el);
    })
    }
    function removeDate(i) {
    dates = dates.filter(function(o) {
        return o.key !== i;
    })
    showDates();
    }

    $('#from_date').on('change', function() {
        $(".book-now").removeClass("active");
                        $(".party-msg").removeClass("active");
                        $(".party-msg").html('');
                    $(".party-msg").removeClass("error");
    });
    $('.check_availability').on('click', function(e) {
                var from_date =  $("#from_date").val(); 
                var guest_type =  $("#guest_type").val();
                if(from_date == "")
                {
                        $(".book-now").removeClass("active");
                        $(".party-msg").addClass("error");
                        $(".party-msg").html("Please select the Date");
                        $(".party-msg").removeClass("active");
                } 
                else if(guest_type == "" || guest_type === null)
                {
                    $(".book-now").removeClass("active");
                    $(".party-msg").addClass("error");
                    $(".party-msg").html("Please select the Date");
                    $(".party-msg").removeClass("active");
                    $(".party-msg").html("Please select the Guest Type");
                }
                else{
                    let url = "{{url('/')}}/party/check-availability";
                    var form_data = new FormData($("#party-booking")[0]);
                    $.ajax({
                                url: url,
                                type:'post',
                                data: form_data,
                                cache: false,
                                contentType:false, // Default for form submissions
                                processData: false, // Tells jQuery to process the data (default: true)
                                success: function(res) { 
                                    console.log(res.status);
                                    if(res.status)
                                    {
                                        $(".book-now").addClass("active");
                                        $(".book-now").attr("disabled",false);
                                        $(".party-msg").removeClass("error");
                                        $(".party-msg").addClass("active");
                                        $(".party-msg").html(res.message);
                                    }
                                    else{
                                        $(".book-now").removeClass("active");
                                        $(".book-now").attr("disabled",true);
                                        $(".party-msg").addClass("error");
                                        $(".party-msg").removeClass("active");
                                        $(".party-msg").html(res.message);
                                    }
                                }
                    }); 
                } 
                });
                $(".book-now").click(function(){
                let url = "{{url('/')}}/party/book-now";
                var form_data = new FormData($("#party-booking")[0]);
                $(".book-now").addClass("active");
                $.ajax({
                            url: url,
                            type:'post',
                            data: form_data,
                            cache: false,
                            contentType:false, // Default for form submissions
                            processData: false, // Tells jQuery to process the data (default: true)
                            success: function(res) { 
                                if(res.status)
                              {
    $(".book-now").removeClass("active");
    popup_init();
    popup_data(`
        <div class="popup-card"> 
            <div class="popup-card-content" style="text-align: center;"> 
                <img src="{{asset('assets/img/Booking Confirmed.png')}}" style="margin:auto;width: 200px;height: 200px;" alt="">
                <h4 style="font-weight: 600;">Booking Confirmed Successfully</h4>
                <a class="btn btn-success close-popup" style="font-size:16px;margin: auto;margin-top: 20px;" href="#">Close</a>
            </div>
        </div>
    `);

    // Add event listener to the "Close" button
    $(".close-popup").on("click", function() {
        window.location.reload();
    });
}
                                else{
                                    $(".book-now").removeClass("active");
                                    $(".danger-book").addClass("error");
                                    $(".danger-book").removeClass("active");
                                    $(".danger-book").html(res.message);
                                }
                            }
                        });
                    }); 
                    $('#user').on('change', function() {
                        
                    var url = "{{url('/')}}/get-user-details";
                    var data = $(this).val();   
                    $.ajax({
                            url: url,
                            data: {data:data},
                            cache: false,
                            success: function(res) {
                                if(res.status)
                                {
                                    $("#user_id").val(res.user.userid);
                                    $("#mobile_no").val(res.user.mobile);
                                    $("#email_address").val(res.user.email);
                                }
                            }
                        });
                });
            </script>


            @endsection 