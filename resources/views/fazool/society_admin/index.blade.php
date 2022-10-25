@extends('society_admin.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                    <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">4</div>
                                <ul class="@if($activePage == 'society') side-menu__sub-open @endif">
                                    <li>
                                        <a href="{{url('societyAdmin/all-societies')}}" class="side-menu">
                                            <div class="text-base text-gray-600 mt-1">Societies</div>
                                        </a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">90</div>
                                <ul class="@if($activePage == 'employees') side-menu__sub-open @endif">
                                    <li>
                                        <a href="{{url('societyAdmin/employees')}}" class="side-menu" >
                                            <div class="text-base text-gray-600 mt-1">Employee</div>
                                        </a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">200</div>
                                <div class="text-base text-gray-600 mt-1">Total Plots</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{$apartmentCount}}</div>
                                <div class="text-base text-gray-600 mt-1">Apartments</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6 xl:col-span-6 bg-white">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="col-span-6 sm:col-span-6 xl:col-span-6 bg-white">
                        <canvas id="myPieChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($salesCount['months']),
                datasets: [{
                    label: 'Sales Report',
                    data: @json($salesCount['sales']),
                    backgroundColor: [
                        '#1c40aa'
                    ],
                    borderColor: [
                        '#1c40aa'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const pieCtx = document.getElementById('myPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Employee Salary', 'Office Bills'],
                datasets: [{
                    label: 'Expense Report',
                    data: [12, 19],
                    backgroundColor: [
                        'rgb(128,255,99)',
                        'rgb(0,152,253)'
                    ],
                    borderColor: [
                        'rgb(128,255,99)',
                        'rgb(0,152,253)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Expense Report'
                    }
                }
            }
        });
    </script>
@endsection
