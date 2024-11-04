
<!DOCTYPE html>
<html lang="en">

<head>
    <title>DubuDubu Technologies</title>
    <meta name="SearchTitle"
        content="DubuDubu Tech: Website Development | App Development | Graphic Design | Software Development"
        scheme="" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description"
        content="DubuDubu Tech: Website Development | App Development | Digital Marketing | Graphic Design | Software Development">
    <meta property="og:title"
        content="DubuDubu Tech: Website Development | App Development | Digital Marketing | Graphic Design | Software Development" />
    <meta property="og:url" content="" />
    <meta property="og:description"
        content="DubuDubu Tech: Website Development | App Development | Digital Marketing | Graphic Design | Software Development ">
    <meta property="og:image" content="https://aristostech.in/images/logo-title.png">
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@0.4.1/dist/html2canvas.min.js"></script>
    



    <style>
        /* ul.tab-btns.tab-buttons.clearfix li {
            width: 200px;
        }

        .service-block.col-xl-4.col-lg-6.col-md-6.col-sm-12.wow.fadeInLeft {
            cursor: pointer;
        } */
        p {
            user-select: none;
        }

        body {
            padding: 20px;
        }

        .form-section {
            margin-bottom: 1.5rem;
        }

        .amount-input {
            max-width: 150px;
        }

        element.style {
            padding: 0px;
        }
        table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table th,table tr td {
        background:none !important;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2 !important;
    }
    .pageNo-1 {
        background-color: #edeec9;
        color: black;
    }
    .pageNo-2 {
        background-color:#dde7c7;
        color: black;

    }
    .pageNo-3 {
        background-color: #bfd8bd;
        color: black;
    }
    .pageNo-4 {
        background-color:#98c9a3;
        color: black;
    }
    .pageNo-5 {
        background-color:#77bfa3;
        color: black;
    }
    .timer1 {
        font-size: 25px;
        text-align: center;

    }
    .formtimer {
        font-size: 20px;
        text-align: center;
        border-radius: 10px;
    }
    .disable{
        cursor: not-allowed;
    }
    .overlay{
        position: fixed;
        top: 110px;
        left: 10px;
        background: #e1e0e0;
        height: 1000px;
        max-height: 100vh;
        width: 100%;
        z-index: 10;
        opacity: 0.5;
        display: none;
    }
        
        </style>

    <!-- Stylesheets -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Teko:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/owl.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/flaticon.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/animate.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/jquery-ui.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/hover.css" rel="stylesheet">
    <link rel="stylesheet" href="https://dubudubutechnologies.com/public/assets/css/jarallax.css">
    <link href="https://dubudubutechnologies.com/public/assets/css/custom-animate.css" rel="stylesheet">
    <link href="https://dubudubutechnologies.com/public/assets/css/style.css" rel="stylesheet">
    <!-- rtl css -->
    <link href="https://dubudubutechnologies.com/public/assets/css/rtl.css" rel="stylesheet">
    <!-- Responsive File -->
    <link href="https://dubudubutechnologies.com/public/assets/css/responsive.css" rel="stylesheet">

    <!-- Color css -->
    <link rel="stylesheet" id="jssDefault" href="https://dubudubutechnologies.com/public/assets/css/color-default.css">

    <link rel="shortcut icon" href="https://dubudubutechnologies.com/public/assets/images/favicon.ico" id="fav-shortcut"
        type="image/x-icon">
    <link rel="icon" href="https://dubudubutechnologies.com/public/assets/images/favicon.ico" id="fav-icon"
        type="image/x-icon">

    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://aristostech.in/https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="https://aristostech.in/js/respond.js"></script><![endif]-->
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1191117371638706');
        fbq('track', 'PageView');


    </script>
    <noscript>
        <img height="1" width="1" src="https://aristostech.in/https://www.facebook.com/tr?id=1191117371638706&ev=PageView
&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    <section type="hidden" class="backgroundimageforpause" id="backgroundimageforpause1">
        
    <div id="table-container"></div>


    <form id="page_no1-5">
        
        <div class="formtimer" id="formtiming" style="  position: fixed;  right: 21px;  top: 0px;   width: 100%;  background: white; padding-bottom: 14px;  z-index:101;   ">
            <div class="overlay"></div>
            <div class="timer1" id="formtiming1">00:00</div>
            <button class="Start" id="start1" type="button" style="    padding: 4px 15px 0px 15px;">START</button>
            <button class="Pause" id="pause1" type="button" style="    padding: 4px 15px 0px 15px;" disabled>PAUSE</button>
                </div>

             

        <section class="pageNo-1" style="margin-top:90px">
            <!-- page 1 -->
            <div >
                <div> <h3 style="text-align: center;"> PAGE 1</h3></div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Form Date <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="from_date" name="from_date" value=" "
                        data-val="Form Date" required="" placeholder=" " data-label="Form Date">

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Application Date <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="app_date" name="app_date" value="" required=""
                        placeholder=" " data-label="Application Date">
                    <span class="text-danger"></span>

                </div>
            </div>

            <!-- <div class="col-sm-6" style="/* padding-top: 20px; */">
                <div style="font-size: 12px;">Any policy or coverage declined, cancelled or non-renewed during the prior
                    three years </div>
                <div class="row">
                    <div class="col-sm-3">

                        <div class="form-group">
                            <input class="form-group" id="policy_yes" type="radio" name="policy" value=" ">
                            <label for="checkbox_10">yes
                            </label>

                            <input class="form-group" id="checkbox_11" type="radio" name="policy" value=" ">
                            <label for="checkbox_11">no
                            </label>

                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <div class="col-sm-3">If Yes Explain
                            
                            <input class="form-control" type="text" id="explain_yes" name="explain_yes" value=""
                                required="" placeholder="  " data-label="If Yes Explain">
                            <span class="text-danger"></span>
</div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>


        <!--1 gdvfugvdsiufsdhfuikhbv -->

        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="first_name">Agreement Number <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="agreement_no" name="agreement_no" value="" required=""
                        placeholder=" " data-label="Agreement Number">
                    <span class="text-danger"></span>

                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="first_name">Application Number <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="first_name" name="first_name" value="" required=""
                        placeholder=" "data-label="Application Number">
                    <span class="text-danger"></span>

                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="first_name"> Agency Case Number<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="first_name" name="first_name" value="" required=""
                        placeholder=" " data-label="Agency Case Number">
                    <span class="text-danger"></span>

                </div>

            </div>
            </div>
            <!-- <div class="col-sm-2" style="/* padding-top: 20px; */">
                <p> Is this Account new to the procedure</p>
                <div class="card-body" style=" margin-block-start: -37px;">
                    <input class="form-group" id="checkbox_12" type="radio" name="permissions[]" value="">
                    <label for="checkbox_10">yes
                    </label>

                    <input class="form-group" id="checkbox_16" type="radio" name="permissions[]" value="">
                    <label for="checkbox_11">no
                    </label>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">

                    <label for="first_name">If No how many years has this account been handled <span
                            class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="accountbeen_handle" name="accountbeen_handle" value=""
                        required="" placeholder=" " data-label="If No how many years has this account been handled">
                    <span class="text-danger"></span>

                </div>
            </div>
        </div> -->
        <!--2 gvyausvvas -->
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Insured Name <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="insured_name" name="insured_name" value="" required=""
                        placeholder=" " data-label="Insured Name">
                    <span class="text-danger"></span>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Insured Surname <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="insured_surname" name="insured_surname" value=""
                        required="" placeholder=" " data-label="Insured Surname">
                    <span class="text-danger"></span>

                </div>
            </div>

            <!-- <div class="col-sm-2" style="/* padding-top: 20px; */">
                <p> Has the insured ever declared bankruptcy?</p>
                <div class="card-body">
                    <input class="form-group" id="checkbox_13" type="radio" name="policy1" value=" ">
                    <label for="checkbox_10">yes
                    </label>

                    <input class="form-group" id="checkbox_14" type="radio" name="policy1" value=" ">
                    <label for="checkbox_11">no
                    </label>

                </div>
            </div>



            <div class="col-sm-3">

                <div class="form-group">
                    <label for="first_name">If yes give the details <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="get_detailyy" name="get_detailyy" value="" required=""
                        placeholder=" " data-label="If yes give the details">
                    <span class="text-danger"></span>

                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div> -->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

        <!-- 3 gyudvus -->

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="first_name">Mailing Address <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="mailing_add" name="mailing_add" value="" required=""
                        placeholder=" " data-label="Mailing Address">
                    <span class="text-danger"></span>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="first_name">City/State<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="city_stat" name="city_stat" value="" required=""
                            placeholder=" " data-label="City/State">
                        <span class="text-danger"></span>


                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Zip Code <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="zip_cod" name="zip_cod" value="" required=""
                                placeholder=" " data-label="Zip Code">
                            <span class="text-danger"></span>

                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <div class="row">
                    <p> Location:(Complete Address)</p>
                    <div class="form-group" style="margin-bottom:15px;margin-top:15px;">

                        <input class="form-control" type="text" id="location_add1" name="location_add1" value=""
                            required="" placeholder=" " data-label="Location:(Complete Address)">
                        <span class="text-danger"></span>

                    </div>
                    <div class="form-group" style="margin-bottom:15px">

                        <input class="form-control" type="text" id="location_add2" name="location_add2" value=""
                            required="" placeholder=" " data-label="Location:(Complete Address)">
                        <span class="text-danger"></span>

                    </div>

                    <div class="form-group" style="margin-bottom:15px">

                        <input class="form-control" type="text" id="location_add3" name="location_add3" value=""
                            required="" placeholder=" "  data-label="Location:(Complete Address)">
                        <span class="text-danger"></span>

                    </div>
                    <div class="form-group" style="margin-bottom:15px">

                        <input class="form-control" type="text" id="location_add4" name="location_add4" value=""
                            required="" placeholder=" "  data-label="Location:(Complete Address)">
                        <span class="text-danger"></span>

                    </div>
                </div>
            </div> -->

        </div>


        <!--4 vgcvucvug -->
        <div class="row">
            <div class="row">
                <div class="col-sm-6" id="bdhsad" name=" hdnaksjdnk"   data-label=" TIme At Current Address">
                    <h3 style="font-size: 20px; 
    ">Time At Current Address</h3>
                </div>
                <div class="col-sm-6">
                    <!-- <h3 style="font-size: 20px; 
    ">coverage's Requested</h3 data-label=" overage's Requested">
                    <h3>     -->
                
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Years<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id=" year_1" name="year_1" value="" required=""
                                placeholder=" " data-label="Years">
                            <span class="text-danger"></span>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Months <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="months_1" name="months_1" value="" required=""
                                placeholder=" " data-label="Months">
                            <span class="text-danger"></span>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Email Address <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="email_add" name="email_add" value="" required=""
                        placeholder=" " data-label="Email Address">
                    <span class="text-danger"></span>

                </div>
            </div>
            <!-- <div class="col-sm-6" style="padding-top: 20px;">
                <div class="card-body">
                    <input class="form-group" id="checkbox_10" type="checkbox" name="marina_operator" value=" ">
                    <label for="checkbox_10">Marina Operator Liability
                    </label>

                    <input class="form-group" id="checkbox_11" type="checkbox" name="owned_water" value=" ">
                    <label for="checkbox_11">Owned WaterCraft
                    </label>

                </div>
            </div> -->
        </div>


        <!-- 5 hgveygdadta -->



        <!-- 6 fdyuadhdba -->

        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="first_name">Website <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="web_1" name="web_1" value="" required=""
                        placeholder=" " data-label="Website">
                    <span class="text-danger"></span>

                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="first_name">Phone Number-Home <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="phone_no" name="phone_no" value="" required=""
                        placeholder=" " data-label="Phone Number Home">
                    <span class="text-danger"></span>

                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="first_name">Phone Number-Office <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="phone_off" name="phone_off" value="" required=""
                        placeholder=" " data-label="Phone Number Office">
                    <span class="text-danger"></span>

                </div>
            </div>

            <!-- <div class="col-sm-6">
                <div class="card-body">
                    <input class="form-group" id="checkbox_10" type="checkbox" name="general_lia" value=" ">
                    <label for="checkbox_10">General Liability
                    </label>

                    <input class="form-group" id="checkbox_11" type="checkbox" name="property12" value=" ">
                    <label for="checkbox_11">Property
                    </label>
