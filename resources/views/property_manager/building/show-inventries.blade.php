<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/app.min.css') }}">
    <title>{{$building->name}}</title>
    <style>
        .building_heading{
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
        .logo_img{
            padding-left: 70px;
            margin-top: 45px;
        }
    </style>
</head>
<body>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row print_area">
                <div class="logo_img">
                    <img src="{{ asset('public/panel/assets/img/logo-pdf.png') }}" alt="" width="50%" class="logo">
                </div>
                <div class="building_heading">
                    <h1 class="building">{{$building->name}}</h1>
                </div>
                <div class="col-lg-12">
                    @forelse($floors as $floor)

                        <div class="card">
                            <div class="card-header text-center">
                                <h4>{{$floor->name}}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table text-center table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Unit Id</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Premium</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $floor_details = \App\Models\FloorDetail::where(['floor_id' => $floor->id,'building_id' => $building->id])->get();
                                    @endphp
                                    @forelse($floor_details as $floor_detail)
                                        <tr>
                                            <th scope="row">{{$floor_detail->unit_id}}</th>
                                            <td>{{$floor_detail->area}} Square Feet</td>
                                            <td>{{isset($floor_detail->payment_plan->total_price) ? 'Rs. '.number_format($floor_detail->payment_plan->total_price) : ''}}</td>
                                            <td>{{ucfirst($floor_detail->status)}}</td>
                                            <td>{{$floor_detail->premium ? 'Corner' : ''}}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5"><h5>No Inventries Found</h5></td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="card"><h4>We Dont Have Any Records To This Building</h4></div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>

{{--{{dd('eeeee')}}--}}
