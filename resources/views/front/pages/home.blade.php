<!DOCTYPE html>
<html lang="en" class="light">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Property Management System</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/panel/assets/img/favicon.ico') }}"/>
    <style>
        .Welcome-section {
            background-image: url(public/panel/assets/img/ppbackgound.png);
        }
    </style>
</head>

<body>
<div class="loader"></div>
<div id="app">
 {{--   <div class="container">
        <div class="row">

            <div class="col-md-5 offset-sm-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-section">
                        <a href="#" class="logo-ppms"><img src="{{ asset('public/panel/assets/img/logoppms.png') }}" alt=""/></a>
                        <h3>Sign In</h3>
                        <form>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" tabindex="1" required
                                       autofocus required placeholder="Email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                       required placeholder="Password">
                                <!--  -->
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox" style="font-weight: 400;
              font-size: 31.6239px;color: #272727;">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                           id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-lg btn-block">
                                    Log In
                                </button>
                            </div>
                            <div style="text-align: center;font-weight: 400;
            font-size: 27.62px;">
                                <a href="auth-forgot-password.html" style="color: #000000;">
                                    Forgot Password?
                                </a>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="Welcome-section">
                    <h3>Manage your properties with<br> One Solution</h3>
                    <h2>Welcome Back</h2>
                </div>

            </div>
        </div>
    </div>










--}}
    <div class="container-custom">
        <div class="row">
            <div class="col-md-5 offset-sm-1">
                <div class="login-section">
                    <a href="#" class="logo-ppms"><img src="{{ asset('public/panel/assets/img/logoppms.png') }}"alt="" /></a>
                    <h3>Sign In</h3>
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" @error('email') is-invalid @enderror tabindex="1" required autofocus required placeholder="Email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required placeholder="Password">
                            <!--  -->
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox" style="font-weight: 400;
              font-size: 14px;color: #272727;    display: inline-block;">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me" >Remember Me</label>
                            </div>
                            <div class="pull-right" style="display: inline-block;;font-weight: 400;
              font-size: 14px;">
                                <a href="{{ route('password.request') }}" style="color: #000000;">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-lg btn-block" >
                                Log In
                            </button>
                        </div>
                        <!-- <div style="text-align: center;font-weight: 400;
                        font-size: 27.62px;">
                          <a href="auth-forgot-password.html" style="color: #000000;">
                            Forgot Password?
                          </a>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="col-md-6 Welcome-section">
                <h3>Manage your properties with<br> One Solution</h3>
                <h2>Welcome Back</h2>
            </div>
        </div>
    </div>
    <!-- END: Register Form -->
</div>