f
                </div>
            </div> -->


        </div>
        <!-- 7hjbvd -->

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Phone Number-Fax <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="phone_fax" name="phone_fax" value="" required=""
                        placeholder=" " data-label="Phone Number-Fax">
                    <span class="text-danger"></span>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Phone Number-Mobile <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="phone_mob" name="phone_mob" value="" required=""
                        placeholder=" " data-label="Phone Number-Mobile">
                    <span class="text-danger"></span>

                </div>
            </div>

            <!-- <div class="col-sm-6" style="padding-top: 20px;">
                <div class="card-body">
                    <input class="form-group" id="checkbox_10" type="checkbox" name="boats_deal" value=" ">
                    <label for="checkbox_10">Boat's Dealers
                    </label>

                    <input class="form-group" id="checkbox_11" type="checkbox" name="eqipment_tool" value=" ">
                    <label for="checkbox_11">Equipment /Tools
                    </label>

                </div>
            </div> -->



        </div>
        <!-- 8vhjjfd -->
        <div class="row">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="font-size: 20px; margin-top:15px
        ">Company</h3>
                </div>
                <!-- <div class="col-sm-6" style="padding-top: 20px;">
                    <div class="card-body">
                        <input class="form-group" id="checkbox_10" type="checkbox" name="protection_indem" value=" ">
                        <label for="checkbox_10">Protection & indemnity
                        </label>
                    </div>
                </div> -->

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div style="margin-top:-05px ;" class="row">
                        <div class="card-body">
                            <input class="form-group" id="checkbox_10" type="radio" name="individual_1" value="Individual " data-label="Company">
                            <label for="checkbox_10">Individual
                            </label>

                            <input class="form-group" id="checkbox_11" type="radio" name="individual_1" value="Partnership " data-label="Company">
                            <label for="checkbox_11"> Partnership
                            </label>
                            <input class="form-group" id="checkbox_11" type="radio" name="individual_1" value="Corporation " data-label="Company">
                            <label for="checkbox_11">Corporation
                            </label>
                            <input class="form-group" id="checkbox_11" type="radio" name="individual_1" value="Others " data-label="Company">
                            <label for="checkbox_11">Others
                            </label>

                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-6" style="padding-top: 20px;">
                    <div class="card-body">
                        <input class="form-group" id="checkbox_10" type="checkbox" name="piers_1" value=" ">
                        <label for="checkbox_10">Piers, Wharves & Ducks (complete supplemental app)
                        </label>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- 9fyuyf -->
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Producer's Name <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="producer_name1" name="producer_name1" value=""
                        required="" placeholder=" " data-label=" producer's Name">
                    <span class="text-danger"></span>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="first_name">Producer's Surname <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="producer_name2" name="producer_name2" value=""
                        required="" placeholder=" " data-label="Producer's Surname">
                    <span class="text-danger"></span>

                </div>
            </div>

        </div>
        <!-- 10 hbfjdf -->
        <!-- <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="first_name">Producer's Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="first_name" name="first_name" value="" required=""
                    placeholder=" ">
                <span class="text-danger"></span>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="first_name">Producer's Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="first_name" name="first_name" value="" required=""
                    placeholder=" ">
                <span class="text-danger"></span>

            </div>
        </div>

    </div> -->
        <!-- 11 YUFGYE -->

        <div class="container mt-5">
            <form>
                <div class="form-group form-section">
                    <label for="streetAddress">Street Address</label>
                    <input type="text" class="form-control" id="streetAddress" name="streetAddress" data-label="Street Address">
                </div>
                <div class="form-row form-section">
                    <div class="form-group col-md-6">
                        <label for="cityState">City/State</label>
                        <input type="text" class="form-control" id="cityState" name="cityState" data-label="City/State">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="zipCode">Zip code</label>
                        <input type="text" class="form-control" id="zipCode" name="zipCode" data-label="Zip Code">
                    </div>
                </div>
                <div class="form-group form-section">
                    <label for="businessDescription">List and describe any business owned, operated, or managed by the
                        insured, including any less or’s risk</label>
                    <textarea class="form-control" id="businessDescription" name="businessDescription" data-label=" List and describe any business owned, operated, or managed by the
                    insured, including any less or’s risk"
                        rows="3"></textarea>
                </div>
                <div class="form-row form-section">
                    <div class="form-group col-md-4">
                        <label for="yearsInBusiness">Number of years in business</label>
                        <input type="text" class="form-control" id="yearsInBusiness" name="yearsInBusiness" data-label="Number of Years In Business">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fullTimeEmployees">Number of full-time employees</label>
                        <input type="text" class="form-control" id="fullTimeEmployees" name="fullTimeEmployees" data-label="Number of Full-Time Employees">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="partTimeEmployees">Number of part-time employees</label>
                        <input type="text" class="form-control" id="partTimeEmployees" name="partTimeEmployees" data-label="Number of Part=Time Employees">
                    </div>
                </div>
                <div class="form-group form-section"> 
                    <label for="effectiveDate">Proposed effective date</label>
                    <input type="date" class="form-control" id="effectiveDate" name="effectiveDate" data-label=" Proposed Effective"> 
                </div>
                <h5>Please provide name of current carriers, expiring premiums and policy expiration dates.</h5>
                <div class="form-row form-section">
                    <div class="form-group col-md-4">
                        <label for="currentCarrierName">Current Carrier Name</label>
                        <input type="text" class="form-control" id="currentCarrierName" name="currentCarrierName" data-label="Currnet Carrier Name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="expiringPremiums">Expiring Premiums Policy</label>
                        <input type="text" class="form-control" id="expiringPremiums" name="expiringPremiums" data-label="Expiring Premiums policy">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="expirationDates">Expiration Dates</label>
                        <input type="date" class="form-control" id="expirationDates" name="expirationDates" data-label="Expiration Dates">
                    </div>
                </div>


                <div class="col-sm-6" style="/* padding-top: 20px; */">
                    <div style="font-size: 15px;">Is th Insured a subsidiary of any other entity or does the insured
                        have
                        any subsidiaries? </div>
                    <div class="row">
                        <div class="col-sm-3">

                            <div class="form-group">
                                <input class="form-group" id="checkbox_150" type="radio" name="insured_sub" value="Yes " data-label="Is th Insured a subsidiary of any other entity or does the insured
                                have
                                any subsidiaries? ">
                                <label for="radio_mk">yes
                                </label>

                                <input class="form-group" id="checkbox_115" type="radio" name="insured_sub"
                                    value="No" data-label="Is th Insured a subsidiary of any other entity or does the insured
                                    have
                                    any subsidiaries? ">
                                <label for="radio_hsjw">no
                                </label>

                            </div>
                        </div>
                        <div class="col-sm-3">If Yes Descripe
                        </div>
                        <div class="col-sm-4">

                            <div class="form-group">

                                <input class="form-control" type="text" id="ifyes_des" name="ifyes_des" value=""
                                    required="" placeholder="  " data-label="IF Yes Descripe">
                                <span class="text-danger"></span>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- <h5>Activity and Amount</h5>
                <div class="form-row form-section">
                    <div class="form-group col-md-6">
                        <label for="mooring">Mooring, Slip & Doc Rental $</label>
                        <input type="text" class="form-control amount-input" id="mooring" name="mooring" data-label="Mooring, Slip & Doc Rental $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="storage">Storage $</label>
                        <input type="text" class="form-control amount-input" id="storage" name="storage" data-label="Storage $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="repair">Repair $</label>
                        <input type="text" class="form-control amount-input" id="repair" name="repair" data-label=" Reparir $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fuelling">Fuelling $</label>
                        <input type="text" class="form-control amount-input" id="fuelling" name="fuelling" data-label="Fuelling $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hauling">Hauling/Launching $</label>
                        <input type="text" class="form-control amount-input" id="hauling" name="hauling" data-label=" Hauling/Launching">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rentalBoats">Rental Boats $</label>
                        <input type="text" class="form-control amount-input" id="rentalBoats" name="rentalBoats" data-label="Renatl Boats">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rentalProperty">Rental (Leased Property) $</label>
                        <input type="text" class="form-control amount-input" id="rentalProperty" name="rentalProperty" data-label="Renatl (Leased Property)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="brokerage">Boat brokerage/fees & commissions $</label>
                        <input type="text" class="form-control amount-input" id="brokerage" name="brokerage" data-label="Boat brokerage/fees & commissions $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otherReceipts">Other Receipts* $</label>
                        <input type="text" class="form-control amount-input" id="otherReceipts" name="otherReceipts" data-label="other Receipts$ ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="totalReceipts">Total Receipts $</label>
                        <input type="text" class="form-control amount-input" id="totalReceipts" name="totalReceipts" data-label="Total Receipts$">
                    </div>
                </div>
                <div class="form-group form-section">
                    <label for="otherReceiptsSource">*Please identify source of other receipts:</label>
                    <textarea class="form-control" id="otherReceiptsSource" name="otherReceiptsSource" data-label="*Please identify source of other receipts:"
                        rows="2"></textarea>
                </div> -->
                <!-- <div class="form-group form-section">
                <label>Is the insured a subsidiary of any other entity or does the insured have any
                    subsidiaries?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="subsidiary" id="subsidiaryYes" value=" ">
                    <label class="form-check-label" for="subsidiaryYes">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="subsidiary" id="subsidiaryNo" value=" ">
                    <label class="form-check-label" for="subsidiaryNo">No</label>
                </div>
                <div class="form-group mt-2">
                    <label for="subsidiaryDescription">If Yes Describe</label>
                    <textarea class="form-control" id="subsidiaryDescription" rows="2"></textarea>
                </div>
            </div> -->
        </div>
        <div class="col-sm-6">
            <div>Any policy or coverage declined, cancelled or non-renewed during the prior
                three years </div>
            <div class="row">
                <div class="col-sm-3">

                    <div class="form-group">
                    
                        <input class="form-group" id="policy_yes" type="radio" name="policy" value="YES " data-label="Any policy or coverage declined, cancelled or non-renewed during the prior
                        three years" >
                        <label for="checkbox_10">yes
                        </label>

                        <input class="form-group" id="checkbox_11" type="radio" name="policy" value=" no">
                        <label for="checkbox_11" data-label="Any policy or coverage declined, cancelled or non-renewed during the prior
                        three years" >no
                        </label>

                    </div>
                </div>
                 <div class="col-sm-6">

                    <div class="form-group">
                       <div> If Yes Explain </div>
                        
                        <input class="form-control" type="text" id="explain_yes" name="explain_yes" value=""
                            required="" placeholder="  " data-label="If Yes Explain">
                        <span class="text-danger"></span>
                        </div>

                    </div>
                </div>
            </div>
            
        
        <div class="col-sm-2" style="/* padding-top: 20px; */">
            <p> Is this Account new to the procedure</p>
            <div class="card-body" style=" margin-block-start: -37px;">
                <input class="form-group" id="checkbox_12" type="radio" name="permissions[]" value="Yes" data-label="Is this Account new to the procedure">
                <label for="checkbox_10" >yes
                </label>

                <input class="form-group" id="checkbox_16" type="radio" name="permissions[]" value="No" data-label="Is this Account new to the procedure">
                <label for="checkbox_11" >no
                </label>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">

                <label for="first_name">If No how many years has this account been handled <span
                        class="text-danger">*</span></label>
                <input class="form-control" type="text" id="accountbeen_handle" name="accountbeen_handle" value=""
                    required="" placeholder=" " data-label="If No how many years has this account been handled">
                <span class="text-danger"></span>

            </div>
        </div>
    </div>
    <div class="col-sm-2" >
        <p> Has the insured ever declared bankruptcy?</p>
        <div class="card-body">
            <input class="form-group" id="checkbox_13" type="radio" name="policy1" value="Yes" data-label="Has the insured ever declared bankruptcy?">
            <label for="checkbox_10" >yes
            </label>

            <input class="form-group" id="checkbox_14" type="radio" name="policy1" value="No" data-label="Has the insured ever declared bankruptcy?">
            <label for="checkbox_11" >no
            </label>

        </div>
    </div>



    <div class="col-sm-3">

        <div class="form-group">
            <label for="first_name">If yes give the details <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="get_detailyy" name="get_detailyy" value="" required=""
                placeholder=" " data-label="If yes give the details">
            <span class="text-danger"></span>

        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <div class="col-sm-6">
        <div class="row">
            <p> Location:(Complete Address)</p>
            <div class="form-group" style="margin-bottom:15px;margin-top:15px;">

                <input class="form-control" type="text" id="location_add1" name="location_add1" value=""
                    required="" placeholder=" " data-label="Location:(Complete Address)">
                <span class="text-danger"></span>

            </div>
            <div class="form-group" style="margin-bottom:15px">

                <input class="form-control" type="text" id="location_add2" name="location_add2" value=""
                    required="" placeholder=" " data-label="Location:(Complete Address)">
                <span class="text-danger"></span>

            </div>

            <div class="form-group" style="margin-bottom:15px">

                <input class="form-control" type="text" id="location_add3" name="location_add3" value=""
                    required="" placeholder=" "  data-label="Location:(Complete Address)">
                <span class="text-danger"></span>

            </div>
            <div class="form-group" style="margin-bottom:15px">

                <input class="form-control" type="text" id="location_add4" name="location_add4" value=""
                    required="" placeholder=" "  data-label="Location:(Complete Address)">
                <span class="text-danger"></span>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6" style="padding-top: 20px;">
          <h3 style="font-size: 20px;">Coverage's Requested</h3>
          <div class="card-body">
            <input class="form-group" id="checkbox_10" type="radio" name="coverage" value="Marina Operator Liability" data-label="Coverage's Requested">
            <label for="checkbox_10">Marina Operator Liability</label>
    
            <input class="form-group" id="checkbox_11" type="radio" name="coverage" value="Owned WaterCraft" data-label="Coverage's Requested">
            <label for="checkbox_11">Owned WaterCraft</label>
          </div>
          
          <div class="card-body">
            <input class="form-group" id="checkbox_12" type="radio" name="coverage" value="General Liability" data-label="Coverage's Requested">
            <label for="checkbox_12">General Liability</label>
    
            <input class="form-group" id="checkbox_13" type="radio" name="coverage" value="Property" data-label="Coverage's Requested">
            <label for="checkbox_13">Property</label>
          </div>
          
          <div class="card-body">
            <input class="form-group" id="checkbox_14" type="radio" name="coverage" value="Boat's Dealers" data-label="Coverage's Requested">
            <label for="checkbox_14">Boat's Dealers</label>
    
            <input class="form-group" id="checkbox_15" type="radio" name="coverage" value="Equipment /Tools" data-label="Coverage's Requested">
            <label for="checkbox_15">Equipment /Tools</label>
          </div>
          
          <div class="card-body">
            <input class="form-group" id="checkbox_16" type="radio" name="coverage" value="Protection & indemnity" data-label="Coverage's Requested">
            <label for="checkbox_16">Protection & indemnity</label>
          </div>
          
          <div class="card-body">
            <input class="form-group" id="checkbox_17" type="radio" name="coverage" value="Piers, Wharves & Ducks (complete supplemental app)" data-label="Coverage's Requested">
            <label for="checkbox_17">Piers, Wharves & Ducks (complete supplemental app)</label>
          </div>
        </div>
      </div>
      <div class="Titleheader" name="jnjdnk" id="hehjw" data-label="endkj">
        <h5> PLEASE COMPLETE APPLICATBLE SECTIONS ON THE FOLLOWING PAGES  </h5>
        </div>
    <h5>Activity and Amount</h5>
                <div class="form-row form-section">
                    <div class="form-group col-md-6">
                        <label for="mooring">Mooring, Slip & Doc Rental $</label>
                        <input type="text" class="form-control amount-input" id="mooring" name="mooring" data-label="Mooring, Slip & Doc Rental $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="storage">Storage $</label>
                        <input type="text" class="form-control amount-input" id="storage" name="storage" data-label="Storage $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="repair">Repair $</label>
                        <input type="text" class="form-control amount-input" id="repair" name="repair" data-label=" Reparir $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fuelling">Fuelling $</label>
                        <input type="text" class="form-control amount-input" id="fuelling" name="fuelling" data-label="Fuelling $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hauling">Hauling/Launching $</label>
                        <input type="text" class="form-control amount-input" id="hauling" name="hauling" data-label=" Hauling/Launching">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rentalBoats">Rental Boats $</label>
                        <input type="text" class="form-control amount-input" id="rentalBoats" name="rentalBoats" data-label="Renatl Boats">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rentalProperty">Rental (Leased Property) $</label>
                        <input type="text" class="form-control amount-input" id="rentalProperty" name="rentalProperty" data-label="Renatl (Leased Property)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="brokerage">Boat brokerage/fees & commissions $</label>
                        <input type="text" class="form-control amount-input" id="brokerage" name="brokerage" data-label="Boat brokerage/fees & commissions $">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otherReceipts">Other Receipts* $</label>
                        <input type="text" class="form-control amount-input" id="otherReceipts" name="otherReceipts" data-label="other Receipts$ ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="totalReceipts">Total Receipts $</label>
                        <input type="text" class="form-control amount-input" id="totalReceipts" name="totalReceipts" data-label="Total Receipts$">
                    </div>
                </div>
                <div class="form-group form-section">
                    <label for="otherReceiptsSource">*Please identify source of other receipts:</label>
                    <textarea class="form-control" id="otherReceiptsSource" name="otherReceiptsSource" data-label="*Please identify source of other receipts:"
                        rows="2"></textarea>
                </div>
            </div>
                </section>

        <!-- page 2 -->


