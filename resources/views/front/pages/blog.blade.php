@extends('front.layouts.app')
<!-- section('body.content') -->
@section('body.content')
    <div class="container-fluid">
<div class="row">
    <div class="col-md-9 pt-5">
           <h1 class=""><b>BLOG</b></h1>
    </div>
    <div class="col-md-3 ">
        <h2><b>SEARCH BLOG</b></h2>
        <h2 class="card-title"><b></b></h2>
        <div class="card bg-white ">
            <div class="card-body">
                <h5><a href="#" class="card-links text-black"></a></h5>
                </div>
        </div>
    </div>
</div>
    <div class="row text-justify">
        <div class="  col-md-9 border">
            {{-- Start Viedo Section--}}
            <div class="video">
            <h5><a href="#" class="card-links text-black  "><b>We’re ready for the TRID rules!</b></a></h5>
            <h6><b>Author: admin &nbsp; Categories: &nbsp;<a href="#" class="card-link ">news,Roundup</a></b></h6>
            <div class="embed-responsive embed-responsive-16by9 border">
                <iframe class="embed-responsive-item" src="{{url('front/video/Realtyspace.webm')}}" allowfullscreen></iframe>
            </div>
            <p class="pt-5  ">
            <p class="text-justify">  May new home sales gain 2.2% from April</p>
            <p class="text-justify">Sales of new single-family houses in May 2015 were at a seasonally adjusted annual rate of 546,000, which is up 2.2% from April, according to estimates released jointly today by the U.S. Census Bureau and the Department of Housing and Urban Development. — From Housing Wire</p>
            <p class="text-justify"> 3 ways to tame student loan debt and afford a mortgage</p>
            <p class="text-justify"> It’s no secret that student loans can make buying a home a challenge. But what exactly is the problem, and how can buyers overcome it? The problem is that student loans can be included in the buyer’s debt-to-income ratio, or DTI. — From Bankrate.</p>

            </p>
                <div class="btn border"> READ MORE</div>
            </div>
            {{-- Start End Viedo Section--}}
            {{-- Start  Slider Section--}}
            <div class="col-md-12 pt-5 pb-5 border-top border-bottom " >
            <h5><a href="#" class="card-links text-black"><b>We’re ready for the TRID rules!</b></a></h5>
            <h6><b>Author: admin &nbsp; Categories: &nbsp;<a href="#" class="card-link ">Uncategorized</a></b></h6>
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo1" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo2" data-bs-slide-to="2"></button>
                </div>
                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{url('front/img/kitchen2.jpg')}}"alt="Los Angeles" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="{{url('front/img/kitchen2.jpg')}}"alt="Chicago" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="{{url('front/img/kitchen3.jpg')}}"alt="New York" class="d-block w-100">
                    </div>
                </div>
                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo1" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo3" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
                <p class="pt-5 pb-5 text-justify">
                <p class="text-justify"> At 5 p.m. EST June 17, the Consumer Financial Protection Bureau issued a statement that the effective date for the TILA-RESPA Integrated Disclosure (TRID) rules would be pushed back to Oct. 1, 2015.</p>

                <p class="text-justify"> CFPB Director Richard Cordray said in a prepared statement: “The CFPB will be issuing a proposed amendment to delay the effective date of the Know Before You Owe rule unti. 1, 2015. We made this decision to correct an administrative error that we just discovered in meeting the requirements under federal law, which would have delayed the effective date of the rule by two weeks. We further believe that the additional time included in the proposed effective date would better accommodate the interests of the many consumers and providers whose families will be busy with the transition to the new school year at that time.”</p>
                <p class="text-justify"> Rainier Title has been working towards the TRID implementation for over a year and felt prepared for August 1st. However, with the proposed delay we will be taking this opportunity to continue our education and training of TRID. While we believe that we have been proactive and ready for this change, there are still so many unknowns that will have to be addressed at the time of implementation. The industry should still prepare for 45-60 days for transaction to close due to the new timing parameters of the forms.</p>
                <p class="text-justify">  We’re working hard to be ready for all changes!</p>
                </p>
            </div>
            {{-- End  Slider Section--}}

            {{-- Start  Image Section--}}
            <div class="col-md-12 pt-5 pb-5 border-top border-bottom " >

                <h5><a href="#" class="card-links text-black font-extrabold"><b>We’re ready for the TRID rules!</b></a></h5>
                <h6><b>Author: admin &nbsp; Categories: &nbsp;<a href="#" class="card-link ">Uncategorized</a></b></h6>
                <!-- Carousel -->
                <div id="demo" class="carousel slide" data-bs-ride="carousel">
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{url('front/img/kitchen3.jpg')}}"alt="Los Angeles" class="d-block w-100">
                        </div>
                </div>
                <p class="pt-5 pb-5">
                    <p class="text-justify"> At 5 p.m. EST June 17, the Consumer Financial Protection Bureau issued a statement that the effective date for the TILA-RESPA Integrated Disclosure (TRID) rules would be pushed back to Oct. 1, 2015.</p>
                   <p class="text-justify"> CFPB Director Richard Cordray said in a prepared statement: “The CFPB will be issuing a proposed amendment to delay the effective date of the Know Before You Owe rule unti. 1, 2015. We made this decision to correct an administrative error that we just discovered in meeting the requirements under federal law, which would have delayed the effective date of the rule by two weeks. We further believe that the additional time included in the proposed effective date would better accommodate the interests of the many consumers and providers whose families will be busy with the transition to the new school year at that time.”</p>
                    <p class="text-justify"> Rainier Title has been working towards the TRID implementation for over a year and felt prepared for August 1st. However, with the proposed delay we will be taking this opportunity to continue our education and training of TRID. While we believe that we have been proactive and ready for this change, there are still so many unknowns that will have to be addressed at the time of implementation. The industry should still prepare for 45-60 days for transaction to close due to the new timing parameters of the forms.</p>
                    <p class="text-justify"> We’re working hard to be ready for all changes!</p>
                </p>
            </div>
            </div>
            </div>
        {{-- End  Slider Section--}}

        <div class="col-md-3 pt-5 border-top border-bottom ">
            <h2 class="card-title"><b>LATEST POST</b></h2>
            <div class="card bg-white ">
                <div class="card-body">
                    <h5><a href="#" class="card-links text-black"><b>Real Estate “Roundup”!</b></a></h5>
                    <h6><b>TUE - 19 APR - 10:39 AM</b></h6>
                    <p class=" widget__text ">May new home sales gain 2.2% from April Sales of new single-family houses in May 2015 were at a seasonally…</p>
                    <a href="#" class="btn border-dark">READ MORE</a>
                </div>
            </div>
            <div class="card bg-white ">
                <div class="card-body">
                    <h5><a href="#" class="text-black"><b>We’re ready for the TRID rules!</b></a></h5>
                    <h6><b>FRI - 15 APR - 5:07 PM</b></h6>
                    <p class=" widget__text ">At 5 p.m. EST June 17, the Consumer Financial Protection Bureau issued a statement that the effective date for the…</p>
                    <a href="#" class="btn border-dark">READ MORE</a>
                </div>
            </div>
            <div class="card bg-white ">
                <div class="card-body">
                    <h5><a href="#" class=" text-black"><b>Real Estate Roundup</b></a></h5>
                    <h6><b>FRI - 15 APR - 11:32 AM</b></h6>
                    <p class= "widget__text "> Active Home-Building Industry Will Lead to More Demand for Warehouse Space Strong consumer spending and the rise in housing construction…</p>
                    <a href="#" class="btn border-dark">READ MORE</a>
                </div>
            </div>
            <h2 class="card-title pt-3"><b>ARCHIVES</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#" class="card-link ">April 2016</a></h6>
                </div>
            </div>
            <h2 class="card-title pt-3 "><b>CATEGORIES</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#" class="card-link ">news</a>(1)</h6>
                    <h6><a href="#" class="card-link ">Roundup</a>(1)</h6>
                    <h6><a href="#" class="card-link ">Uncategorized</a>(2)</h6>
                </div>
            </div>
            <h2 class="card-title pt-3 "><b>TAG</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#">ROUNDUP</a></h6>
                </div>
            </div>
            <h2 class="card-title pt-3"><b>RECENT COMMENTS</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#" class="card-link "></a></h6>
                </div>
            </div>
            {{--start contact section--}}
            <div class="contact_side pt-5 pb-1" >
                <h1 class="widget__title" _><b>CONTACT</b></h1>
                <p class="widget__text">Our office</p>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <div class="widget__text">80 Franklin Street New York, NY 10013 USA
                        <p>08 - 17 mon-fr</p>
                        <h5><a href="+1 202 555 0135" class="card-link">+1 202 555 0135</a></h5>
                        <h5><a href="+1 202 555 0145" class="card-link">+1 202 555 0145</a></h5>
                        <h5><a href="contact@realtyspace.com" class="card-link">contact@realtyspace.com</a></h5>
                    </div>
                </div>
            </div>
            {{--end contact section--}}
            {{--start feedback section--}}
            <div class="contact_side pt-5 pb-5" >
                <h2><b>FEEDBACK</b></h2>
            </div>
            <div class="card bg-gray ">
                <div class="card-body">
                    <form class="form-inline" action="/action_page.php">
                        <div class="form-group  pb-4">

                            <input type="email" class="form-control" id="email" placeholder="E-mail">
                        </div>
                        <div class="form-group pb-2">
                            <textarea class="form-control" rows="5" id="message" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn border  bg-white ">Send</button>
                    </form>
                </div>
            </div>
            {{--end feedbak section--}}
        </div>
    </div>
    </div>

@endsection

