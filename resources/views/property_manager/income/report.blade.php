@extends('property_manager.layout.app')
@section('title',  'Expense')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="h2">
                            <img src="{{ asset('public/panel/assets/img/logo.png') }}" alt="" width="200px" class="logo">
                        </h2>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Income Report</h4>
                                <div class="text-md-right">
                                    <button class="btn btn-warning btn-icon icon-left print"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('property_manager.income.report',Helpers::user_login_route()['panel']) }}" method="get">
                                    @csrf
                                    <div class="row mt-3 mb-5">
                                        <div class="col-md-3 mt-sm-2">
                                            <input type="date" class="form-control" name="start_month"
                                                   value="{{ old('start_month', (Request()->start_month !== null) ? Request()->start_month : null) }}"
                                                   required>
                                            @error('start_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <input type="date" class="form-control" name="last_month"
                                                   value="{{ old('last_month', (Request()->last_month !== null) ? Request()->last_month : null) }}"
                                                   required>
                                            @error('last_month')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <button class="btn btn-primary btn-block p-2" type="submit">Show</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            {{--                                            <strong>Total Sale:</strong> Rs {{ array_sum($total_sale) }}<br>--}}
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                            <tr>
                                                <th>Category</th>
                                                @foreach($months as $month)
                                                    <th>{{$month}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($incomes as $key => $val)
                                                @php
                                                    switch($key){
                                                        case 'rent' : $cat = 'Rent';break;
                                                        case 'personal_property_rent' : $cat = ' Personal Property Rent';break;
                                                        case 'group_a' : $cat = 'Group A';break;
                                                        case 'group_b' : $cat = 'Group B';break;
                                                        case 'file_income' : $cat = 'File Income';break;
                                                        case 'property_income' : $cat = 'Property Income';break;
                                                        case 'others' : $cat = 'Others';break;
                                                        default:$cat = '';
                                                    }
                                                @endphp
                                                <tr>
                                                    <th>{{$cat}}</th>
                                                    @foreach($val as $income)
                                                        <td>{{$income}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                @foreach($total as $val)
                                                    <th>{{$val}}</th>
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(".logo").hide();
        $(document).on('click', '.print', function () {
            $(".title").hide();
            $(".print").hide();
            $(".logo").show();
            $('.navbar').hide();
            $('.main-sidebar').hide();
            $('.main-footer').hide();
            $('.action').hide();
            $('.h2').css({
                "margin-bottom": "-5.0rem !important"
            });
            $(".print_area").css({
                "width": "100%",
                "margin-top": '-180px'
            });
            window.print();
            $(".title").show();
            $(".print").show();
            $(".logo").hide();
            $('.navbar').show();
            $('.main-sidebar').show();
            $('.main-footer').show();
            $('.action').show();
            $(".print_area").css({
                "width": "100%",
                "margin-top": '-7px'
            });
        });
    </script>
@endsection