<section>
    <div class="pageNo-2">
        <div> <h3 style="text-align: center;">PAGE 2</h3></div>
        <div class="container mt-5">
            <h5>Activity and Amount</h5>
            <div class="form-row form-section">
                <div class="form-group col-md-6">
                    <label for="boatsEngines">Boats & Engines $</label>
                    <input type="text" class="form-control amount-input" id="boatsEngines" name="boatsEngines" data-label="Boats & Engines">
                </div>
                <div class="form-group col-md-6">
                    <label for="shipsStore">Ships Store $</label>
                    <input type="text" class="form-control amount-input" id="shipsStore" name="shipsStore" data-label="Ships Store">
                </div>
                <div class="form-group col-md-6">
                    <label for="snackBar">Snack Bar/Restaurant $</label>
                    <input type="text" class="form-control amount-input" id="snackBar" name="snackBar" data-label="Snack Bar/Restaurant">
                </div>
                <div class="form-group col-md-6">
                    <label for="liquor">Liquor $</label>
                    <input type="text" class="form-control amount-input" id="liquor" name="liquor" data-label="Liquor $">
                </div>
                <div class="form-group col-md-6">
                    <label for="otherSales">Other Sales* $</label>
                    <input type="text" class="form-control amount-input" id="otherSales" name="otherSales" data-label="Other Sales* $">
                </div>
                <div class="form-group col-md-6">
                    <label for="totalSales">Total Sales $</label>
                    <input type="text" class="form-control amount-input" id="totalSales" name="totalSales" data-label=" Total Sales $">
                </div>
                <div class="form-group col-md-6">
                    <label for="totalAmount">Amount $</label>
                    <input type="text" class="form-control amount-input" id="totalAmount" name="totalAmount" data-label=" Amount $">
                </div>


                <div class="form-group form-section">
                    <label for="otherReceiptsSource">*Please identify source of other receipts:</label>
                    <textarea class="form-control" id="otherReceiptsSource" name="otherReceiptsSource" data-label="*Please identify source of other receipts:"
                        rows="2"></textarea>
                </div>


            </div>

            <h5>General Information</h5>
            <!-- 12 hjjew -->
            <div class="container mt-5">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Protection at locations</label>
                    <div class="col-sm-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="protectionYes" name="protection" data-label="Protection at locations"
                                value="Yes ">
                            <label class="form-check-label" for="protectionYes">YES</label>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="protectionNo" name="protection"
                                value=" no" data-label="Protection at locations">
                            <label class="form-check-label" for="protectionNo">NO</label>
                        </div>
                    </div>
                    <label class="col-sm-2 col-form-label">Any live aboard?</label>
                    <div class="col-sm-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="liveAboardYes" name="liveAboardYes"
                                value="yes" data-label="Any live aboard?">
                            <label class="form-check-label" for="liveAboardYes">YES</label>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="liveAboardNo" name="liveAboardYes"
                                value="no" data-label="Any live aboard?">
                            <label class="form-check-label" for="liveAboardNo">NO</label>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alarm with outside gong or siren</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alarm" placeholder="Location">
                    </div>
                </div> -->
            <div class=" ">
                <input style=" text-align: center;" class="form-control" type="text" id="alarm_gong_siren_1"
                    name="alarm_gong_siren_1" value="" required="" placeholder="Location " data-label="location" >
            </div>


            <div class="row">
                <div class="form-group">
                    <label for="first_name">Alarm with outside gong or siren<span
                            class="text-danger"></span></label><br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="gongor_siren1" name="gongor_siren1" value=""
                            required="" placeholder=" " data-label=" Alarm with outside gong or siren1">

                    </div>
                    <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="gongor_siren2" name="gongor_siren2" value=""
                            required="" placeholder=" " data-label=" Alarm with outside gong or siren1">
                    </div>
                    <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="gongor_siren3" name="gongor_siren3" value=""
                            required="" placeholder=" " data-label=" Alarm with outside gong or siren1">
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Completely fenced and floodlighted<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="Floodlight_1" name="Floodlight_1" value=""
                            required="" placeholder=" " data-label=" Completely fenced and floodlighted">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="Floodlight_2" name="Floodlight_2" value=""
                            required="" placeholder=" " data-label=" Completely fenced and floodlighted">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="Floodlight_3" name="Floodlight_3" value=""
                            required="" placeholder=" " data-label=" Completely fenced and floodlighted">
                    </div> <br>
                </div>
            </div>






            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Completely fenced and floodlighted</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fenced" placeholder="Location">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Automatic/emergency fuel shutoff valve<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="shoutoff_value1" name="shoutoff_value1" value=""
                            required="" placeholder=" " data-label="Automatic/emergency fuel shutoff valve ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="shoutoff_value12" name="shoutoff_value12" value=""
                            required="" placeholder=" " data-label="Automatic/emergency fuel shutoff valve ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="shoutoff_value13" name="shoutoff_value13" value=""
                            required="" placeholder=" " data-label="Automatic/emergency fuel shutoff valve ">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Automatic/emergency fuel shutoff valve</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="shutoffValve" placeholder="Location">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Watchman service after business hours<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="business_hours1" name="business_hours1" value=""
                            required="" placeholder=" " data-label="Watchman service after business hours ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="business_hours12" name="business_hours12" value=""
                            required="" placeholder=" " data-label="Watchman service after business hours ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="business_hours13" name="business_hours13" value=""
                            required="" placeholder=" " data-label="Watchman service after business hours ">
                    </div> <br>
                </div>
            </div>



            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Watchman service after business hours</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="watchmanService" placeholder="Location">
                </div>
            </div> -->
            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Describe nature & extent of watchman<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="extentof_watchman1" name="extentof_watchman1"
                            value="" required="" placeholder=" " data-label="Describe nature & extent of watchman ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="extentof_watchman12" name="extentof_watchman12"
                            value="" required="" placeholder=" " data-label="Describe nature & extent of watchman ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="extentof_watchman13" name="extentof_watchman13"
                            value="" required="" placeholder=" " data-label="Describe nature & extent of watchman ">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Describe nature & extent of watchman</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="watchmanExtent" placeholder="Description">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">How is boat dealer inventory protected<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="inventory_protected1" name="inventory_protected1"
                            value="" required="" placeholder=" " data-label=" How is boat dealer inventory protected" >
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="inventory_protected12" name="inventory_protected12"
                            value="" required="" placeholder=" "  data-label=" How is boat dealer inventory protected">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="inventory_protected13" name="inventory_protected13"
                            value="" required="" placeholder=" "  data-label=" How is boat dealer inventory protected">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">How is boat dealer inventory protected</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inventoryProtection" placeholder="Description">
                </div>
            </div> -->
            <hr>
            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">
                        <h5>Fire Protection</h5><span class="text-danger"></span>
                    </label>
                    <div class=" ">
                        <input style=" text-align: center;" class="form-control" type="text" id="fire_protectionm1"
                            name="fire_protectionm1" value="" required="" placeholder="Location "  data-label=" Fire Protection ">
                    </div>

                </div>
            </div>



            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">
                    <h5>Fire Protection</h5>
                </label>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Paid or Volunteer<span class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="paidor_volunteer1" name="paidor_volunteer1" value=""
                            required="" placeholder=" " data-label="Paid or Volunteer ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="paidor_volunteer12" name="paidor_volunteer12"
                            value="" required="" placeholder=" " data-label="Paid or Volunteer ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="paidor_volunteer13" name="paidor_volunteer13"
                            value="" required="" placeholder=" " data-label="Paid or Volunteer ">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Paid or Volunteer</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fireProtection" placeholder="Type">
                </div>
            </div>        -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Distance from location(s)<span class="text-danger"></span></label>
                    <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="distancefrom_location1"
                            name="distancefrom_location1" value="" required="" placeholder=" " data-label=" Distance From Location(s)">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="distancefrom_location12"
                            name="distancefrom_location12" value="" required="" placeholder=" " data-label=" Distance From Location(s)">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="distancefrom_location13"
                            name="distancefrom_location13" value="" required="" placeholder=" " data-label=" Distance From Location(s)">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Distance from location(s)</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fireDistance" placeholder="Distance">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Public fire hydrants - # & distance<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="firehydrsnts_1" name="firehydrsnts_1" value=""
                            required="" placeholder=" " data-label=" Public fire hydrants - # & distance">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="firehydrsnts_12" name="firehydrsnts_12" value=""
                            required="" placeholder=" " data-label=" Public fire hydrants - # & distance">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="firehydrsnts_13" name="firehydrsnts_13" value=""
                            required="" placeholder=" " data-label=" Public fire hydrants - # & distance">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Public fire hydrants - # & distance</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fireHydrants" placeholder="Details">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Public fire mains – size and pressure<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="size_pressure1" name="size_pressure1" value=""
                            required="" placeholder=" "data-label="Public fire mains – size and pressure " >
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="size_pressure12" name="size_pressure12" value=""
                            required="" placeholder=" " data-label="Public fire mains – size and pressure ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="size_pressure13" name="size_pressure13" value=""
                            required="" placeholder=" " data-label="Public fire mains – size and pressure "> 
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Public fire mains – size and pressure</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fireMains" placeholder="Details">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Local fireboat available<span class="text-danger"></span></label>
                    <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="fireboat_avai12" name="fireboat_avai12" value=""
                            required="" placeholder=" " data-label="Local fireboat available " >
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="fireboat_avai122" name="fireboat_avai122" value=""
                            required="" placeholder=" " data-label="Local fireboat available ">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="fireboat_avai123" name="fireboat_avai123" value=""
                            required="" placeholder=" " data-label="Local fireboat available ">
                    </div> <br>
                </div>
            </div>

            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Local fireboat available</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fireBoat" placeholder="Availability">
                </div>
            </div> -->

            <div class="row">
                <div class="form-group">
                    <label for="alarm_gong_siren">Describe any private fire protection<span
                            class="text-danger"></span></label> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="fire_private1" name="fire_private1"  value=""
                            required="" placeholder="" data-label=" Describe any private fire protection">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="fire_private12" name="fire_private12" value=""
                            required="" placeholder=" "data-label=" Describe any private fire protection">
                    </div> <br>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="fire_private13" name="fire_private13" value=""
                            required="" placeholder=" " data-label=" Describe any private fire protection">
                    </div> <br>
                </div>
            </div>


            <!-- <div class="form-group row">
                <label class="col-sm-3 col-form-label">Describe any private fire protection</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="privateFireProtection" placeholder="Description">
                </div>
            </div> -->
            <hr>




            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Marina Operators Liability Limits requested:</label>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Any one vessel $</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="oneVesselLimit" name="oneVesselLimit" placeholder="$" data-label=" Any One Vessel $" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Any one accident or occurrence $</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="oneAccidentLimit" name="oneAccidentLimit"
                        placeholder="$" data-label="Any one accident or occurrence $ ">
                </div>
            </div>

            <div class="form-group form-section">
                <label for="deductibleRequested">Deductible requested $</label>
                <input type="text" class="form-control amount-input" id="deductibleRequested"
                    name="deductibleRequested" data-label=" Deductible requested $">
                <small class="form-text text-muted">(Minimum $1,000)</small>
            </div>

            <div class="form-group form-section">
                <p>If you provide any storage, a copy of the storage agreement is required for coverage to apply.
                </p>
            </div>

            <div class="form-group form-section">
                <p>Are yachts stored afloat between 12/1 and 4/1?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yachtsAfloat" id="yachtsAfloatYes" value="Yes " data-label="Are yachts stored afloat between 12/1 and 4/1?">
                    <label class="form-check-label" for="yachtsAfloatYes">YES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yachtsAfloat" id="yachtsAfloatNo" value="no " data-label="Are yachts stored afloat between 12/1 and 4/1?">
                    <label class="form-check-label" for="yachtsAfloatNo">NO</label>
                </div>
            </div>

            <div class="form-group form-section">
                <p>Are Yachts stored inside a building?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yachtsInside" id="yachtsInsideYes" value="Yes" data-label="Are Yachts stored inside a building?">
                    <label class="form-check-label" for="yachtsInsideYes">YES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yachtsInside" id="yachtsInsideNo" value="No " data-label="Are Yachts stored inside a building?">
                    <label class="form-check-label" for="yachtsInsideNo">NO</label>
                </div>
                <div class="form-group mt-2">
                    <label for="yachtsInsideDescription">IF YES</label> 
                    <textarea class="form-control" id="yachtsInsideDescription" name="yachtsInsideDescription"  data-label=" IF YES"
                        rows="2"></textarea>
                </div>
            </div>

            <div class="form-group form-section">
                <p>Are they on racks?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="onRacks" id="onRacksYes" value="Yes" data-label="Are they on racks?">
                    <label class="form-check-label" for="onRacksYes">YES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="onRacks" id="onRacksNo" value="No" data-label="Are they on racks?">
                    <label class="form-check-label" for="onRacksNo">NO</label>
                </div>
            </div>

            <div class="form-group form-section">
                <p>Sprinkler system?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sprinklerSystem" id="sprinklerSystemYes"
                        value="Yes " data-label="Sprinkler system?"> 
                    <label class="form-check-label" for="sprinklerSystemYes">YES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sprinklerSystem" id="sprinklerSystemNo"
                        value="No " data-label="Sprinkler system?">
                    <label class="form-check-label" for="sprinklerSystemNo">NO</label>
                </div>
            </div>

            <div class="form-group form-section">
                <label for="buildingConstruction">Building construction</label>
                <textarea class="form-control" id="buildingConstruction" name="buildingConstruction" data-label="Building Construction "
                    rows="2"></textarea>
                    
            </div>

            <div class="form-group form-section">
                <p>Are yachts stored outside on racks?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="outsideRacks" id="outsideRacksYes" value="Yes" data-label="Are yachts stored outside on racks?">
                    <label class="form-check-label" for="outsideRacksYes">YES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="outsideRacks" id="outsideRacksNo" value="No" data-label="Are yachts stored outside on racks?">
                    <label class="form-check-label" for="outsideRacksNo">NO</label>
                </div>
                <div class="form-group mt-2">
                    <label for="outsideRacksDescription">If yes, how many yachts?</label>
                    <input type="text" class="form-control" id="outsideRacksDescription" name="outsideRacksDescription" data-label="IF Yes, How Many Yachts">
                </div>
                <br>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">How many boats?</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="numBoats" name="numBoats" placeholder="Number" data-label=" How Many Boats">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Are they required to carry full Hull/P&I
                        insurance?</label>
                    <div class="col-sm-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="insuranceYes" name="insuranceYes"
                                value="Yes" data-label="Are they required to carry full Hull/P&I
                                insurance?">
                            <label class="form-check-label" for="insuranceYes">YES</label>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="insuranceNo" name="insuranceYes"
                                value="No" data-label="Are they required to carry full Hull/P&I
                                insurance?">
                            <label class="form-check-label" for="insuranceNo">NO</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">What liability limits? $</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="liabilityLimits" name="liabilityLimits"
                            placeholder="$" data-label=" What liability limits? $ ">
                    </div>
                </div>
            </div>
