@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5 text-danger">
                        General Report
                    </h2>
                    <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10 text-danger"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3 text-danger"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="codesandbox" class="report-box__icon text-theme-10 text-danger"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">4</div>
                                <div class="text-base text-gray-600 mt-1">Societies</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">90</div>
                                <div class="text-base text-gray-600 mt-1">Employees</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="database" class="report-box__icon text-theme-12 text-danger"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
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
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                                <div class="text-base text-gray-600 mt-1">Unique Visitor</div>
                            </div>
                        </div>
                    </div>

                        {{--<canvas id="myChart" width="400" height="400"></canvas>--}}
                    {{--</div>--}}
                    {{--<div class="col-span-6 sm:col-span-6 xl:col-span-6 bg-white">--}}
                        {{--<canvas id="myPieChart" width="400" height="400"></canvas>--}}

                {{--</div>--}}
                    {{--<div class="col-span-6 sm:col-span-6 xl:col-span-6 bg-white">--}}
                <!-- BEGIN: Sales Report -->
                    <div class="col-span-12 lg:col-span-6 mt-8 bg-white">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate ml-5 mt-1 text-danger">
                                Sales Report
                            </h2>
                            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                                <i data-feather="calendar" class="w-4 h-4 z-10 text-danger absolute my-auto inset-y-0  ml-3 left-0"></i>
                                <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                            </div>
                        </div>
                        <div class="intro-y box p-5 mt-12 sm:mt-5">
                            <div class="flex flex-col xl:flex-row xl:items-center">
                                <div class="flex">
                                    <div>
                                        <div class="text-theme-19 dark:text-gray-300 text-lg xl:text-xl font-medium text-danger">15,000</div>
                                        <div class="mt-0.5 text-gray-600 dark:text-gray-600">This Month</div>
                                    </div>
                                    <div class="w-px h-12 border border-r border-dashed border-gray-300 dark:border-dark-5 mx-4 xl:mx-5"></div>
                                    <div>
                                        <div class="text-gray-600 dark:text-gray-600 text-lg xl:text-xl font-medium text-danger">10,000</div>
                                        <div class="mt-0.5 text-gray-600 dark:text-gray-600">Last Month</div>
                                    </div>
                                </div>
                                <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                                    <button class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false"> Filter by Category <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> </button>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2 overflow-y-auto h-32"> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">PC & Laptop</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Smartphone</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Electronic</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Photography</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Sport</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-chart">
                                <canvas id="report-line-chart" height="169" class="mt-6"></canvas>

                            </div>
                        </div>
                    </div>
                    <!-- END: Sales Report -->
                    <!-- BEGIN: Weekly Top Seller -->
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8 bg-white">
                        <div class="intro-y flex items-center h-10">
                            <h4 class="text-lg font-medium truncate ml-3 mt-1 text-danger">
                                Weekly Top Seller
                            </h4>
                            <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate mr-3 mt-1">Show More</a>
                        </div>
                        <div class="intro-y box p-5 mt-5">
                            <canvas class="mt-3" id="report-pie-chart" height="300"></canvas>
                            <div class="mt-8">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                    <span class="truncate">17 - 30 Years old</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">62%</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                                    <span class="truncate">31 - 50 Years old</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">33%</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                    <span class="truncate">>= 50 Years old</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Weekly Top Seller -->
                    <!-- BEGIN: Sales Report -->
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8 bg-white">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate ml-4  mt-1 text-danger">
                                Sales Report
                            </h2>
                            <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate mr-3 mt-1">Show More</a>
                        </div>
                        <div class="intro-y box p-5 mt-5">
                            <canvas class="mt-3" id="report-donut-chart" height="300"></canvas>
                            <div class="mt-8">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                    <span class="truncate">17 - 30 Years old</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">62%</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                                    <span class="truncate">31 - 50 Years old</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">33%</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                    <span class="truncate">>= 50 Years old</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Sales Report -->


                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        {{--/*const myChart = new Chart(ctx, {--}}
            {{--type: 'line',--}}
            {{--data: {--}}
                {{--labels: --}}{{--@json($salesCount['months'])--}}{{--,--}}
                {{--datasets: [{--}}
                    {{--label: 'Sales Report',--}}
                    {{--data: --}}{{--@json($salesCount['sales'])--}}{{--,--}}
                    {{--backgroundColor: [--}}
                        {{--'#1c40aa'--}}
                    {{--],--}}
                    {{--borderColor: [--}}
                        {{--'#1c40aa'--}}
                    {{--],--}}
                    {{--borderWidth: 1--}}
                {{--}]--}}
            {{--},--}}
            {{--options: {--}}
                {{--scales: {--}}
                    {{--y: {--}}
                        {{--beginAtZero: true--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}


        {{--const pieCtx = document.getElementById('myPieChart').getContext('2d');--}}
        {{--new Chart(pieCtx, {--}}
            {{--type: 'pie',--}}
            {{--data: {--}}
                {{--labels: ['Employee Salary', 'Office Bills'],--}}
                {{--datasets: [{--}}
                    {{--label: 'Expense Report',--}}
                    {{--data: [12, 19],--}}
                    {{--backgroundColor: [--}}
                        {{--'rgb(128,255,99)',--}}
                        {{--'rgb(0,152,253)'--}}
                    {{--],--}}
                    {{--borderColor: [--}}
                        {{--'rgb(128,255,99)',--}}
                        {{--'rgb(0,152,253)',--}}
                    {{--],--}}
                    {{--borderWidth: 1--}}
                {{--}]--}}
            {{--},--}}
            {{--options: {--}}
                {{--responsive: true,--}}
                {{--plugins: {--}}
                    {{--legend: {--}}
                        {{--position: 'top',--}}
                    {{--},--}}
                    {{--title: {--}}
                        {{--display: true,--}}
                        {{--text: 'Expense Report'--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--});*/--}}
    </script>
@endsection
