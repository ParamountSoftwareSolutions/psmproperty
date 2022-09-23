@extends('front.layouts.app')
<!-- section('body.content') -->
@section('body.content')
    <div class="container-fluid">
<div class="row bg-white  ">
    <div class="col-md-12 text-center pt-2 pb-5 ">
        <h1 class="text-color "><b>CONTACT</b></h1>
    </div>
    <div class="row bg-white">
        <div class="col-md-6 bg-white bg-white">
            <p class="text-justify text-color"><b>Lahore</b></p>
            <div class="row border-top bg-white section-padding">
                <div class="col-md-6 pt-4 bg-white">
                    <p class="text-justify1 text-color"><b>Address:</b></p>
                    <h6 class="text-justify1 section-padding1 "><p>Street 5, Imperial Garden Homes Commercial 100 S Paragon City, Cantt, Lahore, Punjab 53200
                        </p></h6>
                    <p class="text-justify text-color pt-5 "><b>Working hours:</b></p>
                    <p class="text-justify1 "><b>08 - 17    mon-fr</b></p>
                </div>
                <div class="col-md-6 pt-4">
                    <p class="text-justify text-color "><b>Telephone:</b></p>
                    <h6 class="text-justify1 pb-5"><b>(042) 37184017</b></h6>
                    <p class="text-justify text-color pt-5"><b>Email:</b></p>
                    <div class="contacts__column text-color">
                        <a href="mailto:info@paramountsoftwaresolutions.com"><p class="text-justify"><b>info@paramountsoftwaresolutions.com</b></p></a>

                    </div>
                </div>
            </div>
            <div class="col-md-12 border-top pl-3 ">
                <h5 class="text-justify text-color pt-5 "><b>Contact Us to Sign Up for an Open House</b></h5>
                <p class="pt-4 text-justify1 section-padding1 pb-5 ">Founded in August of 2021 and based in Lahore, Punjab, Property Managements System is a trusted community marketplace for people to list, discover, and book unique accommodations around the world — online or from a mobile phone.Whether an apartment for a night, a castle for a week, or a villa for a month, RealtySpace connects people to unique travel experiences, at any price point, in more than 190 countries. And with world-class customer service, Property Managements System is the easiest way for people to monetize their extra sp</p>
            </div>
        </div>
            <div class="col-md-6 pt-5 pb-5 " >
                <form class="bg-color section-padding">
                    <div class="mb-3 ">
                        <label for="zain.nazir" class="form-label text-color"><b>YOUR NAME</b></label>
                        <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                        <label for="Phone Number" class="form-label text-color"><b>TELEPHONE</b></label>
                        <input type="tel" class="form-control" id="exampleInputtel" aria-describedby="phoneHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label text-color"><b>E-MAIL</b></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="text"><b class="text-color">MESSAGE</b></label>
                        <textarea class="form-control" rows="5" id="message"></textarea>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-danger text-colors ">Send</button>
                    </div>
                </form>
            </div>
    </div>
</div>
    </div>

@endsection