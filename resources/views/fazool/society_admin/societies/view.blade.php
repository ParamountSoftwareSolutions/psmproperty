@extends('society_admin.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">

            <?php
                $plotCount = 0;
                if($plots != null){
                    $plotArray = json_decode($plots);
                    $plotData = json_decode($plotArray->data_array);
                    foreach ($plotData as $pData){
                        //calc data
                        if(isset($pData->Residential)){
                            $plotCount += $pData->Residential;
                        }
                    }
                }

            ?>
            <div class="grid grid-cols-12 gap-6">
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
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$plotCount}}</div>
                                    <div class="text-base text-gray-600 mt-1">Total Files/Plots</div>
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
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$employees}}</div>
                                    <div class="text-base text-gray-600 mt-1">Employees</div>
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
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$sales}}</div>
                                    <div class="text-base text-gray-600 mt-1">Sold Files/Plots</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$count_apartment}}</div>
                                    <div class="text-base text-gray-600 mt-1">Apartments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 mt-8">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Sales Report
                </h2>
                <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                    <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                    <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                </div>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5">
                <div class="report-chart">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-6 lg:col-span-6 mt-8">
            <canvas id="myPieChart" width="400" height="400"></canvas>
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