</div>
</section>


            <!-- page 3 -->
             <section>
                <div class="pageNo-3">
                    <div> <h3 style="text-align: center;">PAGE 3</h3></div>

            <div class="container mt-5">
                <h2>Repair Operations</h2>

                <div class="form-group">
                    <label for="typeOfVessels">Type of vessels</label>
                    <input type="text" class="form-control" id="typeOfVessels" name="typeOfVessels" data-label="Type Of Vessel ">
                </div>
                <div class="form-group">
                    <label for="typeOfWork">Type of work</label>
                    <input type="text" class="form-control" id="typeOfWork" name="typeOfWork" data-label="Type Of Work ">
                </div>
                <div class="form-group">
                    <label for="highestValue">Highest value of any one yacht repaired last year $</label>
                    <input type="number" class="form-control" id="highestValue" name="highestValue " data-label="Highest value of any one yacht repaired last year $ ">
                </div>
                <div class="form-group">
                    <label for="commercialWork">Describe any commercial ship repair work you do and provide
                        receipts</label>
                    <textarea class="form-control" id="commercialWork" name="commercialWork" data-label="Describe any commercial ship repair work you do and provide
                    receipts " ></textarea>
                </div>
                <div class="form-group">
                    <label>Are vessel owners allowed to work on their own vessels?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ownersAllowed" id="ownersAllowedYes"
                            value="Yes" data-label="Are vessel owners allowed to work on their own vessels?">
                        <label class="form-check-label" for="ownersAllowedYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ownersAllowed" id="ownersAllowedNo"
                            value="No" data-label="Are vessel owners allowed to work on their own vessels?">
                        <label class="form-check-label" for="ownersAllowedNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Any sub-contractors used?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="subContractorsUsed" id="subContractorsYes"
                            value="Yes" data-label="Any sub-contractors used?">
                        <label class="form-check-label" for="subContractorsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="subContractorsUsed" id="subContractorsNo"
                            value="No" data-label="Any sub-contractors used?">
                        <label class="form-check-label" for="subContractorsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Do you obtain Certificate of Insurance from sub-contractor?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="insuranceCertificate"
                            id="insuranceCertificateYes" value="Yes" data-label="Do you obtain Certificate of Insurance from sub-contractor?">
                        <label class="form-check-label" for="insuranceCertificateYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="insuranceCertificate"
                            id="insuranceCertificateNo" value="No" data-label="Do you obtain Certificate of Insurance from sub-contractor?"> 
                        <label class="form-check-label" for="insuranceCertificateNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Is it equivalent to our MOLL limit?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mollLimit" id="mollLimitYes" value="Yes" data-label="Is it equivalent to our MOLL limit?">
                        <label class="form-check-label" for="mollLimitYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mollLimit" id="mollLimitNo" value="No" data-label="Is it equivalent to our MOLL limit?">
                        <label class="form-check-label" for="mollLimitNo">No</label>
                    </div>
                </div>
                <h4>Fueling</h4>
                <div class="form-group">
                    <label>Any fueling for other than boats?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="fuelingOther" id="fuelingOtherYes"
                            value="Yes" data-label="Any fueling for other than boats?">
                        <label class="form-check-label" for="fuelingOtherYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="fuelingOther" id="fuelingOtherNo" value=" No" data-label="Any fueling for other than boats?">
                        <label class="form-check-label" for="fuelingOtherNo">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="fuelingOther" id="fuelingOtherBoth"
                            value=" " data-label="Both">
                        <label class="form-check-label" for="fuelingOtherBoth">Both</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Who performs fueling of boats?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="fuelingPerformedBy"
                            id="fuelingPerformedByEmployee" value=" ">
                        <label class="form-check-label" for="fuelingPerformedByEmployee">Employee</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="fuelingPerformedBy"
                            id="fuelingPerformedByOwner" value=" ">
                        <label class="form-check-label" for="fuelingPerformedByOwner">Boat Owner</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Smoking signs posted and enforced?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="smokingSigns" id="smokingSignsYes"
                            value="Yes" data-label="Smoking signs posted and enforced?">
                        <label class="form-check-label" for="smokingSignsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="smokingSigns" id="smokingSignsNo" value="No" data-label="Smoking signs posted and enforced?">
                        <label class="form-check-label" for="smokingSignsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Automatic or shut-off switch?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shutOffSwitch" id="shutOffSwitchYes"
                            value="Yes" data-label="Automatic or shut-off switch?">
                        <label class="form-check-label" for="shutOffSwitchYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shutOffSwitch" id="shutOffSwitchNo"
                            value="No" data-label="Automatic or shut-off switch?">
                        <label class="form-check-label" for="shutOffSwitchNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <h6>Additional interests/certificate recipients?
                    </label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests"
                            id="additionalInterestsYes" value="Yes" data-label="Additional interests/certificate recipients?">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests"
                            id="additionalInterestsNo" value="No" data-label="Additional interests/certificate recipients?">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                    </h6>
                </div>
                <!-- 14 dvygad -->

                <div class="form-group">
                    <label>Name and Address 1</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests1"
                            id="additionalInterestsYes1" value="yes" data-label="Name and Address 1">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests1"
                            id="additionalInterestsNo1" value="No" data-label="Name and Address 1">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Interest 1</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests12"
                            id="additionalInterestsYes11" value="yes" data-label="Interest 1">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests12"
                            id="additionalInterestsNo11" value="No" data-label="Interest 1">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>certificate 1</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests13"
                            id="additionalInterestsYes111" value="yes" data-label="certificate 1">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests13"
                            id="additionalInterestsNo111" value="No" data-label="certificate 1">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Name and Address 2</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests21"
                            id="additionalInterestsYes21" value="Yes" data-label="Name and Address 2">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests21"
                            id="additionalInterestsNo21" value="No" data-label="Name and Address 2">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Interest 2</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests22"
                            id="additionalInterestsYes22" value="Yes" data-label="Interest 2">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests22"
                            id="additionalInterestsNo22" value="No" data-label="Interest 2">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>certificate 2</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests23"
                            id="additionalInterestsYes23" value="Yes" data-label="certificate 2">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests23"
                            id="additionalInterestsNo23" value="No" data-label="certificate 2">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Name and Address 3</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests31"
                            id="additionalInterestsYes31" value="yes" data-label="Name and Address 3">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests31"
                            id="additionalInterestsNo31" value="No" data-label="Name and Address 3">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Interest 3</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests32"
                            id="additionalInterestsYes32" value="Yes" data-label="Interest3">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests32"
                            id="additionalInterestsNo32" value="No" data-label="Interest3">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>certificate 3</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests33"
                            id="additionalInterestsYes34" value="Yes" data-label="certificate3">
                        <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="additionalInterests33"
                            id="additionalInterestsNo34" value="No" data-label="certificate3">
                        <label class="form-check-label" for="additionalInterestsNo">No</label>
                    </div>
                </div>




                <!-- edeqdd -->

                <div class="container mt-5">
                    <!-- Inventory Table for LOC2 -->
                    <div class="mb-4">
                        <h6>Inventory: inclue all boats,marine engine, boat trailers & Marine Supplies,
                            accessories and
                            parts held for sale.</h6>
                        <table class="table table-bordered">
                            <h5>LOC1</h5>
                            <thead>
                                <tr>
                                    <th scope="col">LOC1</th>
                                    <th scope="col">Last Inventory Date</th>
                                    <th scope="col">Prior Inventory Date</th>
                                    <th scope="col">Average Monthly Inventory</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Building</td>
                                    <td><input type="date" class="form-control" name="building_last_inventory_date" data-label="Loc 1 Building Last Inventory Date"></td>
                                    <td><input type="date" class="form-control" name="building_last_inventory_date"  data-label="Loc 1 Building Prior Inventory Date"></td>
                                    <td><input type="text" class="form-control" name="building_last_inventory_date"  data-label="Loc 1 Building Average Monthly Date"></td>
                                </tr>
                                <tr>
                                    <td>Open Area</td>
                                    <td><input type="date" class="form-control" name="Open_area" data-label="Loc 1 Open Area Last Inventory Date "></td>
                                    <td><input type="date" class="form-control" name="Open_area" data-label="Loc 1 Open Area Prior Inventory Date "></td>
                                    <td><input type="text" class="form-control" name="Open_area" data-label="Loc 1 Open Area Average Inventory Date "></td>
                                </tr>
                                <tr>
                                    <td>In Water</td>
                                    <td><input type="date" class="form-control" name="In_water" data-label="Loc 1 In Water Last inventory Date"></td>
                                    <td><input type="date" class="form-control" name="In_water" data-label="Loc 1 In Water Prior inventory Date"></td>
                                    <td><input type="text" class="form-control" name="In_water" data-label="Loc 1 In Water Average inventory Date"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5>LOC2</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">LOC2</th>
                                <th scope="col">Last Inventory Date</th>
                                <th scope="col">Prior Inventory Date</th>
                                <th scope="col">Average Monthly Inventory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Building</td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date1" data-label="Loc 2 Building Last Inventory Date"></td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date2"  data-label="Loc 2 Building Prior Inventory Date"></td>
                                <td><input type="text" class="form-control" name="building_last_inventory_date3"  data-label="Loc 2 Building Average Monthly Date"></td>
                            </tr>
                            <tr>
                                <td>Open Area</td>
                                <td><input type="date" class="form-control" name="Open_area1" data-label="Loc 2 Open Area Last Inventory Date "></td>
                                <td><input type="date" class="form-control" name="Open_area2" data-label="Loc 2 Open Area Prior Inventory Date "></td>
                                <td><input type="text" class="form-control" name="Open_area3" data-label="Loc 2 Open Area Average Inventory Date "></td>
                            </tr>
                            <tr>
                                <td>In Water</td>
                                <td><input type="date" class="form-control" name="In_water1" data-label="Loc 2 In Water Last inventory Date"></td>
                                <td><input type="date" class="form-control" name="In_water2" data-label="Loc 2 In Water Prior inventory Date"></td>
                                <td><input type="text" class="form-control" name="In_water3" data-label="Loc 2 In Water Average inventory Date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Inventory Table for LOC3 -->
                <div class="mb-4">
                    <h5>LOC3<h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">LOC3</th>
                                <th scope="col">Last Inventory Date</th>
                                <th scope="col">Prior Inventory Date</th>
                                <th scope="col">Average Monthly Inventory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Building</td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date11" data-label="Loc 3 Building Last Inventory Date"></td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date22"  data-label="Loc 3 Building Prior Inventory Date"></td>
                                <td><input type="text" class="form-control" name="building_last_inventory_date33"  data-label="Loc 3 Building Average Monthly Date"></td>
                            </tr>
                            <tr>
                                <td>Open Area</td>
                                <td><input type="date" class="form-control" name="Open_area11" data-label="Loc 3 Open Area Last Inventory Date "></td>
                                <td><input type="date" class="form-control" name="Open_area22" data-label="Loc 3 Open Area Prior Inventory Date "></td>
                                <td><input type="text" class="form-control" name="Open_area33" data-label="Loc 3 Open Area Average Inventory Date "></td>
                            </tr>
                            <tr>
                                <td>In Water</td>
                                <td><input type="date" class="form-control" name="In_water11" data-label="Loc 3 In Water Last inventory Date"></td>
                                <td><input type="date" class="form-control" name="In_water22" data-label="Loc 3 In Water Prior inventory Date"></td>
                                <td><input type="text" class="form-control" name="In_water33" data-label="Loc 3 In Water Average inventory Date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Inventory Table for LOC4 -->
                <div class="mb-4">
                    <h5>LOC4</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">LOC4</th>
                                <th scope="col">Last Inventory Date</th>
                                <th scope="col">Prior Inventory Date</th>
                                <th scope="col">Average Monthly Inventory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Building</td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date111" data-label="Loc 4 Building Last Inventory Date"></td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date222"  data-label="Loc 4 Building Prior Inventory Date"></td>
                                <td><input type="text" class="form-control" name="building_last_inventory_date333"  data-label="Loc 4 Building Average Monthly Date"></td>
                            </tr>
                            <tr>
                                <td>Open Area</td>
                                <td><input type="date" class="form-control" name="Open_area111" data-label="Loc 4 Open Area Last Inventory Date "></td>
                                <td><input type="date" class="form-control" name="Open_area222" data-label="Loc 4 Open Area Prior Inventory Date "></td>
                                <td><input type="text" class="form-control" name="Open_area333" data-label="Loc 4 Open Area Average Inventory Date "></td>
                            </tr>
                            <tr>
                                <td>In Water</td>
                                <td><input type="date" class="form-control" name="In_water111" data-label="Loc 4 In Water Last inventory Date"></td>
                                <td><input type="date" class="form-control" name="In_water222" data-label="Loc 4 In Water Prior inventory Date"></td>
                                <td><input type="text" class="form-control" name="In_water333" data-label="Loc 4 In Water Average inventory Date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Inventory Table for LOC5 -->
                <div class="mb-4">
                    <h5>LOC5</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Building</td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date16" data-label="Loc 5 Building Last Inventory Date"></td>
                                <td><input type="date" class="form-control" name="building_last_inventory_date26"  data-label="Loc 5 Building Prior Inventory Date"></td>
                                <td><input type="text" class="form-control" name="building_last_inventory_date36"  data-label="Loc 5 Building Average Monthly Date"></td>
                            </tr>
                            <tr>
                                <td>Open Area</td>
                                <td><input type="date" class="form-control" name="Open_area16" data-label="Loc 5 Open Area Last Inventory Date "></td>
                                <td><input type="date" class="form-control" name="Open_area26" data-label="Loc 5 Open Area Prior Inventory Date "></td>
                                <td><input type="text" class="form-control" name="Open_area36" data-label="Loc 5 Open Area Average Inventory Date "></td>
                            </tr>
                            <tr>
                                <td>In Water</td>
                                <td><input type="date" class="form-control" name="In_water16" data-label="Loc 5 In Water Last inventory Date"></td>
                                <td><input type="date" class="form-control" name="In_water26" data-label="Loc 5 In Water Prior inventory Date"></td>
                                <td><input type="text" class="form-control" name="In_water36" data-label="Loc 5 In Water Average inventory Date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- 15 husdf -->
            <div class="container mt-5">
            </div>

            <!-- Additional interests/certificate recipients Section -->
            <!-- <div class="form-group">
                <label>Additional interests/certificate recipients?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="additionalInterests" id="additionalInterestsYes"
                        value=" ">
                    <label class="form-check-label" for="additionalInterestsYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="additionalInterests" id="additionalInterestsNo"
                        value=" ">
                    <label class="form-check-label" for="additionalInterestsNo">No</label>
                </div>
            </div>
        
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Name and Address 1">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="interest1">
                    <label class="form-check-label" for="interest1">Interest 1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="certificate1">
                    <label class="form-check-label" for="certificate1">Certificate 1</label>
                </div>
            </div>
        
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Name and Address 2">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="interest2">
                    <label class="form-check-label" for="interest2">Interest 2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="certificate2">
                    <label class="form-check-label" for="certificate2">Certificate 2</label>
                </div>
            </div>
        
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Name and Address 3">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="interest3">
                    <label class="form-check-label" for="interest3">Interest 3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="certificate3">
                    <label class="form-check-label" for="certificate3">Certificate 3</label>
                </div>
            </div> -->

            <!-- Transit Exposures Section -->
            <h5>Transit Exposures</h5>
            <div class="form-group">
                <label>Are any boats delivered from mfr. at insured’s risk?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="boatsDelivered" id="boatsDeliveredYes"
                        value="Yes " data-label="Are any boats delivered from mfr. at insured’s risk?">
                    <label class="form-check-label" for="boatsDeliveredYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="boatsDelivered" id="boatsDeliveredNo" value="No" data-label="Are any boats delivered from mfr. at insured’s risk?">
                    <label class="form-check-label" for="boatsDeliveredNo">No</label>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label>(A)</label>
                </div>

                <label>If yes, how are they delivered?</label>
                <input type="text" class="form-control mb-2" placeholder=" "  data-label=" If yes, How are they delivered">
                <label>Maximum value any one boat $</label>
                <input type="text" class="form-control mb-2" placeholder=" "data-label=" Maximum value any one boat $">
                <label>Maximum value any one delivery $</label>
                <input type="text" class="form-control" placeholder=" " data-label="Maximum value any one delivery $ ">
            </div>

            <div class="form-group">
                <div>
                    <label>(B)</label>
                </div>

                <label>Are any boats delivered by water to the insured?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="boatsByWater" id="boatsByWaterYes" value="Yes" data-label="Are any boats delivered by water to the insured?">
                    <label class="form-check-label" for="boatsByWaterYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="boatsByWater" id="boatsByWaterNo" value="No" data-label="Are any boats delivered by water to the insured?">
                    <label class="form-check-label" for="boatsByWaterNo">No</label>
                </div>
                <!-- <label>If yes, from where?</label>
            <input type="text" class="form-control mb-2" placeholder=""> -->
                <!-- <input type="text" class="form-control mt-2" placeholder="If yes, from where?">
                <input type="text" class="form-control mt-2"
                    placeholder="Total values of boats delivered by insured during the past year $">
                <input type="text" class="form-control mt-2" placeholder="By public carrier $"> -->
            </div>
            <div>
                <div class="form-group">
                    <div>
                        <label>If yes, from where?</label>
                    </div>
                    <input type="text" class="form-control mb-2" placeholder=" " />
                </div>
                <label>Total values of boats delivered by insured during the past year $</label>
                <input type="text" class="form-control mb-2" placeholder="" data-label="Total values of boats delivered by insured during the past year $ ">
                <label>By public carrier $</label>
                <input type="text" class="form-control mb-2" placeholder="" data-label="By public carrier $ " >
                <label>Average distance the boats are transported</label>
                <input type="text" class="form-control" placeholder="" data-label="Average distance the boats are transported ">
                <label>If yes, how are they delivered?</label>
                <input type="text" class="form-control mb-2" placeholder="" data-label="If yes, how are they delivered? " >
                <label>Maximum</label>
                <input type="text" class="form-control mb-2" placeholder="" data-label=" Maximum">
                <label>Number of boats delivered to purchaser by water</label>
                <input type="text" class="form-control" placeholder="" data-label="Number of boats delivered to purchaser by water ">
                <label>Average distance</label>
                <input type="text" class="form-control mb-2" placeholder="" data-label="Average distance ">
                <label> Average value $</label>
                <input type="text" class="form-control mb-2" placeholder="" data-label="Average value $ " >
            </div>

