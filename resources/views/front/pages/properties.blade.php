    @extends('front.layouts.app')
    <!-- section('body.content') -->
    @section('body.content')

        {{-- START PROPERTIES Section--}}
        <div class="container-fluid">
        <div class="row pt-3">
            <div class="properties__img">
            <div class="col-md-9">
                <div class="row">
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
                                <span class="properties__ribon">URGENT SALE</span>
                                <p class="card-text widget__text"><h5><b>Izmir Society</b></h5>
                                Lahore,Punjab
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-5">
                        <div class="card bg-white">
                            <img class="img-fluid" src="{{url('front/img/wapda_shaikopura.png')}}" alt="Lights" style="width:100%; min-height:30px">
                            <div class="card-body ">
                                {{--<span class="properties__ribon">URGENT SALE</span>--}}
                                <p class="card-text widget__text"><h5><b>Wapda Town Shekhupura</b></h5>
                                Shekhupura Punjab
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-5 ">
                        <div class="card bg-white">
                            <img class="img-fluid" src="{{url('front/img/wapda_kasur.png')}}" alt="Lights" style="width:100%; min-height:30px">
                            <div class="card-body ">
                                {{--<span class="properties__ribon">URGENT SALE</span>--}}
                                <p class="card-text widget__text"><h5><b>Wapda Town Kasur</b></h5>
                                Kasur Punja
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-5 ">
                        <div class="card bg-white">
                            <img class="img-fluid" src="{{url('front/img/passco_housing.png')}}" alt="Lights" style="width:100%; min-height:30px">
                            <div class="card-body ">
                                {{--<span class="properties__ribon">RENT</span>--}}
                                <p class="card-text widget__text"><h5><b>Pasco Housing Society</b></h5>
                                Lahore Punjab
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--Start popular satate section--}}

            <div class="col-md-3">
                    <h1 class="widget__title1"><b>POPULAR ESTATES</b></h1>
                <div class="card bg-white">
                    <img class="card-img-top img-thumbnail1" src="{{url('front/img/wapda.png')}}" alt="Card image cap">
                    <div class="card-body ">
                        {{--<span class="properties__ribon">URGENT SALE</span>--}}
                        <p class="card-text widget__text"><h5><b>Wapda Town Sargodha</b></h5>
                        Sarghoda,Punjab
                        </p>
                    </div>
                </div>
                <div class="card bg-white">
                    <img class="img-fluid" src="{{url('front/img/izmar_garden.png')}}" alt="Lights" style="width:100%; min-height:30px">
                    <div class="card-body ">
                        {{--<span class="properties__ribon">URGENT SALE</span>--}}
                        <p class="card-text widget__text"><h5><b>Izmir Society</b></h5>
                        Lahore,Punjab
                        </p>
                    </div>
                </div>
                    <div class="card bg-white">
                        <img class="img-fluid" src="{{url('front/img/wapda_kasur.png')}}" alt="Lights" style="width:100%; min-height:30px">
                        <div class="card-body ">
                            {{--<span class="properties__ribon">URGENT SALE</span>--}}
                            <p class="card-text widget__text"><h5><b>Wapda Town Kasur</b></h5>
                            Kasur Punja
                            </p>
                        </div>
                    </div>
                {{--Start popular satate section--}}

                {{--Start our agents section--}}
                        <h1 class="widget__title1"><b>OUR AGENTS</b></h1>
                    <div class="card bg-white">
                                <img class="card-img-top img-thumbnail1" src="{{url('front/img/AGENT PROFILE4.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5><a href="#" class="card-link ">HELENE POWERS</a></h5>
                            <p class="widget__text">Real Estate Broker</p>
                            <h5><a href="helene@realtyspace.com" class="card-link">helene@realtyspace.com</a></h5>
                        </div>
                    </div>
                    <div class="card bg-white">
                                    <img class="card-img-top img-thumbnail1" src="{{url('front/img/AGENT PROFILE3.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5><a href="#" class="card-link ">MARIUSZ CIESLA</a></h5>
                            <p class="widget__text">Real Estate Professional</p>
                            <h5><a href="marius@realtyspace.com" class="card-link">marius@realtyspace.com</a></h5>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <img class="card-img-top img-thumbnail1" src="{{url('front/img/AGENT PROFILE2.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5><a href="#" class="card-link ">MARIUSZ CIESLA</a></h5>
                            <p class="widget__text">Realtor, CDPE</p>
                            <h5><a href="vladimir@realtyspace.com" class="card-link">vladimir@realtyspace.com</a></h5>
                        </div>
                    </div>
                </div>
            {{--end our agents section--}}
            </div>
        </div>
        </div>

        {{-- end PROPERTIES Section--}}
    @endsection
    <!-- close section -->
