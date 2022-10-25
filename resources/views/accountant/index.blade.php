@extends('accountant.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">New Booking</h5>
                                            <h2 class="mb-3 font-18">{{ count($leads) }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">10%</span> Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-4">
                                        <div class="pt-3 pl-3 banner-img">
                                            <img src="{{ asset('public/panel/assets/img/banner/1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Customers</h5>
                                            <h2 class="mb-3 font-18">{{ count($sales) }}</h2>
                                            {{--<p class="mb-0"><span class="col-orange">09%</span> Decrease</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-4 pt-2 pb-3">
                                        <div class="pl-5 pt-4 pb-4 banner-img">
                                            <img class="mr-2" src="{{ asset('public/panel/assets/img/banner/customers.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Pending Amount</h5>
                                            <h2 class="mb-3 font-18">PKR {{ $un_paid_amount }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">18%</span>Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-4 pt-2 pb-3">
                                        <div class="pl-5 pt-4 pb-4 banner-img">
                                            <img class="mr-2" src="{{ asset('public/panel/assets/img/banner/pending-amount.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Received Amount</h5>
                                            <h2 class="mb-3 font-18">PKR {{ $paid_amount }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">42%</span> Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-4">
                                        <div class="pt-3 pl-3 banner-img">
                                            <img src="{{ asset('public/panel/assets/img/banner/4.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Revenue chart</h4>
                            {{--<div class="card-header-action">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                        <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                            Delete</a>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary">View All</a>
                            </div>--}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div id="chart1"></div>
                                    <div class="row mb-0">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="list-inline text-center">
                                                <div class="list-inline-item p-r-30">
                                                    @if($previous_week < $current_week)
                                                        <i data-feather="arrow-up-circle" class="col-green"></i>
                                                    @else
                                                        <i data-feather="arrow-down-circle" class="col-orange"></i>
                                                    @endif
                                                    <h5 class="m-b-0">PKR {{ $current_week->sum('installment_amount') }}</h5>
                                                    <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="list-inline text-center">
                                                <div class="list-inline-item p-r-30">
                                                    @if($previous_month < $current_month)
                                                        <i data-feather="arrow-up-circle" class="col-green"></i>
                                                    @else
                                                        <i data-feather="arrow-down-circle" class="col-orange"></i>
                                                    @endif
                                                    <h5 class="m-b-0">PKR {{ $current_month->sum('installment_amount') }}</h5>
                                                    <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="list-inline text-center">
                                                <div class="list-inline-item p-r-30">
                                                    @if($previous_year < $current_year)
                                                        <i data-feather="arrow-up-circle" class="col-green"></i>
                                                    @else
                                                        <i data-feather="arrow-down-circle" class="col-orange"></i>
                                                    @endif
                                                    <h5 class="mb-0 m-b-0">PKR {{ $current_year->sum('installment_amount') }}</h5>
                                                    <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row mt-5">
                                        <div class="col-7 col-xl-7 mb-3">Total customers</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">{{ count($sales) }}</span>
                                            {{--<sup class="col-green">+09%</sup>--}}
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">Total Income</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">PKR {{ $paid_amount }}</span>
                                            {{--<sup class="text-danger">-18%</sup>--}}
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">Project completed</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big"> {{ count($sales) }}</span>
                                            {{--<sup class="col-green">+16%</sup>--}}
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">Total expense</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">PKR {{ $total_expense }}</span>
                                            {{--<sup class="col-green">+09%</sup>--}}
                                        </div>
                                        {{--<div class="col-7 col-xl-7 mb-3">New Customers</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">{{ count($sales) }}</span>
                                            --}}{{--<sup class="col-green">+22%</sup>--}}{{--
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row">
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chart</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart4" class="chartsh"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sales</h4>
                        </div>
                        <div class="card-body">
                            <div class="summary">
                                <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                                    <div id="chart3" class="chartsh"></div>
                                </div>
                                <div data-tab-group="summary-tab" id="summary-text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Expense</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart2" class="chartsh"></div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Clients</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="table-1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Property Id</th>
                                        <th>Client Name</th>
                                        <th>Client Contact Number</th>
                                        <th>Sales Person</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sales as $data)
                                        <?php
                                        // print_r($data)
                                        ?>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ($data->floor_detail !== null)? $data->floor_detail->unit_id : 'N/A'}}</td>
                                            <td>{{ $data->customer->username }}</td>
                                            <td>{{ $data->customer->phone_number }}</td>
                                            <td>{{ $data->sale_person->username }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('M d, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Data Not Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--@php
        use App\Helpers\Helpers;
        use App\Models\BuildingOfficeExpense;
        use Illuminate\Support\Arr;
        $building = (new Helpers)->building_detail();
        $office_expense = App\Models\BuildingOfficeExpense::whereIn('building_id', $building->pluck('id')->toArray())->
        selectRaw('category, SUM(cost) as amount, MONTH(created_at) as month, YEAR(created_at) as year')->groupBy('category', 'month', 'year')->get();
        $tmpArray = [];
        foreach ($office_expense as $expense) {
            $tmpArray[$expense->category][$expense->month] = $expense->amount;
        }
        $array = [];
        foreach ($tmpArray as $cat_id => $record) {
            $tmp = [];
            $tmp['category'] = !empty(BuildingOfficeExpense::where('category', '=', $cat_id)->first()) ? BuildingOfficeExpense::where('category', '=', $cat_id)->first()->category : '';
            $tmp['data'] = [];
            for ($i = 1; $i <= 12; $i++) {
                $tmp['data'][$i] = array_key_exists($i, $record) ? $record[$i] : 0;
            }
            $array[] = $tmp;
        }
    @endphp--}}
@endsection
@section('script')
    <script>
        // Main Graph
        $(document).ready(function(){
            // var time = 'time ';
            // alertify.alert("You Have a Meeting at "+time+" .");
            // $('.ajs-header').html('Reminder...');
            // $('.ajs-dialog').css('margin',1% 1% 0% auto);
        });
        function chart1() {
            var options = {
                chart: {
                    height: 230,
                    type: "line",
                    shadow: {
                        enabled: true,
                        color: "#000",
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 1
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ["#786BED", "#999b9c"],
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                    name: "Income - {{ $currentYear }}",
                    data: {{ json_encode(array_values($incomeArr)) }}
                },
                    {
                        name: "Expense - {{ $currentYear }}",
                        data: {{ json_encode(array_values($expenseArr)) }}
                    }
                ],
                grid: {
                    borderColor: "#e7e7e7",
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.0
                    }
                },
                markers: {
                    size: 6
                },
                xaxis: {
                    categories: ['January'
                        , 'February'
                        , 'March'
                        , 'April'
                        , 'May'
                        , 'June'
                        , 'July'
                        , 'August'
                        , 'September'
                        , 'October'
                        , 'November'
                        , 'December'],

                    labels: {
                        style: {
                            colors: "#9aa0ac"
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: "Income"
                    },
                    labels: {
                        style: {
                            color: "#9aa0ac"
                        }
                    },
                    min: 0,
                    max: "{{ max($incomeArr) }}"
                },
                legend: {
                    position: "top",
                    horizontalAlign: "right",
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);

            chart.render();
        }

        // Expense Graph
        /*function chart2() {
            var options = {
                chart: {
                    height: 250,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: true
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '200px',
                    },
                },
                series: [{
                    name: 'PRODUCT A',
                    data: [44, 55, 41, 67, 22, 43]
                }, {
                    name: 'PRODUCT B',
                    data: [13, 23, 20, 8, 13, 27]
                }, {
                    name: 'PRODUCT C',
                    data: [11, 17, 15, 15, 21, 14]
                }],
                xaxis: {
                    type: 'datetime',
                    categories: ['01/01/2019 GMT', '01/02/2019 GMT', '01/03/2019 GMT', '01/04/2019 GMT', '01/05/2019 GMT', '01/06/2019 GMT'],
                    labels: {
                        style: {
                            colors: "#9aa0ac"
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            color: "#9aa0ac"
                        }
                    }
                },
                legend: {
                    position: 'top',
                    offsetY: 40,
                    show: false,
                },
                fill: {
                    opacity: 1
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#chart2"),
                options
            );

            chart.render();

        }*/
    </script>

@endsection
