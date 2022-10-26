@extends('front.layouts.app')
<!-- section('body.content') -->
@section('body.content')

    <!-- Gellery title Section Start -->
    <div class="container-fluid">
    <div class="row pt-5 pb-5">
    <div class="col-md-9 ">
        <div class="gallery_title widget__title ">
        <h1><b>GALLERY OF SUBMITTED
            </b></h1>
        <h1><b>PROPERTIES</b></h1>
        </div>
    </div>

    <div class="col-md-3 ">
        <div class="widget__title">
            <h1><b>RECENT COMMENTS</b></h1>
        </div>
          <input type="text" placeholder="Search..">
    </div>
</div>
    <!-- Gellery title Section end -->

    <!-- Gellery  Section Start -->
    <div class="row">
        <div class="col-md-9">
            <div class="row  pb-5">
                <div class="col-md-4 ">
                    <div class="card bg-white">
                        <img class="img-fluid" src="{{url('front/img/wapda.png')}}" alt="Lights" style="width:100%; min-height:30px">
                        <div class="card-body ">
                            {{--<span class="properties__ribon">URGENT SALE</span>--}}
                            <p class="card-text widget__text"><h5><b>Wapda Town Sargodha</b></h5>
                            Sarghoda,Punjab
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-white">
                        <img class="img-fluid" src="{{url('front/img/lahore_garden.png')}}" alt="Lights" style="width:100%; min-height:30px">
                        <div class="card-body ">
                            {{--<span class="properties__ribon">URGENT SALE</span>--}}
                            <p class="card-text widget__text"><h5><b>Lahore Garden Housing Society</b></h5>
                            Lahore, Punjab
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-white">
                        <img class="img-fluid" src="{{url('front/img/izmar_garden.png')}}" alt="Lights" style="width:100%; min-height:30px">
                        <div class="card-body ">
                            {{--<span class="properties__ribon">URGENT SALE</span>--}}
                            <p class="card-text widget__text"><h5><b>Izmir Society</b></h5>
                            Lahore,Punjab
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gellery  Section end -->

        <!-- Gellery post Section start -->
        <div class="col-md-3 pb-5">
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
                    <h6><a href="#" class="card-link ">Dec 2021</a></h6>
                </div>
            </div>
            <h2 class="card-title pt-3 "><b>CATEGORIES</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#" class="card-link ">news(1) </a></h6>
                    <h6><a href="#" class="card-link ">Roundup(1) </a></h6>
                    <h6><a href="#" class="card-link ">Uncategorized (2)</a></h6>
                </div>
            </div>
            <h2 class="card-title pt-3 "><b>TAG</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#" class="card-link">ROUNDUP</a></h6>
                </div>
            </div>
            <h2 class="card-title pt-3"><b>RECENT COMMENTS</b></h2>
            <div class="card bg-white">
                <div class="card-body">
                    <h6><a href="#" class="card-link "></a></h6>
                </div>
            </div>
            <!--end  Gellery post Section  -->

            {{--start contact section--}}
            <div class="contact_side pt-5 pb-1" >
                <h1 class="widget__title" _><b>CONTACT</b></h1>
                <p class="widget__text">Our office</p>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <div class="widget__text">Street 5, Imperial Garden Homes Commercial 100 S Paragon City,
                        Cantt, Lahore, Punjab 53200 Pakistan
                        <p>08 - 17 mon-fr</p>
                        <h5><a href="(042) 37184017" class="card-link">(042) 37184017</a></h5>
                        <h5><a href="+1 202 555 0145" class="card-link">+1 202 555 0145</a></h5>
                        <h5><a href=info@paramountsoftwaresolutions.com" class="card-link">info@paramountsoftwaresolutions.com
                            </a></h5>
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
                        <button type="submit" class="btn border  bg-wihte ">Send</button>
                    </form>
                </div>
            </div>
            {{--end feedbak section--}}
        </div>
    </div>
    </div>

@endsection