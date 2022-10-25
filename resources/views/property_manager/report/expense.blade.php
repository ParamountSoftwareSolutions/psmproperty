@extends('property_manager.layout.app')
@section('title',  'Expense')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                {{--<div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        --}}{{--                                        <a class="nav-link active" href="{{ route('property_manager.report.search', ['type' => Request::segment(3), 'time' => 'total']) }}">Total Sales <span class="badge badge-white">{{ 0 }}</span></a>--}}{{--
                                    </li>
                                    --}}{{--                                    <li class="nav-item">--}}{{--
                                    --}}{{--                                        <a class="nav-link" href="{{ route('property_manager.report.search', ['type' => Request::segment(3), 'time' => 'weekly']) }}">Weekly Sales <span class="badge badge-primary">2</span></a>--}}{{--
                                    --}}{{--                                    </li>--}}{{--
                                    --}}{{--                                    <li class="nav-item">--}}{{--
                                    --}}{{--                                        <a class="nav-link" href="{{ route('property_manager.report.search', ['type' => Request::segment(3), 'time' => 'monthly']) }}">Monthly Sales <span class="badge badge-primary">3</span></a>--}}{{--
                                    --}}{{--                                    </li>--}}{{--
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-12">
                        <h2 class="h2">
                            <img src="{{ asset('public/panel/assets/img/logo.png') }}" alt="" width="200px" class="logo">
                        </h2>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ ucwords(str_replace("_report"," Report",Request::segment(3))) }} Report</h4>
                                <div class="text-md-right">
                                    <button class="btn btn-warning btn-icon icon-left print"><i class="fas fa-print"></i> Print</button>
                                </div>
                                {{--<a href="{{ route('property_manager.request.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>--}}
                            </div>
                            <div class="card-body">
                                <form action="{{ route('property_manager.report.expense_report') }}" method="get">
                                    @csrf
                                    <div class="row mt-3 mb-5">
                                        <div class="col-md-3 mt-sm-2">
                                            <select class="form-control" name="building_id" required>
                                                <option label="" selected disabled>Select Building</option>
                                                <option value="all" @if($request !== null)
                                                @if($request->building_id == 'all') selected @endif
                                                    @endif>All
                                                </option>
                                                @foreach($building_list as $data)
                                                    <option value="{{ $data->id }}"
                                                            @if($request !== null)
                                                            @if($request->building_id == $data->id) selected @endif
                                                        @endif>
                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('building_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <input type="date" class="form-control" name="start_month"
                                                   value="{{ old('start_month', ($request !== null) ? $request->start_month : null) }}"
                                                   required>
                                            @error('start_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <input type="date" class="form-control" name="last_month"
                                                   value="{{ old('last_month', ($request !== null) ? $request->last_month : null) }}"
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
                                                <th>{{__('Category')}}</th>
                                                @foreach($monthList as $month)
                                                    <th>{{$month}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{-- @dd($expenseArr)--}}
                                            @foreach($expenseArr as $i=>$expense)
                                                {{--@dd($expenseArr, $expense['data'])--}}
                                                <tr>
                                                    <td>{{$expense['category']}}</td>
                                                    @foreach($expense['data'] as $j=>$data)

                                                        <td>{{$data}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="13" class="text-dark"><span>{{__('Bill :')}}</span></td>
                                            </tr>
                                            @foreach($billArray as $i=>$bill)
                                                <tr>
                                                    <td>Building Expense</td>
                                                    @foreach($bill as $j=>$data)
                                                        <td>{{$data}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="13" class="text-dark">
                                                    <span>{{__('Expense = Office Expense + Building Construction Expense :')}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">{{__('Total')}}</td>
                                                @foreach($chartExpenseArr as $i=>$expense)
                                                    <td>{{$expense}}</td>
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
        $('.changeStatus').on('click', function () {
            var url = $(this).data('url');console.log(url)
            $('#statusForm').attr('action', url);
            $('#statusModal').modal('show');

        });
    </script>
@endsection
