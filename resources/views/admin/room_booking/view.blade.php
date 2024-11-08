@extends('admin.layouts.app') @section('title', 'Main page') @section('content')
<style>
     .switch2, .switch3,.switch4,.switch6,.switch8,.switch9,.switch4.actv {
  position: relative;
  top:-23px;
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
@media (max-width:1099px){
	.card { 
	width:45%;
		margin: 0 2.5% 30px;
}
}
@media (max-width:499px){
	.card { 
	width:95%; 
}
}
    .text-response-danger{
        display:none;
        color:red;
        font-size:15px;
    }
    
    #exTab1 .tab-content {
        color : white;
        background-color: #ffffff;
        padding : 20px 15px 20px 0px;
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
    .bio-row{
        width:100% !important;
    }
}
.col-2 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667% !important;
}
span.danger-book.pull-right {
    position: relative;
    top: 10px;
    right: 100px;
    font-size: 15px;
    
    padding: 5px;
    
    font-weight: 600;
    padding-left: 30px;
    padding-right: 30px;
}
.danger-book.error{
    background: #ffdada;
    color: red;
}
span.danger-book.pull-right.active {
    background: #aaf6aa;
    color: green;
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
    background:#0A7E8C !important;
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
.image {
    height: 150px;
    width: 150px;
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

.fa-angle-down{
        color: white;
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
    margin-left: -15px;
    justify-content: center;
    align-items: center;
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

/*.confimr.spinner {*/
/*        font-size: 0px;*/
/*        width: 40px;*/
/*        height: 40px;*/
/*        padding: 0px !important;*/
/*        background: none !important;*/
/*        border-radius: 50% !important;*/
/*        border-left-color: transparent !important;*/
/*        animation: rotate 0.5s ease 0.5s infinite;*/
/*        border: 3px solid blue;*/
/*    }*/
    @keyframes  rotate{
    0%{
        transform: rotate(360deg);
    }
    }
.generate_invoice.spinner {
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
    @keyframes  rotate{
    0%{
        transform: rotate(360deg);
    }
    }
.profile-info .panel-footer {
    background-color:#f8f7f5 ;
    border-top: 1px solid #e7ebee;
}

.profile-info .panel-footer ul li a {
    color: #7a7a7a;
}

.bio-graph-heading {
    background: #fbc02d;
    color: #fff;
    text-align: center;
    font-style: italic;
    padding: 40px 110px;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    font-size: 16px;
    font-weight: 300;
}

.bio-graph-info {
    color: #89817e !important;
}
.bio-graph-info {
    font-size: 14px !important;
    font-weight: 300;
    margin: 0 0 20px;
}
.bio-graph-info h1 {
    font-size: 22px;
    font-weight: 300;
    margin: 0 0 20px;
}

.bio-row {
    width: 50%;
    float: left;
    margin-bottom: 10px;
    padding:0 15px;
}

.bio-row p span {
    width: 200px;
    display: inline-block;
}
/* .bio-row p span.value-data {
   padding-left:20px
} */

.bio-chart, .bio-desk {
    float: left;
}

.bio-chart {
    width: 40%;
}

.bio-desk {
    width: 60%;
}

.bio-desk h4 {
    font-size: 15px;
    font-weight:400;
}

.bio-desk h4.terques {
    color: #4CC5CD;
}

.bio-desk h4.red {
    color: #e26b7f;
}

.bio-desk h4.green {
    color: #97be4b;
}

.bio-desk h4.purple {
    color: #caa3da;
}

.file-pos {
    margin: 6px 0 10px 0;
}

.profile-activity h5 {
    font-weight: 300;
    margin-top: 0;
    color: #c3c3c3;
}

.summary-head {
    background: #ee7272;
    color: #fff;
    text-align: center;
    border-bottom: 1px solid #ee7272;
}

.summary-head h4 {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.summary-head p {
    color: rgba(255,255,255,0.6);
}

ul.summary-list {
    display: inline-block;
    padding-left:0 ;
    width: 100%;
    margin-bottom: 0;
}

ul.summary-list > li {
    display: inline-block;
    width: 19.5%;
    text-align: center;
}

ul.summary-list > li > a > i {
    display:block;
    font-size: 18px;
    padding-bottom: 5px;
}

ul.summary-list > li > a {
    padding: 10px 0;
    display: inline-block;
    color: #818181;
}

ul.summary-list > li  {
    border-right: 1px solid #eaeaea;
}

ul.summary-list > li:last-child  {
    border-right: none;
}

.activity {
    width: 100%;
    float: left;
    margin-bottom: 10px;
}

.activity.alt {
    width: 100%;
    float: right;
    margin-bottom: 10px;
}

.activity span {
    float: left;
}

.activity.alt span {
    float: right;
}
.activity span, .activity.alt span {
    width: 45px;
    height: 45px;
    line-height: 45px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    background: #eee;
    text-align: center;
    color: #fff;
    font-size: 16px;
}

.activity.terques span {
    background: #8dd7d6;
}

.activity.terques h4 {
    color: #8dd7d6;
}
.activity.purple span {
    background: #b984dc;
}

.activity.purple h4 {
    color: #b984dc;
}
.activity.blue span {
    background: #90b4e6;
}

.activity.blue h4 {
    color: #90b4e6;
}
.activity.green span {
    background: #aec785;
}

.activity.green h4 {
    color: #aec785;
}

.activity h4 {
    margin-top:0 ;
    font-size: 16px;
}

.activity p {
    margin-bottom: 0;
    font-size: 13px;
}

.activity .activity-desk i, .activity.alt .activity-desk i {
    float: left;
    font-size: 18px;
    margin-right: 10px;
    color: #bebebe;
}

.activity .activity-desk {
    margin-left: 70px;
    position: relative;
}

.activity.alt .activity-desk {
    margin-right: 70px;
    position: relative;
}

.activity.alt .activity-desk .panel {
    float: right;
    position: relative;
}

.activity-desk .panel {
    background: #F4F4F4 ;
    display: inline-block;
}


.activity .activity-desk .arrow {
    border-right: 8px solid #F4F4F4 !important;
}
.activity .activity-desk .arrow {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    left: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .arrow-alt {
    border-left: 8px solid #F4F4F4 !important;
}

.activity-desk .arrow-alt {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    right: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .album {
    display: inline-block;
    margin-top: 10px;
}

.activity-desk .album a{
    margin-right: 10px;
}

.activity-desk .album a:last-child{
    margin-right: 0px;
}
/* Style the Image Used to Trigger the Modal */
img {
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
}

.bio-graph-info {
    color: #89817e;
}
button.btn.btn-primary.btn-sm.pull-right.m-5.sendPush {
    padding: 10px 20px 10px 20px;
    /* margin-right: 105px; */
    margin-left: 10px !important;
    margin-right: 20px !important;
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
.common-confirm{
    
}
</style>

@php
    use Carbon\Carbon;

    $current_date = Carbon::now(); // Get the current date and time
    $checkin_date = Carbon::parse($booking->checkin_date); // Parse the check-in date
    $checkout_date = Carbon::parse($booking->checkout_date); // Parse the checkout date

    // Define the threshold as one day before the check-in date, at 11:59 PM
    $cancel_threshold = $checkin_date->copy()->subDay()->setTime(23, 59);

    // Normal check-in condition: When the check-in date matches the current date exactly
    $is_normal_checkin = $checkin_date->isSameDay($current_date);
//dd($is_normal_checkin);
    // Abnormal check-in condition: When the current date is after the check-in date but still before or on the checkout date
    $is_abnormal_checkin = $current_date->greaterThan($checkin_date) && $current_date->lessThanOrEqualTo($checkout_date);
    
    //dd($is_abnormal_checkin);
@endphp


<!-- Start Page content -->
<section class="content" style="margin-left:25px">
    {{--
    <div class="container-fluid"> --}}


        <div class="row" style="margin-top:30px;margin-left:0px">
            <div class="col-12">

                <div class="box" style="margin-bottom:0px;">
                <div class="box-header with-border">
                            <a href="{{url('/')}}/room-booking">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    Back                                </button>
                            </a>
                        </div>
                    <div class="box-header with-border">
                        <div style="color:black;font-size:18px">
                            <h5 class="font-weight-600 p-5" style="color:black;font-size:21px">Booking Detail Overview </h5>
                        </div>

                    </div>

                    <div class="box-body " style=" padding: 30px;">
                        <!-- <input name='range' id='cal' />  -->
                        <div class="row text-center">
                            <div class="col-12">
                                <!-- <a href="http://localhost/ias-mess/public/users"> -->
                                <div class="box p-5" style="text-align: left;border-radius:10px;padding-left: 25px !important;padding-bottom: 25px !important;background: #fff !important;">
                                    <div style="color:black;font-size:18px;margin-top: 20px;">
                                        <h5 class="font-weight-600 p-5" style="color:black;font-size:17px">User Details</h5> 
                                        <div class="row" style="
    padding: 20px;
">
 <div class="col-3 col-sm-6" style="
    margin-left: 15px;
    margin-right: 30px;
">
<div class="image">

<img src="{{$booking->user->profile_picture}}" width="100%" height="100%"> 
</div>

 
                                        </div>
                                        <div class="col-6 col-sm-6" style="
    margin-left: 15px;
    margin-right: 30px;
    /* margin-top: 20px; */
">


<p><i class="fa fa-user" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{$booking->user->salutation}} {{$booking->user->name}} </span></p>




<p><i class="fa fa-phone" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{$booking->user->mobile}} </span></p><p><i class="fa fa-envelope" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{$booking->user->email}} </span></p>
<p><i class="fa fa-home" aria-hidden="true"></i> <span style="
    
    font-size: 15px;
">{{$booking->user->address}} </span></p>

                                        </div>
                                        </div>
                                        </div>


                                    </div>
                                    <!-- </a> -->
                                </div>
                                <div class="col-12">
                                <!-- <a href="http://localhost/ias-mess/public/users"> -->
                                <div class="box p-5" style="text-align: left;border-radius:10px;padding-left: 25px !important;padding-bottom: 25px !important;background: #fff !important;">
                                    <div style="color:black;font-size:18px;margin-top: 20px;">
                                        <h5 class="font-weight-600 p-5" style="color:black;font-size:17px">Booking Details</h5> 
                                        <div class="row bio-graph-info" style="padding: 20px;">
                                <div class="bio-row">
                                    <p><span>Booking ID </span><span class="value-data">: {{$booking->booking_id}}</span></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Booked By </span>: <span>{{$booking->user->name}}</span> </p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Booked On </span><span class="value-data">:  <?php echo date('d-m-Y', strtotime($booking->created_at)); ?></span></p>
                                </div>
                                  <div class="bio-row">
                                    <p><span>No of Days </span><span class="value-data">: {{$booking->no_of_days}}</span></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Check In Date </span><span class="value-data">:<?php echo date('d-m-Y', strtotime($booking->checkin_date)); ?></span></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Check Out Date</span><span class="value-data">: <?php echo date('d-m-Y', strtotime($booking->checkout_date)); ?></span></p>
                                </div>
                                @if($booking->status > 0)
                                @if($booking->status >= 1)
                                <div class="bio-row">
                                    <p><span>Actual Check In Time</span><span class="value-data">: <?php echo date('d-m-Y H:i:s A', strtotime($booking->actual_checkin_date)); ?></span></p>
                                </div>
                                @endif
                                @if($booking->status >= 2)
                                <div class="bio-row">
                                    <p><span>Actual Check Out Time</span><span class="value-data">: <?php echo date('d-m-Y H:i:s A', strtotime($booking->actual_checkout_date)); ?></span></p>
                                </div>
                                @endif 
                                @endif
                               
                                
                                <div class="bio-row">
                                    <p><span>No of Rooms </span><span class="value-data">: {{$booking->no_of_rooms}}</span></p>
                                </div>
                              
                                <div class="bio-row">
                                    <p><span>No of Guests </span><span class="value-data">: {{$booking->no_of_guests}}</span></p>
                                </div>
                                 
                                <div class="bio-row">
                                    <p><span>Tariff Amount </span><span class="value-data">: 
                                        @if(isset($booking->booked_price->total_price))
                                        ₹{{$booking->booked_price->total_price}}
                                        @endif</span></p>
                                </div>  
                                
                                <div class="bio-row">
                                    <!--   <div class="col-12"> -->
                                    <!--        <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete1" type="button" data-id="{{$booking->id}}">-->
                                    <!--        <i class="fa fa-sign-out" aria-hidden="true" style="color:white" ></i>-->
                                    <!--        Check In </button> -->
                                    <!--</div>-->
                                </div>
                                </div> 
                                @if(auth()->user()->hasRole('mess-manager'))
                                @if($date_diff <= 0 && $booking->status == 0)
                                @if($is_normal_checkin)
                                <div class="form-group">
                                    <div class="col-12"> 
                                            <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete1" type="button" data-id="{{$booking->id}}">
                                            <i class="fa fa-sign-out" aria-hidden="true" style="color:white" ></i>
                                            Check In </button> 
                                    </div>
                                </div>
                                 @elseif($is_abnormal_checkin && $booking->booking_type == 0)
                                        <button class="btn btn-primary btn-md pull-right m-5 sendPush sweet-delete1" type="button" data-id="{{$booking->id}}">
                                            <i class="fa fa-sign-out" aria-hidden="true" style="color:white"></i> Check In (Abnormal)
                                        </button>
                                    @endif 
                                @endif
                                @if($booking->status == 1)
                                <div class="form-group">
                                    <div class="col-12"> 
                                            <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete2" type="button" data-id="{{$booking->id}}">
                                            <i class="fa fa-sign-out" aria-hidden="true" style="color:white" ></i>
                                            Check Out </button> 
                                    </div>
                                </div>
                                @endif
                                @elseif($date_diff > 0 && $booking->status == 0) 
                                @if($booking->is_admin_approve == 0 && $booking->status == 0) 
                                @if(auth()->user()->hasRole('super-user'))
                                <div class="form-group">
                                    <div class="col-12"> 
                                            <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete3" type="button" data-id="{{$booking->id}}">
                                            <i class="fa fa-trash" aria-hidden="true" style="color:white" ></i>
                                           Approve Booking  </button> 
                                            <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete" type="button" data-id="{{$booking->id}}">
                                            <i class="fa fa-trash" aria-hidden="true" style="color:white" ></i>
                                            Cancel Booking  </button>
                                            
                                    </div>
                                </div>
                                @endif
                                @else
                                <div class="form-group">
                                    <div class="col-12">
                                       
                                            <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete" type="button" data-id="{{$booking->id}}">
                                            <i class="fa fa-trash" aria-hidden="true" style="color:white" ></i>
                                            Cancel Booking  </button>
                                            <a href="{{url('/')}}/types/edit/{{$booking->id}}">
                                            <button class="btn btn-primary btn-sm pull-right m-5 sendPush" type="button">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:white"></i>
                                            Modify Booking</button>
                                            
                                        </a>
                                    </div>
                                </div>
                                @endif
                                
                                @endif 
                                        </div>
                                        
                                        <!--<div class="col-12"> -->
                                        <!--    <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete1" type="button" data-id="{{$booking->id}}">-->
                                        <!--    <i class="fa fa-sign-out" aria-hidden="true" style="color:white" ></i>-->
                                        <!--    Check In </button> -->
                                    </div>

  <!--<div class="col-12"> -->
  <!--                                          <button class="btn btn-primary btn-sm pull-right m-5 sendPush sweet-delete1" type="button" data-id="{{$booking->id}}">-->
  <!--                                          <i class="fa fa-sign-out" aria-hidden="true" style="color:white" ></i>-->
  <!--                                          Check In </button> -->
  <!--                                  </div>-->
                                    </div>
                                    <!-- </a> -->
                                </div>
                            </div>

                        </div> 
                    </div> 
                </div>
            </div> 
        <!-- container -->


        <script src="{{ asset('assets/js/fetchdata.min.js') }}"></script>
    <script>
var currentDate;
$(document).ready(function() {
    // Get current date in Indian Standard Time (IST)
    var currentDateIST = new Date().toLocaleString('en-US', {
        timeZone: 'Asia/Kolkata'
    });
    console.log('Current IST Date: ' + currentDateIST);

    // Create a new Date object using the IST date string
    currentDate = new Date(currentDateIST);
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
    $('#to_date').attr('min', currentDateFormatted);
    console.log('Min attribute for #from_date and #to_date set to: ' + currentDateFormatted);

    // Set the default value of the date inputs to current date
    // $('#from_date').val(currentDateFormatted);
    // $('#to_date').val(currentDateFormatted);
    $('#user').on('change', function() {
        var url = "{{url('/')}}/get-user-details";
        var data = $(this).val();
        $.ajax({
            url: url,
            data: {
                data: data
            },
            cache: false,
            success: function(res) {
                if (res.status) {
                    $("#user_id").val(res.user.userid);
                    $("#mobile_no").val(res.user.mobile);
                    $("#email_address").val(res.user.email);
                }
            }
        });
    });
    $('#from_date').on('change', function() {
        from_date = $(this).val();
        currentDate = new Date(from_date.split('/').reverse().join('-'));
        var nextDayDate = new Date(currentDate);
        nextDayDate.setDate(nextDayDate.getDate() + 1);

        // Extract date components for the next day date
        var nextYear = nextDayDate.getFullYear();
        var nextMonth = (nextDayDate.getMonth() + 1).toString().padStart(2, '0');
        var nextDay = nextDayDate.getDate().toString().padStart(2, '0');

        // Format date as YYYY-MM-DD
        var nextDayDateFormatted = nextYear + '-' + nextMonth + '-' + nextDay;
        console.log('Formatted Next Day Date: ' + nextDayDateFormatted);

        // Set the default value of the to_date input to the next day date 
        $('#to_date').attr('min', nextDayDateFormatted);
        $(".book-now").removeClass("active");
        $(".danger-book").removeClass("active");
        $(".danger-book").html('');
        $(".danger-book").removeClass("error");
    });
    $('#to_date').on('change', function() {
        var checkinDate = $(this).val();

        $('#from_date').attr('max', checkinDate);
        $(".book-now").removeClass("active");
        $(".danger-book").removeClass("active");
        $(".danger-book").html('');
        $(".danger-book").removeClass("error");
    });
    $('#room').on('keyup', function() {
        $(".book-now").removeClass("active");
        $(".danger-book").removeClass("active");
        $(".danger-book").removeClass("error");
        $(".danger-book").html('');
    });
});

$(".book-now").click(function() {
    let url = "{{url('/')}}/types/book-now";

    var form_data = new FormData($("#room-booking")[0]);

    $.ajax({
        url: url,
        type: 'post',
        data: form_data,
        cache: false,
        contentType: false, // Default for form submissions
        processData: false, // Tells jQuery to process the data (default: true)
        success: function(res) {
            if (res.status) {
                popup_init();
                popup_data(` 
                                <div class="popup-card"> 
                                    <div class="popup-card-content" style="
    text-align: center;
"> 
                                        <img src="{{asset('assets/img/Booking Confirmed.png')}}" style="margin:auto;width: 200px;height: 200px;" alt="">
                                        <h4 style="
    font-weight: 600;
">Booking Confirmed Successfully</h4>
                                        <a class="btn btn-success" style="font-size:16px;margin: auto;margin-top: 20px;" href="{{url("/")}}/types/view-invoice/{{$booking->id}}">Close</a>
                                    </div>
                                    </div>
                                `);
                setTimeout(function() {

                    window.location.reload();
                }, 2000);
            } else {
                $(".book-now").removeClass("active");
                $(".danger-book").addClass("error");
                $(".danger-book").removeClass("active");
                $(".danger-book").html(res.message);
            }
        }
    });
});
$('.check_availabiity').on('click', function(e) {
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var room = $("#room").val();
    var guest = $("#guest").val();
    var guest_type = $("#guest_type").val();
    var user = $("#user").val();
    if (from_date == "" || to_date == "") {
        $(".danger-book").addClass("error");
        $(".danger-book").removeClass("active");
        $(".danger-book").html("Please Select Check In and Check Out date");
    } else if (room == "") {
        $(".danger-book").addClass("error");
        $(".danger-book").removeClass("active");
        $(".danger-book").html("Please Select No of Rooms");
    } else if (guest == "") {
        $(".danger-book").addClass("error");
        $(".danger-book").removeClass("active");
        $(".danger-book").html("Please Enter the Guest Count");
    } else if (guest_type == "" || guest_type === null) {
        $(".danger-book").addClass("error");
        $(".danger-book").removeClass("active");
        $(".danger-book").html("Please Select the Guest Type");
    } else {
        var status = true;
        @if(auth() -> user() -> hasrole("super-user"))

        if (user == "") {

            status = false;
            $(".danger-book").addClass("error");
            $(".danger-book").removeClass("active");
            $(".danger-book").html("Please Select Users");
        }
        @endif
        if (status) {
            let url = "{{url('/')}}/types/check-availability";
            var form_data = new FormData($("#room-booking")[0]);
            $.ajax({
                url: url,
                type: 'post',
                data: form_data,
                cache: false,
                contentType: false, // Default for form submissions
                processData: false, // Tells jQuery to process the data (default: true)
                success: function(res) {
                    if (res.status) {
                        $(".book-now").addClass("active");
                        $(".danger-book").removeClass("error");
                        $(".danger-book").addClass("active");
                        $(".danger-book").html(res.message);
                    } else {
                        $(".book-now").removeClass("active");
                        $(".danger-book").addClass("error");
                        $(".danger-book").removeClass("active");
                        $(".danger-book").html(res.message);
                    }
                }
            });
        }



    }

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

        fetch('types/fetch?search=' + search_keyword)
            .then(response => response.text())
            .then(html => {
                document.querySelector('#js-types-partial-target').innerHTML = html
            });
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

$(document).on('click', '.sweet-delete2', function(e) {
    e.preventDefault();
    let url = $(this).attr('data-url');
    let data_id = $(this).attr('data-id');

    swal({
        title: "Are you sure you want to proceed with the check-out?",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#0A7E8C",
        confirmButtonText: "Yes, proceed",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            swal.close();
            popup_init();
            popup_data(`<div class="popup-card"> 
                                    <form id="checkout-booking">
                                    @csrf
                                    <div class="popup-card-content" style="text-align: center;">  
                                    <div class="form-group " style=" text-align: left; font-size: 15px">
                                    <h4 style="font-weight:800">Addtional Charges : </h4>
                                    <br>
                                        <label for="add_charge">Add Restaurant Charge </label>
                                        <div class="switch3" style="vertical-align: top;float:right"> <input id="add_charge" class="check-toggle check-toggle-round-flat" type="checkbox" name="add_charge">        <label for="add_charge"></label>
                                        <span class="on">No</span>  <span class="off">Yes</span>
                                    </div>
                                    </div>
                                    
                                        <div class="form-group amount-data1" style="margin-top: 20px;display:none">
                                    
                                        <input type="number" id="number" placeholder="Enter the amount" style="width: 100%;" name="price">
                                    </div>
                                    </form>
                    <br>
                    <div class="response-error" style="
                    color: red;
                    font-weight: 600;
                    font-size: 15px;
                    margin-bottom: 15px;"></div>  
                    </div>
                    <div class="text-center m-b-0" style="/* background: #0A7E8C; */">
                                <button class="generate_invoice btn btn-custom waves-effect waves-light make-confirm" data-url="{{url('/')}}/types/confirm-checkout/{{$booking->id}}" type="button" style="background: #0A7E8C;
                                        padding-left: 30px;padding-right: 30px;color:white;">Generate Invoice</button>
                                </div> 
                                                                </div>
                                                                </div>
                                `);
                                
                                
                                
                                
                                
    document.getElementById('number').addEventListener('input', function (e) {
        // Allow only numbers, backspace, and delete keys
        let value = this.value;
        // Replace anything that is not a number
        this.value = value.replace(/[^0-9]/g, '');
    });

     $("#add_charge").change(function() {
    if ($(this).is(':checked')) {
        //console.log('Checkbox is checked');
        $(".amount-data1").show();
    } else {
        console.log('Checkbox is not checked');
        $(".amount-data1").hide();
        // Clear the value of the input field when "No" is selected
        $("#number").val('');
    }
});
            $(document).on('click', '.generate_invoice', function(e) {
                e.preventDefault();
                // alert("add_charge");
                let url = $(this).attr('data-url');
                let data_id = $(this).attr('data-id');
                $(".response-error").hide();
                $(this).addClass("spinner");
                console.log($("#date").val());
                console.log($("#add_charge").is(':checked'));
                var status = 1;
                // alert($("#add_charge").is(':checked'));
                if ($("#add_charge").is(':checked') === true) {
                    if ($("#number").val() == "" || $("#number").val() === undefined || $("#number").val() === null) {
                        status = 0;
                        $(this).removeClass("spinner");
                        $(".response-error").show();
                        $(".response-error").html("Please select the amount");
                    }
                }
                if (status == 1) {
                    var form_data = new FormData($("#checkout-booking")[0]);
                    $.ajax({
                        url: '{{url("/")}}/types/confirm-checkout/{{$booking->id}}',
                        type: 'post',
                        data: form_data,
                        cache: false,
                        dataType: 'json',
                        contentType: false, // Default for form submissions
                        processData: false, // Tells jQuery to process the data (default: true) 
                        success: function(res) {
                            if (res.status) {
                                window.location.href = '{{url("/")}}/types/view-invoice/{{$booking->id}}';
                               
                            }

                        }
                    });
                }

            });


            let checkinDate = new Date('{{$booking->checkin_date}}');

        }
    });
});
let remainingDays;
$(document).on('click', '.sweet-delete1', function(e) {
    e.preventDefault();
    let url = $(this).attr('data-url');
    let data_id = $(this).attr('data-id');
     let checkinDate = new Date('{{$booking->checkin_date}}');
    let checkoutDate = new Date('{{$booking->checkout_date}}'); 
    let today = new Date(); // Current date
     
      function calculateDaysDifference(startDate, endDate) {
        let diffTime = endDate.getTime() - startDate.getTime();
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        return diffDays;  
    }

    swal({
        title: "Are you sure you want to proceed with the check-in?",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#0A7E8C",
        confirmButtonText: "Yes, proceed",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
             var initialTotalPrice = Math.round(parseFloat('{{$booking->booked_price->total_price}}'));
            //  let stayAmount = Math.round(tariffAmount);
           let isAbnormalCheckin = today > checkinDate;
            if (isAbnormalCheckin) {
                 remainingDays = parseInt(calculateDaysDifference(today, checkoutDate)) - 1; 
                let totalDays = parseInt(calculateDaysDifference(checkinDate, checkoutDate)) - 1;  
                let tariffPerDay = Math.round(initialTotalPrice / totalDays); // Round off per day tariff
                console.log(tariffPerDay);
                console.log(initialTotalPrice);
                console.log(totalDays);
                 console.log(remainingDays);
                if (remainingDays > 0) {
                    initialTotalPrice = Math.round(remainingDays * tariffPerDay); // Round off stay amount
                }

                if (initialTotalPrice === 0) {
                    initialTotalPrice = Math.round(parseFloat('{{$booking->booked_price->total_price}}')); // Ensure it's rounded off
                }
            } 
            swal.close();
            popup_init();
           
            var currentTotalPrice = initialTotalPrice;
            // var currentTotalPrice = displayStayAmount;
            var content = `<div class="popup_deceased">
                        <form id="confirm-checkin-booking">
                        @csrf
                        <div class="form-group" style="margin-top: 20px;">
                    <label for="image" style="font-size: 16px;"> Checkin Date  </label><br> 
                    <input type="hidden" name="id" value="{{$booking->id}}">
                    <input type="text" id="date" name="date" value="<?php echo date('d-m-Y', strtotime($booking->checkin_date)); ?>" style="width: 100%; border: 1px solid #ccc; background-color: #f8f8f8;padding-left: 9px;
    padding-top: 11px;" readonly></div><div class="form-group" style="margin-top: 20px;"><label for="image" style="font-size: 16px;">Checkout Date</label><br> <input type="text" style="width: 100%;" disabled value="<?php echo date('d-m-Y', strtotime($booking->checkout_date)); ?>"></div> 
                    <div class="table-container col-md-12" style="
    margin: 0px 40px 20px 7px;
">
    <table id="room-tariff"> <thead> 
                                    <tr>
                                                <td> Room</td>
                                    
                                                <td> Select Guest Type</td>
                                    </tr> 
                                        </thead> 
                                        <tbody id="tariff"> `;
            @foreach($booking -> booking_guest_details as $key => $value)
            content += `<tr>
                        <td> {{$value->room}}</td>
                        <td>
                        <select name="guest_type[{{$value->room}}]"  class="form-control guest-type-select" required="" style="margin-top: 5px;padding:10px; height: 42px;">
                                    <option value="self" @if($value->guest_type == "self") selected @endif>Self</option>
                                    <option value="family"  @if($value->guest_type == "family") selected @endif>Family</option>
                                    <option value="guest"  @if($value->guest_type == "guest") selected @endif>Guest</option>
                                </select>
                        </td> 
                        </tr>`;
            @endforeach

            content += `</tbody></table>
</div>
<div class="form-group ">
<label for="amount">Minimum advance amount </label>
<div class="switch4" style="vertical-align:middle;float:right"> 
<input id="amount" class="check-toggle check-toggle-round-flat" type="checkbox" name="amount">
<label for="amount"></label><span class="on">No</span><span class="off">Yes</span>
</div></div>

<div class="form-group amount-data" style="margin-top: 20px; display:none;">
                    <label for="image" style="font-size: 16px;">Enter the amount</label><br> 
                    <input type="number" id="number" placeholder="Enter the amount" style="width: 100%;" name="price">
</div><div class="form-group">
    <label for="image" style="font-size: 16px;">Total Price</label><br>
    <span class="membership-price" style="font-size: 26px;">₹${initialTotalPrice}</span><br>
    <div class="response-error" style="text-align: center; margin-bottom: 10px; color: red; font-size: 14px; display: none;"></div>
    <div class="text-center m-b-0">
        <button class="confimr btn btn-custom waves-effect waves-light common-confirm make-confirm" data-url="{{url('/')}}/types/confirm-checkin/{{$booking->id}}" type="button" style="padding-left: 30px; padding-right: 30px; color:white;background-color:#0A7E8C;">Confirm</button>
        <button class="confimr1 btn btn-custom waves-effect waves-light  common-confirm send-payment-link" data-url="{{url('/')}}/types/send-payment-link/{{$booking->id}}" type="button" style="padding-left: 30px; padding-right: 30px; color:white;background-color:#0A7E8C;display:none">Send Payment Link</button>
    </div><br> 
</div>
</form>
</div>`;
            popup_data(content);

            // Recalculate total price when guest type changes
            $('.guest-type-select').on('change', function() {
                var roomTariffs = {};
                console.log("dfgdfgdfgfdgdfgdfgdfg");
                $('#room-tariff select').each(function() {
                    console.log($(this).val());
                    var selectedGuestType = $(this).val();
                    var room = $(this).attr('name').match(/\d+/)[0]; // Extract room number
                    roomTariffs[room] = selectedGuestType;
                });

                recalculateTotalPrice(roomTariffs);
            });

            function recalculateTotalPrice(roomTariffs) {
                console.log(roomTariffs);
                currentTotalPrice = 0; // Reset to calculate the new total
                $.each(roomTariffs, function(room, guestType) {
                    var tariff_url = "{{ url('/types/get-tariff') }}"; 
                    var days_count = 1; // Adjust as necessary

                    $.ajax({
                        url: tariff_url,
                        type: 'GET',
                        data: {
                            day: days_count,
                            guest_type: guestType
                        },
                        async: false, // This ensures requests are handled one at a time
                        success: function(response) {
                            if (response.success) {
                                currentTotalPrice += (parseFloat(response.price) * remainingDays);
                            } else {
                                console.error('Failed to fetch tariff for room ' + room);
                            }
                        },
                        error: function(xhr) {
                            console.error('An error occurred while fetching the tariff for room ' + room);
                        }
                    });
                });

                // Update the total price display
                $(".membership-price").text(`₹ ${currentTotalPrice}`);
            }

            $("#amount").change(function() {
                // alert("Edcedcedc");
                if ($(this).is(':checked')) {
                    $(".send-payment-link").show();
                     $(".make-confirm").hide();
                    $(".amount-data").show();
                    $("#number").on('input', function() { 
                        if($(this).val() != "")
                        {
                             var advanceAmount = parseFloat($(this).val()); 
                            if (advanceAmount <= currentTotalPrice) {
                                $(".membership-price").text(`₹ ${(currentTotalPrice - advanceAmount)}`);
                            } else {
                                $(this).val(currentTotalPrice);
                                $(".membership-price").text(`₹ 0`);
                            }
                        }
                        else{
                            $(".membership-price").text(`₹ ${currentTotalPrice}`); 
                            
                        }
                       
                    });
                } else {
                    $(".amount-data").hide();
                    $("#number").val('');
                    $(".response-error").hide();
                    $(".membership-price").text(`₹ ${currentTotalPrice}`); // Reset to original price without deduction
                     $(".send-payment-link").hide();
                     $(".make-confirm").show();
                }
            });
        }
    });
});

$(document).on('click', '.confimr', function(e) {
    let url = $(this).attr('data-url');
    $(".response-error").hide();
    //$(this).addClass("spinner");
    var status = 1;

    if ($("#date").val() == "" || $("#date").val() == null) {
        //$(this).removeClass("spinner");
        $(".response-error").show();
        $(".response-error").html("Please select the Checkin date");
        status = 0;
    }

    if ($("#amount").is(':checked') === true) {
        let totalPrice = parseFloat($('.membership-price').text().replace('₹', '').replace(',', ''));
        let advanceAmount = parseFloat($("#number").val());

        if ($("#number").val() == "" || $("#number").val() === undefined || $("#number").val() === null) {
            status = 0;
            //$(this).removeClass("spinner");
            $(".response-error").show();
            $(".response-error").html("Please enter the amount");
        } 
        // else if (advanceAmount > 0) {
        //     status = 0;
        //     $(this).removeClass("spinner");
        //     $(".response-error").show();
        //     $(".response-error").html("Advance amount cannot be more than the total price.");
        // }
    }

    if (status == 1) {
        var form_data = new FormData($("#confirm-checkin-booking")[0]);

        // Add the total_price to the form data before sending it to the server
        let totalPrice = parseFloat($('.membership-price').text().replace('₹', '').replace(',', ''));
        form_data.append('total_price', totalPrice);

        $.ajax({
            url: url,
            type: 'post',
            data: form_data,
            cache: false,
            contentType: false, // Default for form submissions
            processData: false, // Tells jQuery not to process the data (default: true)
            success: function(res) {
                if (res.status) {
                    popup_data(`  <div class="popup-card"> 
                                        <div class="popup-card-content" style="text-align: center;"> 
                                            <img src="{{asset('assets/img/Booking Confirmed.png')}}" style="margin:auto;width: 200px;height: 200px;" alt="">
                                            <h4 style="font-weight: 600;">Checkin Done Successfully</h4>
                                            <a class="btn btn-success" style="font-size:16px;margin: auto;margin-top: 20px;" href="{{url("/")}}/types/view-invoice/{{$booking->id}}">View Invoice</a>
                                        </div>
                                    </div>`);
                } else {
                    $(".response-error").show();
                    $(".response-error").html(res.message || "An error occurred during check-in.");
                }
            },
            error: function(xhr) {
                $(".response-error").show();
                $(".response-error").html("An unexpected error occurred during the check-in process.");
            },
            complete: function() {
                $(this).removeClass("spinner");
            }
        });
    }
});


$(document).on('click', '.confimr1', function(e) {
    e.preventDefault();
    
    let url = $(this).attr('data-url');
    $(".response-error").hide();
    //$(this).addClass("spinner");
    let status = 1;

    // Validate check-in date
    if ($("#date").val() == "" || $("#date").val() == null) {
        $(this).removeClass("spinner");
        $(".response-error").show();
        $(".response-error").html("Please select the Check-in date");
        status = 0;
    }

    // Validate amount if checked
    if ($("#amount").is(':checked') === true) {
        let totalPrice = parseFloat($('.membership-price').text().replace('₹', '').replace(',', ''));
        let advanceAmount = parseFloat($("#number").val());

        if ($("#number").val() == "" || $("#number").val() === undefined || $("#number").val() === null) {
            status = 0;
            $(this).removeClass("spinner");
            $(".response-error").show();
            $(".response-error").html("Please enter the amount");
        }
        // else if (advanceAmount > totalPrice) {
        //     status = 0;
        //     $(this).removeClass("spinner");
        //     $(".response-error").show();
        //     $(".response-error").html("Advance amount cannot be more than the total price.");
        // }
    }

    // If validation passes
    if (status === 1) {
        let form_data = new FormData($("#confirm-checkin-booking")[0]);

        // Add the total price to the form data before sending it
        let totalPrice = parseFloat($('.membership-price').text().replace('₹', '').replace(',', ''));
        form_data.append('total_price', totalPrice);

        swal({
            title: "Are you sure you want to send the payment link?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0A7E8C",
            confirmButtonText: "Send Payment Link",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true // Enables loader on confirm
        }, function(isConfirm) {
            if (isConfirm) {
                // Show the loading spinner inside the SweetAlert modal
                swal({
                    title: 'Sending...',
                    text: 'Please wait while we send the payment link.',
                    imageUrl: '{{asset("assets/img/loader.gif")}}', // Path to your loader gif or image
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                $.ajax({
                    url: url,
                    type: 'post',
                    data: form_data,
                    cache: false,
                    contentType: false, // Default for form submissions
                    processData: false, // Prevent jQuery from processing the data
                    success: function(res) {
                        if (res.status) {
                            swal.close(); // Close the SweetAlert on success
                            // Show success popup and hide form
                            popup_data(`  
                                <div class="popup-card"> 
                                    <div class="popup-card-content" style="text-align: center;"> 
                                        <img src="{{asset('assets/img/Booking Confirmed.png')}}" style="margin:auto;width: 200px;height: 200px;" alt="">
                                        <br>
                                        <h4 style="font-weight: 600;">Payment Link Successfully Sent</h4>
                                        
                                    </div>
                                </div>`);
                            $("#confirm-checkin-booking").hide(); // Hide the form after success
                        } else {
                            $(".response-error").show();
                            $(".response-error").html(res.message || "An error occurred during check-in.");
                        }
                    },
                    error: function(xhr) {
                        $(".response-error").show();
                        $(".response-error").html("An unexpected error occurred during the check-in process.");
                    },
                    complete: function() {
                        $('.confimr1').removeClass("spinner"); // Ensure spinner is removed properly
                    }
                });
            }
        });
    }
});









$(document).on('click', '.sweet-delete3', function(e) {
    e.preventDefault();

    let url = $(this).attr('data-url');
    let data_id = $(this).attr('data-id');

    swal({
        title: "Are you sure to approve the booking?",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Approve Booking",
        cancelButtonText: "No! Keep it",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            swal.close();
            $.ajax({
                url: '{{url("/")}}/types/approve-booking/' + data_id + '',
                cache: false,
                success: function(res) {
                    if (res.status) {
                        $.toast({
                            heading: '',
                            text: res.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            stack: 1
                        });
                        window.location.reload();
                    }

                }
            });
        }
    });
});

$(document).on('click', '.sweet-delete', function(e) {
    e.preventDefault();

    let url = $(this).attr('data-url');
    let data_id = $(this).attr('data-id');

    swal({
        title: "Are you sure to cancel the booking?",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Cancel Booking",
        cancelButtonText: "No! Keep it",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            swal.close();
            $.ajax({
                url: '{{url("/")}}/types/cancel-booking/' + data_id + '',
                cache: false,
                success: function(res) {
                    if (res.status) {
                        $.toast({
                            heading: '',
                            text: res.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            stack: 1
                        });
                        setTimeout(function() {
                            window.location.href = "{{url('/')}}/room-booking";
                        }, 2000);
                    }

                }
            });
        }
    });
}); 
</script>







        @endsection 