</div>
</section>

            <!-- page 4 -->
             <section>
                <div class="pageNo-4">
                    <div> <h3 style="text-align: center;">PAGE 4</h3></div>

            <div class="container mt-5">

                <!-- Previous sections -->
                <!-- ... existing form fields ... -->

                <h4>Boat Shows</h4>
                <div class="form-group">
                    <label for="numBoatShows">Number of boat shows annually</label>
                    <input type="number" class="form-control" id="numBoatShows" name="numBoatShows" data-label="Number of boat shows annually ">
                </div>
                <div class="form-group">
                    <label for="numBoatsEachShow">Number of boats each show in water or on land</label>
                    <input type="number" class="form-control" id="numBoatsEachShow" name="numBoatsEachShow" data-label=" Number of boats each show in water or on land">
                </div>
                <div class="form-group">
                    <label for="maxDollarLimitShow">Maximum dollar limit any one show $</label>
                    <input type="number" class="form-control" id="maxDollarLimitShow" name="maxDollarLimitShow" data-label="Maximum dollar limit any one show $ ">
                </div>
                <div class="form-group">
                    <label for="avgDistanceShow">Average distance to show</label>
                    <input type="text" class="form-control" id="avgDistanceShow" name="avgDistanceShow" data-label=" Average distance to show">
                </div>
                <div class="form-group">
                    <label for="maxDistanceShow">Maximum distance to show transported by common carrier or
                        own
                        vehicles?</label>
                    <input type="text" class="form-control" id="maxDistanceShow" name="maxDistanceShow" data-label=" Maximum distance to show transported by common carrier or
                    own
                    vehicles?">
                </div>

                <h4>Demonstrations:</h4>
                <div class="form-group">
                    <label for="numDemonstrations">Number per month</label>
                    <input type="number" class="form-control" id="numDemonstrations" name="numDemonstrations" data-label="Number per month ">
                </div>
                <div class="form-group">
                    <label for="maxValueBoat">Maximum value any one boat $</label>
                    <input type="number" class="form-control" id="maxValueBoat" name="maxValueBoat" data-label="Maximum value any one boat $ ">
                </div>
                <div class="form-group">
                    <label for="maxMphBoat">Maximum mph any one boat</label>
                    <input type="number" class="form-control" id="maxMphBoat" name="maxMphBoat" data-label="Maximum mph any one boat ">
                </div>
                <div class="form-group">
                    <label>Is boat under command of competent employee?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="boatCommand" id="boatCommandYes" value="Yes" data-label="Is boat under command of competent employee?" >
                        <label class="form-check-label" for="boatCommandYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="boatCommand" id="boatCommandNo" value="No" data-label="Is boat under command of competent employee?">
                        <label class="form-check-label" for="boatCommandNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Are demonstrators equipped with full complement of U.S. Coast Guard required
                        safety
                        equipment?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="safetyEquipment" id="safetyEquipmentYes"
                            value=" Yes" data-label="Are demonstrators equipped with full complement of U.S. Coast Guard required
                            safety
                            equipment?">
                        <label class="form-check-label" for="safetyEquipmentYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="safetyEquipment" id="safetyEquipmentNo"
                            value="No" data-label="Are demonstrators equipped with full complement of U.S. Coast Guard required
                            safety
                            equipment?">
                        <label class="form-check-label" for="safetyEquipmentNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="demoPerformedWhere">Where are demonstrations performed?</label>
                    <input type="text" class="form-control" id="demoPerformedWhere" name="demoPerformedWhere" data-label="Where are demonstrations performed? " >
                </div>
                <div class="form-group">
                    <label for="milesFromShore">Miles from shore</label>
                    <input type="number" class="form-control" id="milesFromShore" name="milesFromShore" data-label="Miles from shore ">
                </div>
                <div class="form-group">
                    <label for="distanceFromDealership">Distance from dealership</label>
                    <input type="number" class="form-control" id="distanceFromDealership" name="distanceFromDealership " data-label="Distance from dealership ">
                </div>
            </div>
            <!-- 17 uedu -->
            <div class="container mt-5">
                <h2>Protection and Indemnity</h2>

                <div class="form-group">
                    <label>Sections Applicable:</label>

                    <div class="form-group">
                        <label>Marina opeartors</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marina_operatoryes"
                                id="marina_operatoryes1" value="Yes" data-label="Marina opeartors">
                            <label class="form-check-label" for="boatCommandYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marina_operatoryes" id="marina_operatorNo1"
                                value="No" data-label="Marina opeartors">
                            <label class="form-check-label" for="boatCommandNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Boat Dealers</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="boat_dealers" id="boat_dealersYes"
                                value="Yes" data-label="Boat Dealers">
                            <label class="form-check-label" for="boatCommandYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="boat_dealers" id="boat_dealersNo"
                                value="No" data-label="Boat Dealers">
                            <label class="form-check-label" for="boatCommandNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Work Boats</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="work_boats" id="work_boatsYes"
                                value="Yes" data-label="Work Boats">
                            <label class="form-check-label" for="boatCommandYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="work_boats" id="work_boatsNo" value="No" data-label="Work Boats">
                            <label class="form-check-label" for="boatCommandNo">No</label>
                        </div>
                        <div class="form-group">
                            <label for="rentalBoatsCount">How many?</label>
                            <input type="number" class="form-control" id="work_boats1" name="work_boats1" data-label="How many? " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Rental Boats</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental_boats" id="rental_boatsYes"
                                value="Yes" data-label="Rental Boats">
                            <label class="form-check-label" for="boatCommandYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rental_boats" id="rental_boatsNo"
                                value="No" data-label="Rental Boats">
                            <label class="form-check-label" for="boatCommandNo">No</label>
                        </div>
                        <div class="form-group">
                            <label for="rentalBoatsCount">How many?</label>
                            <input type="number" class="form-control" id="rental_boats1" name="rental_boats1" data-label="How many? "  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Other Owned boats (excl boats for sale)</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="excl_boats" id="excl_boatsYes"
                                value="Yes" data-label="Other Owned boats (excl boats for sale)">
                            <label class="form-check-label" for="boatCommandYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="excl_boats" id="excl_boatsNo" value="No" data-label="Other Owned boats (excl boats for sale)">
                            <label class="form-check-label" for="boatCommandNo">No</label>
                        </div>
                        <div class="form-group">
                            <label for="rentalBoatsCount">How many?</label>
                            <input type="number" class="form-control" id="excl_boats1" name="excl_boats1" data-label="How many? " >
                        </div>
                    </div>
                    <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="marinaOperatorsYes">
                    <label class="form-check-label" for="marinaOperatorsYes">Marina Operators Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="marinaOperatorsNo">
                    <label class="form-check-label" for="marinaOperatorsNo">Marina Operators No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="boatDealersYes">
                    <label class="form-check-label" for="boatDealersYes">Boat Dealers Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="boatDealersNo">
                    <label class="form-check-label" for="boatDealersNo">Boat Dealers No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="workBoatsYes">
                    <label class="form-check-label" for="workBoatsYes">Work Boats Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="workBoatsNo">
                    <label class="form-check-label" for="workBoatsNo">Work Boats No</label>
                </div>
                <div class="form-group">
                    <label for="workBoatsCount">How many?</label>
                    <input type="number" class="form-control" id="workBoatsCount">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rentalBoatsYes">
                    <label class="form-check-label" for="rentalBoatsYes">Rental Boats Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rentalBoatsNo">
                    <label class="form-check-label" for="rentalBoatsNo">Rental Boats No</label>
                </div>
                <div class="form-group">
                    <label for="rentalBoatsCount">How many?</label>
                    <input type="number" class="form-control" id="rentalBoatsCount">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="otherOwnedBoatsYes">
                    <label class="form-check-label" for="otherOwnedBoatsYes">Other owned boats (excl boats for
                        sale) Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="otherOwnedBoatsNo">
                    <label class="form-check-label" for="otherOwnedBoatsNo">Other owned boats (excl boats for
                        sale) No</label>
                </div>
                <div class="form-group">
                    <label for="otherOwnedBoatsCount">How many?</label>
                    <input type="number" class="form-control" id="otherOwnedBoatsCount">
                </div> -->
                </div>
                <div class="form-group">
                    <label>
                        <h6>Coverage only applies to those vessels listed under Owned Watercraft coverage.
                            Please
                            schedule in the next section of the application.<h6>
                    </label>
                </div>
                <div class="form-group">
                    <label for="limitRequested">Limit requested $</label>
                    <input type="number" class="form-control" id="limitRequested" name="limitRequested" data-label=" Limit requested $">
                </div>
                <div class="form-group">
                    <label for="deductibleRequested">Deductible Requested $</label>
                    <input type="number" class="form-control" id="deductibleRequested" name="deductibleRequested" data-label="Deductible Requested $ ">
                </div>
                <div class="form-group">
                    <label>For owned watercraft, are crew covered?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="crewCoveredYes" name="crewCoveredYes" value="Yes" data-label="For owned watercraft, are crew covered?">
                        <label class="form-check-label" for="crewCoveredYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="crewCoveredNo" name="crewCoveredYes" value="No" data-label="For owned watercraft, are crew covered?">
                        <label class="form-check-label" for="crewCoveredNo">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="numberOfCrew">If yes, number of crew</label>
                    <input type="number" class="form-control" id="numberOfCrew" name="numberOfCrew" data-label="If yes, number of crew " >
                </div>
                <div class="form-group">
                    <label for="employeeExperience">
                        <h6>Experience of employees</h6>
                    </label>
                    <textarea class="form-control" id="employeeExperience" name="employeeExperience"   data-label=" Experience of employees "
                        rows="3"></textarea>
                </div>

            </div>
            <!--  18 guygd -->

            <div class="form-group">
                <label for="numberOfCrew">Please fully describe work boat/rental boat/other owned boat
                    operation if
                    you are requesting P&I coverage for these vessels.</label>
                <textarea class="form-control" id="boat_rentalboat" name="boat_rentalboat" data-label="Please fully describe work boat/rental boat/other owned boat
                operation if
                you are requesting P&I coverage for these vessels. " rows="3"></textarea>

            </div>
            <div class="form-group">
                <h6>Owned Watercraft</h6>
                <label for="numberOfCrew"> Full describe any operation for which your are requesting
                    coverage for
                    owned watercraft:</label>
                <textarea class="form-control" id="coverage_watercraft" name="coverage_watercraft" data-label="Full describe any operation for which your are requesting
                coverage for
                owned watercraft " rows="3"></textarea>

            </div>
            <div class="form-group">
                <label for="numberOfCrew"> Please complete the following or submit a detail schedule</label>
                <textarea class="form-control" id="detail_schedule" name="detail_schedule" data-label="Please complete the following or submit a detail schedule " rows="3"></textarea>
            </div>
            <!-- 19 uuddhu -->
            <div class="container mt-5">
                <h3>Please complete the following or submit a detailed schedule.</h3>

                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number1" id="serial_number1" data-label="Description/Serial Number* " required>
                    <label>Value</label>
                    <input type="text" class="form-control" name="value1" id="value1" data-label=" Value">
                    <label>D/A</label>
                    <input type="text" class="form-control" name="da1" id="da1" data-label=" D/A">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number2" id="serial_number2" data-label="Description/Serial Number* " required>
                    <label>Value</label>
                    <input type="text" class="form-control" name="value2" id="value2" data-label="Value">
                    <label>D/A</label>
                    <input type="text" class="form-control" name="da2" id="da2" data-label="D/A ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number3" id="serial_number3" data-label=" Description/Serial Number*" required>
                    <label>Value</label>
                    <input type="text" class="form-control" name="value3" id="value3" data-label=" Value">
                    <label>D/A</label>
                    <input type=" text" class="form-control" name="da3" id="da3" data-label="D/A ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number4" id="serial_number4" data-label="Description/Serial Number* " required>
                    <label>Value</label>
                    <input type="text" class="form-control" name="value4" id="value4" data-label=" Value">
                    <label>D/A</label>
                    <input type="text" class="form-control" name="da4" id="da4" data-label="D/A ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number5" id="serial_number5" data-label="Description/Serial Number* " required>
                    <label>Value</label>
                    <input type="text" class="form-control" name="value5" id="value5" data-label="Value ">
                    <label>D/A</label>
                    <input type="text" class="form-control" name="da5" id="da5" data-label=" D/A">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number6" id="serial_number6" data-label="Description/Serial Number* " required>
                    <label>Year Built</label>
                    <input type="text" class="form-control" name="year_built1" id="year_built1" data-label=" Year Built ">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location1" id="location1" data-label="Location ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number7" id="serial_number7" data-label=" Description/Serial Number*" required>
                    <label>Year Built</label>
                    <input type="text" class="form-control" name="year_built2" id="year_built2" data-label="year Built ">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location2" id="location2" data-label=" Location ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number8" id="serial_number8" data-label="Description/Serial Number* " required>
                    <label>Year Built</label>
                    <input type="text" class="form-control" name="year_built3" id="year_built3" data-label="year Built ">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location3" id="location3 " data-label=" Location ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number9" id="serial_number9" data-label=" Description/Serial Number*" required>
                    <label>Year Built</label>
                    <input type="text" class="form-control" name="year_built4" id="year_built4" data-label=" Year Built ">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location4" data-label="Location ">
                </div>
                <div class="form-group">
                    <label>Description/Serial Number*</label>
                    <input type="text" class="form-control" name="serial_number10" id="serial_number10" data-label="Description/Serial Number* " required>
                    <label>Year Built</label>
                    <input type="text" class="form-control" name="year_built5" id="year_built5" data-label=" Year Built ">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location5" id="location5" data-label="Location ">
                </div>
                <div class="form-group">
                    <label>Navigation area of above vessel(s)</label>
                    <input type="text" class="form-control" name="navigation_area" id="navigation_area" data-label="Navigation area of above vessel(s) ">
                </div>
                <h4>Property Insurance</h4>
                <div class="form-group">
                    <label>Location #</label>
                    <input type="text" class="form-control" name="location_number" id="location_number" data-label="Location # ">
                    <label>Building #</label>
                    <input type="text" class="form-control" name="building_number" id="building_number" data-label=" Building # ">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="acv_80" id="acv_80" data-label="ACV 80 % or " >
                    <label class="form-check-label">ACV 80 % or</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="replacement_cost_90" id="replacement_cost_90" data-label="Replacement Cost 90%">
                    <label class="form-check-label">Replacement Cost 90%</label>
                </div>
            </div>
