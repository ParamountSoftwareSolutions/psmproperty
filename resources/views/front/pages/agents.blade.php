@extends('front.layouts.app')
<!-- section('body.content') -->
@section('body.content')
    <!-- Silder Section Start -->
    <div class="container-fluid">
    <div class="row ">
        <div class="col-md-9">
            <h1><b>AGENTS</b></h1>
            <p>Archives: Agents</p>
        </div>
        <div class="col-md-3">
            <h6></h6>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-9">
            <div class="main_heading pb-1">
            <p>Our team of agents are ready to help you reach your real estate goals by making your needs our number one priority. We recognize you have a choice when it comes to working with a real estate professional.</p>
            </div>
        </div>
    </div>
{{--<agents start section--}}
    <div class="row pt-3">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 ">
                    <div class="card bg-white">
                        <img class="card-img-top" src="{{url('front/img/AGENT PROFILE4.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h4><a href="#" class="card-link "><b>HELENE POWERS</b></a></h4>
                            <p class=" widget__text">Real Estate Broker</p>
                            <p class=" widget__text"> Listings -
                                <a href="#" class="card-link">0 properties</a></p>
                            <p class="widget__text">When it comes to selling property nobody comes close to the dedication and care taken by Helene Powers. With over 25 years in residential sales and marketing, numerous awards and an unbeleivable number of happy clients, only Helene can deliver an extraordinary home sale experience. “Despite the many changes I have seen in</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card bg-white">
                        <img class="card-img-top" src="{{url('front/img/AGENT PROFILE2.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h4><a href="#" class="card-link "><b>VLADIMIR BABIC</b></a></h4>
                            <p class=" widget__text">Real Estate Broker</p>
                            <p class=" widget__text "> Listings -
                                <a href="#" class="card-link">1 properties</a></p>
                            <p class="widget__text"> Whether you are looking to rent, buy or sell your home, Realtyspace’s directory of local real estate agents and brokers connects you with professionals who can help meet your needs. Because the real estate market is unique, it’s important to choose a real estate agent or broker with local expertise to guide you through  </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card bg-white">
                        <img class="card-img-top" src="{{url('front/img/AGENT PROFILE3.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h4><a href="#" class="card-link "><b>MARIUSZ CIESLA</b></a></h4>
                            <p class="widget__text">Real Estate Professional</p>
                            <p class="widget__text"> Listings -
                                <a href="#" class="card-link">2 properties</a></p>
                            <p class="widget__text">Mariusz Ciesla, Director, Auctioneer and Senior Sales Representative of the Mariusz Ciesla Professionals Real Estate Agency, epitomizes integrity, energy, dedication, hard work and creative personal service  transaction he is involved in. Mariusz brings to our team over 15 years of industry knowledge in the field of</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card bg-white">
                        <img class="card-img-top" src="{{url('front/img/AGENT PROFILE4.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h4><a href="#" class="card-link "><b>LISA WEMERT</b></a></h4>
                            <p class="widget__text">Managing Broker/Partner, e-PRO</p>
                            <p class="widget__text"> Listings -
                                <a href="#" class="card-link">2 properties</a></p>
                            <p class="widget__text">Enthusiastic and efficient, Lisa Wemert comes to real estate with a reputation for providing outstanding customer service. Lisa has extensive personal experience in property investment and is equipped with first-hand knowledge of the needs of her sellers and buyers. Lisa has strong knowledge of the local property market which allows her to</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card bg-white">
                        <img class="card-img-top" src="{{url('front/img/AGENT PROFILE5.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5><a href="#" class="card-link "><b>CHRISTOPHER PAKULLA</b></a></h5>
                            <p class="widget__text">Realtor, West USA Realty</p>
                            <p class="widget__text"> Listings -
                                <a href="#" class="card-link">2 properties</a></p>
                            <p class="widget__text ">I’m an entrepreneur who loves to travel and splits time between New York and Los Angeles. Believer in the golden rule: Do unto others as you would have them do unto you. Favorite destinations include Cabo San Lucas, Costa Rica, Turks & Caicos ideal vacation spots We recognize you have a choice when it comes to working with a real estate</p>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        {{--end agents section<--}}


        <div class="col-md-3 pb-5 ">
            <h1><b>TOP AGENTS</b></h1>
            <div class="card bg-white">
                <div class="card bg-white">
                    <img class="card-img-top img-thumbnail" src="{{url('front/img/AGENT PROFILE4.jpg')}}" alt="Card image cap">
                    {{--<img src="{{url('front/img/AGENT PROFILE4.jpg')}}" class="img-thumbnail" alt="Cinque Terre">--}}
                    <div class="card-body">
                        <h5><a href="#" class="card-link "><b>HELENE POWERS</b></a></h5>
                        <p class="widget__text">Real Estate Broker</p>
                       <h5><a href="helene@realtyspace.com" class="card-link">helene@realtyspace.com</a></h5>
                    </div>
                </div>
                <div class="card bg-white">
                    <img class="card-img-top img-thumbnail" src="{{url('front/img/AGENT PROFILE3.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h5><a href="#" class="card-link "><b>MARIUSZ CIESLA</b></a></h5>
                        <p class="widget__text">Real Estate Professional</p>
                        <h5><a href="marius@realtyspace.com" class="card-link">marius@realtyspace.com</a></h5>
                    </div>
                </div>
                <div class="card bg-white">
                    <img class="card-img-top img-thumbnail" src="{{url('front/img/AGENT PROFILE2.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h5><a href="#" class="card-link "><b>MARIUSZ CIESLA</b></a></h5>
                        <p class="widget__text">Realtor, CDPE</p>
                        <h5><a href="vladimir@realtyspace.com" class="card-link">vladimir@realtyspace.com</a></h5>
                    </div>
                </div>

                {{--end top agents side section--}}
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

                                <h5><a href="info@paramountsoftwaresolutions.com" class="card-link">info@paramountsoftwaresolutions.com</a></h5>
                            </div>
                        </div>
                </div>
                {{--end contact section--}}
                     {{--start feedback section--}}
                <div class="contact_side pt-5 pb-1" >
                    <h1><b>FEEDBACK</b></h1>
                </div>
                <div class="card bg-white pb-3 pt-3 ">
                    <div class="card-body">
                        <form class="form-inline" action="/action_page.php">
                            <div class="form-group pb-3">

                                <input type="email" class="form-control" id="email" placeholder="E-mail">
                            </div>
                            <div class="form-group pb-3">

                                <textarea class="form-control" rows="5" id="message" placeholder="Message"></textarea>
                            </div>
                            <button type="submit" class="btn border bg-gray">Send</button>
                        </form>
                    </div>
                </div>
                {{--end feedbak section--}}

            </div>
            </div>
        </div>
    </div>
@endsection
<!-- close section -->