<!-- General JS Scripts -->
<script src="{{ asset('public/panel/assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="{{ asset('public/panel/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('public/panel/assets/js/custom.js') }}"></script>
</body>
</html>


{{--
@extends('front.layouts.app')
<!-- section('body.content') -->
@section('body.content')
    <!-- Real Estate Agents -->
    @include('front.partials.slider')
    <div class="container-fluid">
        <div class="row pedding section-padding">
            <div class="col-md-12 text-center">
                <div class="widget__header ">
                    <h2 class="fusion widget__title text-center text-color section-padding">Real estates</h2>
                    <h5 class="widget__text text-justify pb-5">is a comprehensive and modern housing society management software for Pakistan's real estate and residential complex sectors. It has been designed with People as well as Business as focal points. It is developed to assist your office staff with day to day society operations management and to give unique living experience to residents. It assists you with end-to-end management of processes such as plots sales & purchase, biometric registration, payment installments management, utility bills management, town charges, and much more.</h5>
                </div>
                <h2 class="widget__title1 text-center section-padding text-color section-padding ">
                    Features of Our Property Management System
                </h2>
            </div>
            <div class="col-md-2">
                <div>
                    <img src="http://www.uliving.co/wp-content/uploads/2017/03/uliving-homePage-2_55-2.png" class="feature">
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <img src="http://www.uliving.co/wp-content/uploads/2017/03/uliving-homePage-2_58-1.png" class="feature">
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <img src="http://www.uliving.co/wp-content/uploads/2017/03/uliving-homePage-2_60-2.png" class="feature">
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <img src="http://www.uliving.co/wp-content/uploads/2017/07/uliving-homePage-2_15.png" class="feature">
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <img src="http://www.uliving.co/wp-content/uploads/2017/03/uliving-homePage-2_87-1.png" class="feature">
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <img src="http://www.uliving.co/wp-content/uploads/2017/03/uliving-homePage-2_92-2.png" class="feature">
                </div>
            </div>
        </div>
--}}
{{--End Section WHAT IS PSS--}}{{--


        --}}
{{--Section Trust by many --}}{{--

        --}}
{{--Reason: Dection Not needed for time being. Will required this functionality in future requirement--}}{{--

        --}}
{{--<div class="row section-padding ">--}}{{--

            --}}
{{--<div class="col-md-12 text-center ">--}}{{--

                --}}
{{--<h2 class="widget__title mb-6 mt-6 text-color"> Trusted By Many </h2>--}}{{--

                --}}
{{--<h5 class="widget__text text-center text-justify"> <p>Earned through experience and years of hard work, our clients have firm reliance and complete confidence in our housing society management system solution as well as on the integrity of our housing society management services. We endeavor to maintain the same level of quality service as we work to retain current clientele, and add more names in our clients’ list.</p></h5>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="col-md-3  pt-5 pb-5">--}}{{--

                --}}
{{--<div class="card">--}}{{--

                    --}}
{{--<img class="img-fluid" src="{{url('front/img/wapda.png')}}" alt="Lights" style="width:100%; min-height:30px">--}}{{--

                    --}}
{{--<div class="card-body ">--}}{{--

                        --}}
{{--<span class="properties__ribon">URGENT SALE</span>--}}{{--

                        --}}
{{--<h4 class=" text_heading widget__text text-center"><b>Wapda Town Sargodha</b></h4>--}}{{--

                        --}}
{{--<h4 class="widget__text text-center"> Sarghoda,Punjab--}}{{--

                        --}}
{{--</h4>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="col-md-3  pt-5 pb-5">--}}{{--

                --}}
{{--<div class="card">--}}{{--

                    --}}
{{--<img class="img-fluid" src="{{url('front/img/lahore_garden.png')}}" alt="Lights" style="width:100%; min-height:30px">--}}{{--

                    --}}
{{--<div class="card-body ">--}}{{--

                        --}}
{{--<span class="properties__ribon">URGENT SALE</span>--}}{{--

                        --}}
{{--<h4 class=" text_heading widget__text text-center"><b>Lahore Housing Society</b></h4>--}}{{--

                        --}}
{{--<h4 class="widget__text text-center">Lahore, Punjab</h4>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="col-md-3  pt-5 pb-5">--}}{{--

                --}}
{{--<div class="card">--}}{{--

                    --}}
{{--<img class="img-fluid" src="{{url('front/img/izmar_garden.png')}}" alt="Lights" style="width:100%; min-height:30px">--}}{{--

                    --}}
{{--<div class="card-body ">--}}{{--

                        --}}
{{--<span class="properties__ribon">URGENT SALE</span>--}}{{--

                        --}}
{{--<h4 class=" text_heading widget__text text-center"><b>Izmir Society</b></h4>--}}{{--

                        --}}
{{--<h4 class="widget__text text-center"> Lahore,Punjab</h4>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="col-md-3  pt-5 pb-5">--}}{{--

                --}}
{{--<div class="card ">--}}{{--

                    --}}
{{--<img class="img-fluid" src="{{url('front/img/wapda_shaikopura.png')}}" alt="Lights" style="width:100%; min-height:30px">--}}{{--

                    --}}
{{--<div class="card-body ">--}}{{--

                        --}}
{{--<span class="properties__ribon">URGENT SALE</span>--}}{{--

                        --}}
{{--<h4 class="text_heading widget__text text-center"><b>Wapda Town Shekhupura</b></h4>--}}{{--

                        --}}
{{--<h4 class="widget__text text-center"> Shekhupura Punjab</h4>--}}{{--


                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--


        --}}
{{--</div>--}}{{--

        <!-- End Section -->
        <!-- OUR Mission -->
        <div class="section-padding">
        <div class="row bg-light">
        </div>
            <div class="col-md-5 pt-5 ">
                <img class="img_mission" src="{{url('front/img/property_placeholder7.jpg')}}" alt="Lights" style="">
            </div>
            <div class="col-md-7">
                <h1 class="text-center text-color">OUR MISSION</h1>
                <p class="text-center widget__headline"><p class=" text-justify">PSS is a comprehensive and modern housing society management software for Pakistan's real estate and residential complex sectors. It has been designed with People as well as Business as focal points. It is developed to assist your office staff with day to day society operations management and to give unique living experience to residents. It assists you with end-to-end management of processes such as plots sales & purchase, biometric registration, payment installments management, utility bills management, town charges, and much more.</p>
                <div class="row pt-2">
                    <div class="col-md-6">
                        <h5 class=" text-color "><b>SAVE MONEY</b></h5>
                        <p class="text-justify">It starts with our living database of more than 110 million U.S. homes – including homes for sale, homes for rent and homes not currently on the market.</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class=" widget__text text-color"><b>GOOD SALES & MARKETING</b></h5>
                        <p class="widget__text text-justify">In addition, RealtySpace operates the largest real estate and rental advertising networks in the U.S. in partnership with Livemile Homes!</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="widget__text text-color"><b>COMFORT</b></h5>
                        <p class="widget__text text-justify">WIt starts with our living database of more than 110 million US homes including homes for sale, homes for rent and homes not currently on the market.</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="widget__text text-color"><b>EASY TO FIND</b></h5>
                        <p class="widget__text text-justify">It starts with our living database of more than 110 million US homes including homes for sale, homes for rent and homes not currently on the market.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->
    --}}
{{--Reason: Dection Not needed for time being. Will required this functionality in future requirement--}}{{--


        <!-- Start Our Agents -->
        --}}
{{--<div class="row  bg-white  section-padding">--}}{{--

            --}}
{{--<div class="col-md-12  bg-white  text-center">--}}{{--

                --}}
{{--<h1 class="widget__title text-color"> <b>OUR AGENTS</b></h1>--}}{{--

                --}}
{{--<p  class="widget__headline widget__text mt-5 pb-5 text-justify1">OUR AGENTS ARE LICENSED PROFESSIONALS THAT SPECIALISE IN SEARCHING, EVALUATING AND NEGOTIATING THE PURCHASE OF PROPERTY ON BEHALF OF THE BUYER. THEY WILL SELL YOU REAL ESTATE. INSIGHTS, TIPS & HOW-TO GUIDES ON SELLING PROPERTY AND PREPARING YOUR HOME OR INVESTMENT PROPERTY FOR SALE AND WORKING TO MAXIMISE YOUR SALE PRICE.</p>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="col-md-3 bg-white">--}}{{--

                --}}
{{--<div class="card bg-white">--}}{{--

                    --}}
{{--<img class="card-img-top" src="{{url('front/img/profile1.jpg')}}" alt="Card image cap">--}}{{--

                    --}}
{{--<div class="card-body">--}}{{--

                        --}}
{{--<h4 class="card-title text-center">Helene Powers</h4>--}}{{--

                        --}}
{{--<p class="card-text text-danger text-center"> <b> +1 202 555 0124</b></p>--}}{{--

                        --}}
{{--<a href="http://realtyspace.codefactory47.com/agents/helene-powers/" class="text-danger text-center">READ MORE</a>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="col-md-3 bg-white">--}}{{--

                --}}
{{--<div class="card bg-white">--}}{{--

                    --}}
{{--<img class="card-img-top" src="{{url('front/img/AGENT PROFILE2.jpg')}}" alt="Card image cap">--}}{{--

                    --}}
{{--<div class="card-body">--}}{{--

                        --}}
{{--<h4 class="card-title text-center">Vladimir Babic</h4>--}}{{--

                        --}}
{{--<p class="card-text text-danger text-center"><b> +1 202 555 0165</b></p>--}}{{--

                        --}}
{{--<a href="#" class="text-danger text-center">READ MORE</a>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--


            --}}
{{--<div class="col-md-3 bg-white ">--}}{{--

                --}}
{{--<div class="card bg-white">--}}{{--

                    --}}
{{--<img class="card-img-top" src="{{url('front/img/AGENT PROFILE3.jpg')}}" alt="Card image cap">--}}{{--

                    --}}
{{--<div class="card-body">--}}{{--

                        --}}
{{--<h4 class="card-title text-center">Mariusz Ciesla</h4>--}}{{--

                        --}}
{{--<p class="card-text text-danger text-center"><b>+1 202 555 0155</b></p>--}}{{--

                        --}}
{{--<a href="#" class="text-danger text-center">READ MORE</a>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--


            --}}
{{--<div class="col-md-3">--}}{{--

                --}}
{{--<div class="card bg-white w-1/2">--}}{{--

                    --}}
{{--<img class="card-img-top" src="{{url('front/img/AGENT PROFILE4.jpg')}}" alt="Card image cap">--}}{{--

                    --}}
{{--<div class="card-body">--}}{{--

                        --}}
{{--<h4 class="card-title text-center">Lisa Wemert</h4>--}}{{--

                        --}}
{{--<p class="card-text text-danger text-center"><b>+1 202 555 0144</b></p>--}}{{--

                        --}}
{{--<a href="#" class="text-danger text-center">READ MORE</a>--}}{{--

                    --}}
{{--</div>--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--

        --}}
{{--</div>--}}{{--

        --}}
{{--End Our Agents Section--}}{{--

            --}}
{{-- Strat Axiom Management Systems Section--}}{{--

            <div class="row bg-white section-padding ">
                <div class="col-md-11  offset-1 bg-white mt-5 mb-5">
                    <h4 class="widget__title  text-center  text-color">Paramount Property Management Systems</h4>

                    </div>
            <div class="row pb-5 ">
                <div class="col-md-4">
                    <div class="bg-image1 pt-4">
                        <img src="{{url('front/img/society_management.png')}}" class="w-100" />
                        <h4 class="text-center text-color"><b>Real Estate Management System</b></h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-image1 pt-4">
                        <img src="{{url('front/img/peroperty_managemnet.png')}}" class="w-100" />
                        <h4 class="text_heading text-color text-center pt-5 "><b>Construction Management System</b></h4>
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="bg-image1 pt-4">
                        <img src="{{url('front/img/HRM_management.png')}}" class="w-100" />
                        <h4 class="text_heading text-center text-color pt-4"><b>HR Management System</b></h4>
                    </div>
                </div>
            </div>
            </div>


    <div class="row pb-5 bg-light">
        <div class="col-md-12 text-center mb-5">
         <h3 class="widget__headline widget__title text-center text-color">
             <b>Talk to Our Team</b></h3>
            <p class="text-center text-justify1">Whether you would like have us call you,<br>
                request a demo, or just drop us a line.
            </p>
        </div>
        <div class="col-md-4 text-center">
            <img class="talkteam_image pb-3" src="{{url('front/img/image1.png')}}" alt="Card image cap">
            <p class=" widget__text text-justify1 ">Would like to discuss it?<br>
                Send us a callback request
            </p>
                <button type="button" class="btn btn-danger">Request a Callback</button>
        </div>

        <div class="col-md-4 text-center">
            <img class="talkteam_image pb-3" src="{{url('front/img/enquiry-1.png')}}" alt="Card image cap">
            <p class=" widget__text text-justify1 ">Want to know more about<br>
                solutions? drop us a line
            </p>
                <button type="button" class="btn btn-danger">Send and Enguiry</button>
        </div>
        <div class="col-md-4 text-center">
            <img class="talkteam_image pb-3" src="{{url('front/img/demo-1.png')}}" alt="Card image cap">
            <p class=" widget__text text-justify1 ">Would like to discuss it?<br>
                Send us a callback request
            </p>
                <button type="button" class="btn btn-danger">Request a Demo</button>
        </div>
    </div>

        --}}
{{--<div class="row border border pt-5 pb-3">--}}{{--

            --}}
{{--<div class="col-md-12 text-center">--}}{{--

                --}}
{{--<h1 class="widget__headline widget__title"><b>TESTIMONIALS</b></h1><br>--}}{{--

                --}}
{{--<h6 class="widget__headline widget__text "> INSIGHTS, TIPS & HOW-TO GUIDES ON SELLING PROPERTY AND PREPARING YOUR HOME OR INVESTMENT PROPERTY FOR SALE</h6>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="offset-md-6 col-md-1 ">--}}{{--

                --}}
{{--<div class="card bg-white">--}}{{--

                    --}}
{{--<img class="card-img-top " src="{{url('front/img/housewife.jpg')}}" alt="Card image cap">--}}{{--

                --}}
{{--</div>--}}{{--

            --}}
{{--</div>--}}{{--

            --}}
{{--<div class="row pt-0">--}}{{--

                --}}
{{--<div class=" offset-4 col-md-5 pt-3 pb-5">--}}{{--

                    --}}
{{--<h6 class="widget__text card-link"><i>Dear Ana we have been so gratefull for your hardworking and support. Although we haven't had many issue but any time there has been an  issue you have been incredible helpul and whenever you have come out fpr an inpection you have been so personable and absolutly lovely..</i> </h6>--}}{{--

                --}}
{{--</div>--}}{{--


            --}}
{{--</div>--}}{{--

        --}}
{{--</div>--}}{{--

    </div>
@endsection


<!-- close section -->
--}}