</div>
</section>


            <!-- page 5 -->
             <section>
                <div class="pageNo-5">
                    <div> <h3 style="text-align: center;">PAGE 5</h3></div>

            <div class="form-container" id="buildung1" name="buildung1">
                
                    <div class="col-md-4">
                        <label>
                            <h6>Subject of Insurance</h6>
                        </label>
                    </div>
                    <div class="form-group" id="building2" name="building2">
                        <label for="buildingDescription">Building</label>
                        <input type="text" class="form-control" id="buildingDescription" name="buildingDescription" data-label=" Building Description"
                            placeholder="Description">
                        <input type="text" class="form-control" id="buildingLimit" name="buildinglimit"
                            placeholder="Limit" data-label=" Building limit">
                    </div>
                    <div class="form-group">
                        <label for="contentsDescription">Contents</label>
                        <input type="text" class="form-control" id="contentsDescription" name="contentsDescription" data-label="Contents Description"
                            placeholder="Description">
                        <input type="text" class="form-control" id="contentsLimit" name="contentsLimit"
                            placeholder="Limit" data-label="Contents Limits">
                    </div>
                    <div class="form-group">
                        <label for="otherDescription">Other</label>
                        <input type="text" class="form-control" id="otherDescription" name="otherDescription" data-label=" Others Description"
                            placeholder="Description">
                        <input type="text" class="form-control" id="otherLimit" name="otherLimit" placeholder="Limit" data-label=" Others Description">
                    </div>
                    <div class="form-group">
                        <label for="deductible">Deductible $</label>
                        <input type="text" class="form-control" id="deductible" name="deductible" data-label="Deductible "
                            placeholder="Minimum $1,000">
                    </div>
                
            </div>


            <div class="container mt-5">
            </div>

            <!-- <div class="form-row">
                <div class="col-md-4">
                    <label>Subject of Insurance</label>
                </div>
                <div class="col-md-4">
                    <label>Description</label>
                </div>
                <div class="col-md-4">
                    <label>Limit</label>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <label>Building</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="building_description">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="building_limit">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <label>Contents</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="contents_description">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="contents_limit">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <label>Other</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="other_description">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="other_limit">
                </div>
            </div>
            <div class="form-group">
                <label>Deductible $<input type="text" class="form-control d-inline w-auto" name="deductible1"></label>
                <small class="form-text text-muted">(minimum $1,000)</small>
            </div> -->
            <div class="form-group">
                <label>How is this building used by the insured?</label>
                <input type="text" class="form-control" id="building_usage" name="building_usage" data-label="How is this building used by the insured? " >
            </div>
            <div class="form-group">
                <label>Construction type</label>
                <input type="text" class="form-control" id="construction_type" name="construction_type" data-label="Construction type ">
            </div>
            <div class="form-group">
                <label>Protection Class</label>
                <input type="text" class="form-control" id="protection_class" name="protection_class " data-label="Protection Class ">
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <label>Year Built</label>
                    <input type="text" class="form-control" id="year_built" name="year_built" data-label="Year Built ">
                </div>
                <div class="col-md-4">
                    <label>Total Area</label>
                    <input type="text" class="form-control" id="total_area" name="total_area" data-label="Total Area ">
                </div>
                <div class="col-md-4">
                    <label>Number of Stories</label>
                    <input type="text" class="form-control" id="number_of_stories" name="number_of_stories" data-label="Number of Stories ">
                </div>
            </div>
            <div class="form-group">
                <label>Other occupancies</label>
                <input type="text" class="form-control" id="other_occupancies" name="other_occupancies" data-label="Other occupancies ">
            </div>
            <div class="form-group">
                <label>Building Improvements</label>
                <input type="text" class="form-control" id="building_improvements" name="building_improvements" data-label="Building Improvements ">
            </div>
            <div class="form-group">
                <label>Deductible $<input type="text" class="form-control d-inline w-auto" id="deductible1" data-label="Deductible $ "
                        name="deductible2"></label>
                <small class="form-text text-muted">(minimum $1,000)</small>
            </div>
            <div class="container mt-5">

                <div class="form-group">
                    <label>How is this building used by the insured?</label>
                    <input type="text" class="form-control" id="building_usage" name="building_usage" data-label="How is this building used by the insured? ">
                </div>
                <div class="form-group">
                    <label>Construction type</label>
                    <input type="text" class="form-control" id="construction_type" name="construction_type" data-label="Construction type ">
                </div>
                <div class="form-group">
                    <label>Protection Class</label>
                    <input type="text" class="form-control" id="protection_class" name="protection_class" data-label="Protection Class ">
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label>Year Built</label>
                        <input type="text" class="form-control" id="yearbuilte" name="yearbuilte" data-label="Year Built ">
                    </div>
                    <div class="col-md-4">
                        <label>Total Area</label>
                        <input type="text" class="form-control" id="total_area" name="total_area" data-label="Total Area ">
                    </div>
                    <div class="col-md-4">
                        <label>Number of Stories</label>
                        <input type="text" class="form-control" id="number_of_stories" name="number_of_stories" data-label="Number of Stories ">
                    </div>
                </div>
                <div class="form-group">
                    <label>Other occupancies</label>
                    <input type="text" class="form-control" id="other_occupancies" name="other_occupancies" data-label="Other occupancies ">
                </div>
                <div class="form-group">
                    <label>Building Improvements</label>
                    <input type="text" class="form-control" id="building_improvements" name="building_improvements" data-label="Building Improvements ">
                </div>
                <div class="form-group">
                    <label>Burglar alarm:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="burglar_alarm" id="burglar_yes" value="Yes " data-label="Burglar alarm:">
                        <label class="form-check-label" for="burglar_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="burglar_alarm" id="burglar_no" value="No" data-label="Burglar alarm:">
                        <label class="form-check-label" for="burglar_no">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sprinkler alarm:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sprinkler_alarm" id="sprinkler_yes"
                            value="Yes" data-label="Sprinkler alarm:">
                        <label class="form-check-label" for="sprinkler_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sprinkler_alarm" id="sprinkler_no"
                            value="No" data-label="Sprinkler alarm:">
                        <label class="form-check-label" for="sprinkler_no">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Basement:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="basement1" id="basement_yes" value="yes" data-label="Basement:">
                        <label class="form-check-label" for="basement_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="basement1" id="basement_no" value="No" data-label="Basement:">
                        <label class="form-check-label" for="basement_no">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Requested Limit $<input type="text" class="form-control d-inline w-auto"
                            name="requested_limit" data-label="Requested Limit $ "></label>
                    <small class="form-text text-muted">Coinsurance 80% <br></small>
                </div>

            </div>
            <!-- 21 gdyvu -->
            <section>
                <div>
                    <h3>Assets</h3>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Mortage Amount $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="Mortage_amount" id="Mortage_amount" data-label="Mortage Amount $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Amount In bank $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="amount_bank" id="amount_bank" placeholder="Type" data-label=" Amount In bank $">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Amount any other loan $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="amount_otherbank" id="amount_otherbank"
                            placeholder="Type" data-label="  Amount any other loan $ ">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Amount in other account total $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="amountaccount_total" id="amountaccount_total"
                            placeholder="Type" data-label=" Amount in other account total $">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">insurance</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="insurance_details" id="insurance_details"
                            placeholder="Type" data-label=" insurance">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Shares/bonds </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="shares_bonds" id="shares_bonds"
                            placeholder="Type" data-label="Shares/bonds ">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Net assets $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="net_assests" id="net_assests" placeholder="Type" data-label="Net assets $ ">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Total assets</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="total_assests" id=" total_assests" data-label="Total assets "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Details of treatment</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="detail_treatment" id="detail_treatment" data-label="Details of treatment "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Income(average monthly)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="income_average" id="income_average" data-label="Income(average monthly) "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">types of diseases 9</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="type_diseases" id="type_diseases" data-label="types of diseases 9 "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Base salary gross(p.a) Net (p.m) vp $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="basesalry_gross" id="basesalry_gross" data-label="Base salary gross(p.a) Net (p.m) vp $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Income patient 3$ $ Treatment value $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="income_patienttreatment" data-label="Income patient 3$ $ Treatment value $ "
                            id="income_patienttreatment" placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> income Guardian $$ Amount of
                        treatment/opeartion
                        $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="incomeguardian_operation" data-label="income Guardian $$ Amount of
                        treatment/opeartion
                        $ "
                            id="incomeguardian_operation" placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Other income total value $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="otherincome_totalvalue" data-label="Other income total value $ "
                            id="otherincome_totalvalue" placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Regular income $ Treatment payment $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="regular_tresatment" id="regular_tresatment" data-label="Regular income $ Treatment payment $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">goverment Benifit/pension $
                        insurance,maintenance,tax,&mis $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="goverment_benifit" id="goverment_benifit" data-label="goverment Benifit/pension $
                        insurance,maintenance,tax,&mis $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Part time/casual employment $ Income
                        $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="parttime_casual" id="parttime_casual" data-label="Part time/casual employment $ Income
                        $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Dividends/Interest $ Life/income replacement
                        insurance $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="dividends_interest" id="dividends_interest" data-label="Dividends/Interest $ Life/income replacement
                        insurance $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Commision $ child maintenance $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="commision_child" id="commision_child" data-label="Commision $ child maintenance $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Gross (p.a) X75% Net Other-please specify
                        $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="gross_specify" id="gross_specify" data-label="Gross (p.a) X75% Net Other-please specify
                        $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Rent received(p.a)$</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="rent_received" id="rent_received" data-label="Rent received(p.a)$ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">$ total net monthly expenditure $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="total_expenditure" id="total_expenditure" data-label="$ total net monthly expenditure $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Other $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="others_are2" id="others_are2" placeholder="Type" data-label="Other $ ">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Treatment & operation $ Total net monthly
                        income
                        $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="treatment_operationtotal1" data-label="Treatment & operation $ Total net monthly
                        income
                        $ "
                            id="treatment_operationtotal1" placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Home owner value $ less total monthly
                        expenditure
                        $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="homeowner_monthly" id="homeowner_monthly" data-label="Home owner value $ less total monthly
                        expenditure
                        $ "
                            placeholder="Type">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Total net monthly income $ Uncommitted
                        monthly income
                        $</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="uncommitted_monthlyincome" data-label="Total net monthly income $ Uncommitted
                        monthly income
                        $ "
                            id="uncommitted_monthlyincome" placeholder="Type">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Date of Application <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="date_ofapplication" name="date_ofapplication"
                                value="" required="" placeholder="" data-label="Date of Application  ">
                            <span class="text-danger"></span>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">from Date <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="from_dates5" name="from_dates5" value=""
                                required="" placeholder="" data-label="from Date ">
                            <span class="text-danger"></span>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="first_name">Agreement Number<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="agreement_number7" name="agreement_number7"
                                value="" required="" placeholder=" " data-label="Agreement Number ">
                            <span class="text-danger"></span>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="first_name">Application Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="application_number8" name="application_number8"
                                value="" required="" placeholder=" " data-label=" Application Number">
                            <span class="text-danger"></span>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="first_name">Agency Case Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="agency_case_number" name="agency_case_number"
                                value="" required="" placeholder=" " data-label="Agency Case Number ">
                            <span class="text-danger"></span>
                            <br>

                        </div>
                    </div>
                </div>

            </section>
            </div>

            </section>

            <!-- <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br> -->

        <div id="additionalFields"></div>
      

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script> 
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>



            <button type="button" id="download-pdf" class="btn btn-primary"> DOWNLOAD PDF</button>
            <!-- <button id="download_Btns">
                Download Table Data
            </button> -->
            <!-- <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="first_name">Enter Your Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="agreement_nodf" name="agreement_notyhfty" value="" required="" placeholder=" " data-label="Enter Your Name ">
                        <span class="text-danger"></span>
    
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="first_name">Enter Your Phone  Number  <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="first_namekj" name="first_nametytry" value="" required="" placeholder=" " data-label="Enter Your Phone Number">
                        <span class="text-danger"></span>
    
                    </div>
                </div>
    
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="first_name"> Enter Your Mail Id<span class="text-danger">8</span></label>
                        <input class="form-control" type="text" id="first_nameer" name="first_nametry" value="" required="" placeholder=" " data-label="Enter Your Mail Id">
                        <span class="text-danger"></span>
    
                    </div>
    
                </div>
                </div>
            -->
            <input type="hidden" value="" class="timer" data-label="Total Time Taken"> 
    </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('input');
           

            inputs.forEach(input => {
                input.addEventListener('copy', (e) => {
                    e.preventDefault();
                    //  alert('Copying is not allowed');
                });

                input.addEventListener('cut', (e) => {
                    e.preventDefault();
                    //  alert('Cutting is not allowed');
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    //  alert('Pasting is not allowed');
                });

            })

            // document.addEventListener('DOMContentLoaded', (event) => {
            // Restrict copy, cut, and paste in the textarea
            const textarea = document.querySelectorAll('textarea');
            textarea.forEach(textarea => {
                textarea.addEventListener('copy', (e) => {
                    e.preventDefault();
                    // alert('Copying is not allowed');
                });

                textarea.addEventListener('cut', (e) => {
                    e.preventDefault();
                    // alert('Cutting is not allowed');
                });

                textarea.addEventListener('paste', (e) => {
                    e.preventDefault();
                    // alert('Pasting is not allowed');
                });
            })


            inputs.forEach(input => {
                input.addEventListener('blur', function () {
                    if (input.value.trim() !== "") {
                        input.readOnly = true;
                    }
                });
            });
            textarea.forEach(textarea => {
                textarea.addEventListener('blur', function () {
                    if (textarea.value.trim() !== "") {
                        textarea.readOnly = true;

                    }
                });
            });
        });



    </script>

    <script>
        let pausedTime = 0;
        let startTime;
        let endTime;
        let timerInterval;
        let timerStarted = false;
        $("#download-pdf").click(function(){
            const currentTime = new Date();
        // console.log(currentTime);
        // console.log("startTimeeeeeeeeeeeeeeeee");
        // console.log(startTime); 
        const elapsedTime = Math.floor((pausedTime + (currentTime - startTime)) / 1000);
        const minutes = Math.floor(elapsedTime / 60).toString().padStart(2, '0');
        const seconds = (elapsedTime % 60).toString().padStart(2, '0');
            $(".timer").val(`${minutes} Minutes ${seconds} Second`);
            const { jsPDF } = window.jspdf;
            // const doc = new jsPDF();
            const tableData = [ 
  ];
  
  const formData1 = new FormData($("#page_no1-5")[0]);
     // Iterate through each form element
     $("#page_no1-5").find('input, select, textarea').each(function() { 
        const element = $(this);
        const name = element.attr('name');
        const type = element.attr('type');
        const title = element.attr('data-heading');
        const value = element.val();
        const label = element.data('label');
        console.log(type);

        if(title != "" && title !== undefined && title !== null)
        {
            tableData.push({
                name: title,
                heading:true,
                value: '',
            });
        }
        else{
            if (type === 'radio') {
        // Only collect the checked radio button value
        if (element.is(':checked')) {
            // alert(label);
            tableData.push({
                name: label,
                value: value,
            });
        }
    } 
    else if (type === 'checkbox') {
        // Only collect the checked radio button value
        console.log("elementdsacdsadsadsadsadadaghggcagcvhvcgacvavhadksadhjvhgdhvdhjvdjvadhjvsadh");
        console.log(element);
        if (element.is(':checked')) {
            // alert(label);
            tableData.push({
                name: label,
                value: "Yes",
            });
        }
        else{
            // alert(label);
            tableData.push({
                name: label,
                value: "No",
            });
        }
    } 
    else {
        tableData.push({
            name: label,
            value: value,
        });
    }
        }
     
        // tableData.push({
        //     name: label,
        //     value: value, 
        // });
    }); 
            console.log(tableData);
  const tableContainer = document.getElementById('table-container');

  // Create table element
  const table = document.createElement('table');
  table.classList.add('custom-table');

  // Create table header
  const thead = document.createElement('thead');
  const headerRow = document.createElement('tr');
  var title =  ['Title', 'Value'];
 title.forEach(function(headerText) {
    const th = document.createElement('th');
    th.textContent = headerText;
    headerRow.appendChild(th);
  });
  thead.appendChild(headerRow);
  table.appendChild(thead);

  // Create table body
  const tbody = document.createElement('tbody');
    tableData.forEach(function(rowData) {
        const row = document.createElement('tr');
        Object.values(rowData).forEach(function(cellData) {
            const td = document.createElement('td');
            td.textContent = cellData;
            row.appendChild(td);
    });
    tbody.appendChild(row);
    });
    table.appendChild(tbody);

  

    // Append table to container
    tableContainer.appendChild(table);
    const doc = new jsPDF();

    // Convert table to PDF using jsPDF-AutoTable
    doc.autoTable({ html: '.custom-table' }); 
            
    doc.save('dynamic_table.pdf');
    alert("Form Submitted Successfully");
    window.location.reload();

  // Add event listener to download PDF button
//   document.getElementById('download-pdf').addEventListener('click', function() {
    console.log("dsfsfsdfsf");
    // Generate PDF
    // generatePDF();
//   });

  // Function to generate PDF using jsPDF
  function generatePDF() {
    const doc = new jsPDF();

    // Convert table to PDF using jsPDF-AutoTable
    doc.autoTable({ html: '.custom-table' });
     

    // Save PDF
    doc.save('dynamic_table.pdf');
  }
          
           
        });

    // var element = "input";
    // if(inputs type is "radion")
    // {
    //     var name = doc.getname("name"); 
    // }
        // const form = document.getElementById('download-pdf1');
        // // const form = document.getElementById('page_no1-5');

        // form.addEventListener('submit', function (e) {
        //     e.preventDefault();
        //     console.log('Form submitted');

        //     const formData = new FormData(form);
           
    
           
        //     const { jsPDF } = window.jspdf;
        //     const doc = new jsPDF();
        //       // Add content to PDF
        //      doc.text('Hello world!', 10, 10);

        //     // Save PDF
        //     doc.save('example.pdf');
        //     // let y=10;
        //     // formData.forEach((value, key) => {
        //     //     console.log(value)
        //     //     doc.text(`${key}: ${value}`, 10, y);
        //     //     y += 10; 
        //     // });

            
        //     // doc.save('form-data.pdf');
        // });
    </script>

<script> 
    // var myVar;
    // var timer = document.getElementById("page_no1-5");
    
    // var countDownSeconds;
    // function startTime(){ 
    //   myVar = setInterval(start, 1000);
    //   document.getElementById("timerr").innerHTML = timer.value;
    //   countDownSeconds = timer.value;
    // } 

    // function start(){
    //   countDownSeconds--;
    //   document.getElementById("timer1").innerHTML = countDownSeconds;
    //   if (countDownSeconds == -1){
    //     stop();
    //     document.getElementById("timer1").innerHTML = "0";  
    //   }
    // }

    // function stop(){
    //   clearInterval(myVar);
    // }


    
    document.addEventListener('DOMContentLoaded', (event) => {
        

    

    const form = document.getElementById('page_no1-5');
    const timerDisplay = document.getElementById('formtiming1');
    const startButton = document.getElementById('start1');
    const pauseButton = document.getElementById('pause1');
    
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            if (!timerStarted) {
                startTimer();
                $("#start1").attr("disabled",true);
        $("#pause1").attr("disabled",false);
        $(this).addClass("disable");
            }
        });
    });

    form.addEventListener('button', (event) => {
        console.log(button)
        event.preventDefault();
        endTimer();

        const formData1 = new FormData1(form);
        console.log(formData1)
        const formEntries = Object.fromEntries(formData1.entries());

        const timeTaken = (endTime - startTime) / 1000; // time in seconds

        generatePDF(formEntries, timeTaken);
    });

    function startTimer() {
        startTime = new Date();
        timerStarted = true;
        timerInterval = setInterval(updateTimerDisplay, 1000);
        
    } 
    function pause1() {
        clearInterval(timerInterval);

        endTime = new Date();
    }
    // const form = document.getElementsByName('page_no1-5');
    //         inputs.forEach(input => {
    //             input.addEventListener('pause1', (e) => {
    //                 e.preventDefault();
    //                 disabled=ture
    //             });
    //         });
    //             const form = document.getElementsByName('page_no1-5');
    //         inputs.forEach(input => {
    //             input.addEventListener('pause1', (e) => {
    //                 e.preventDefault();
    //                 disabled=false
    //             });
    //         });
   


    function updateTimerDisplay() {
    //    console.log("testtttttttttttttttttt");
        const currentTime = new Date();
        // console.log(currentTime);
        // console.log("startTimeeeeeeeeeeeeeeeee");
        // console.log(startTime); 
        const elapsedTime = Math.floor((pausedTime + (currentTime - startTime)) / 1000);
        const minutes = Math.floor(elapsedTime / 60).toString().padStart(2, '0');
        const seconds = (elapsedTime % 60).toString().padStart(2, '0');
        timerDisplay.textContent = `${minutes}:${seconds}`; 
        
    }

    $("#start1").click(function(){
        startTimer();
        $(this).attr("disabled",true);
        $("#pause1").attr("disabled",false);
        $(this).addClass("disable");
    })
    $("#pause1").click(function(){
        endTime = new Date();
        var resume = $(this).html();
        console.log(resume);
        if(resume == "Resume")
        { 
            startTime = new Date();
            timerStarted = true; 
            timerInterval = setInterval(updateTimerDisplay, 1000);
            
            $(this).html("Pause");
            document.getElementsByClassName("overlay")[0].style.display = "none";
           
        }
        else
        {
            clearInterval(timerInterval);
            pausedTime += new Date() - startTime;
            timerStarted = false; 
            $(this).html("Resume");
            document.getElementsByClassName("overlay")[0].style.display = "block";
  }

        })
        
          
    

   

    function generatePDF(formEntries, timeTaken) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        let yOffset = 10;
        for (const [key, value] of Object.entries(formEntries)) {
            doc.text(`${key}: ${value}`, 10, yOffset);
            yOffset += 10;
           
        }

        
      
        doc.text(`Time Taken: ${timeTaken} seconds`, 10, yOffset);

        
    }
   
});

</script>
<script>
    const form = document.getElementsByName('page_no1-5')[0];
    const inputs = Array.from(form.elements);
    let status = ''; 
  
    inputs.forEach(input => {
      input.addEventListener('click', (e) => {
        e.preventDefault();
        if (status === 'pause1') {
          input.disabled = true;
        } else if (status === 'start1') {
          input.disabled = false;
        }
      });
    });
  
   
    document.getElementById('pause1').addEventListener('click', () => {
      status = 'pause1';
    });
  
    document.getElementById('start1').addEventListener('click', () => {
      status = 'start1';
    });
  </script>
  

 


   


</body>


</html>