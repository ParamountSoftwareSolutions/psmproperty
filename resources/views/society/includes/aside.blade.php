<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{url('dist/images/logo11.png')}}">
        <span class="hidden xl:block text-lg ml-3 font-bold "> Paramount Software <span class="font-medium font-bold">Solutions</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{url('/society')}}" class="side-menu @if($activePage == 'dashboard') side-menu--active @endif">
                <div id="hover" class="side-menu__icon"><i data-feather="home" class="h-5 w-4"></i></div>
                <div id="hover" class="side-menu__title">
                    Dashboard
                </div>
            </a>
        </li>

        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Sales', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'possessions') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="book" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Receive
                        <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                    </div>
                </a>
                <ul class="@if($activePage == 'possessions') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/possessions')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Possession</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/possessions/transfer')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Transfer</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Sales', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'accounts') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="dollar-sign" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Accounts
                        <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                    </div>
                </a>
                <ul class="@if($activePage == 'accounts') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/accounts')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Accounts</div>
                        </a>
                    </li>
                    {{--<li>--}}
                    {{--<a href="{{url('society/projects/views')}}" class="side-menu">--}}
                    {{--<div id="hover" class="side-menu__icon"> <i data-feather="eye" class="h-5 w-4"></i> </div>--}}
                    {{--<div  id="hover"class="side-menu__title"> View Projects </div>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
        @endif



        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Sales', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'projects') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="loader" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Projects
                        <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                    </div>
                </a>
                <ul class="@if($activePage == 'projects') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/projects')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Add Projects</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/projects/views')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> View Projects</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Sales', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'expense') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="loader" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Expense
                        <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                    </div>
                </a>
                <ul class="@if($activePage == 'expense') side-menu__sub-open @endif">
                    <li>
                        <a href="{{ route('expense.create') }}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Add Today Expense</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('expense.index') }}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> View All Expense List</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Sales', 'can_view'))
            <li>
                <a href="javascript:;" class="side-menu @if($activePage == 'slider') side-menu__sub-open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="loader" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Sliders
                        <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                    </div>
                </a>
                <ul class=side-menu__sub-open">
                    <li>
                        <a href="{{ route('slider.index') }}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> All Sliders List</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('slider.create') }}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Add Slider</div>
                        </a>
                    </li>

                </ul>
            </li>
        @endif

        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Sales', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'sales') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="dollar-sign" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Sales
                        <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                    </div>
                </a>
                <ul class="@if($activePage == 'sales') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/sales')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Index</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/societies/pending')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Installments</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/societies/trash')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="trash" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Sold out</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
            <a href="javascript:;"
               class="side-menu @if($activePage == 'leads') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon"><i data-feather="book-open" class="h-5 w-4"></i></div>
                <div id="hover" class="side-menu__title">
                    Leads
                    <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                </div>
            </a>
            <ul class="@if($activePage == 'leads') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('society/leads')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> All Leads</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/leads/mature')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Mature Leads (Clients)</div>
                    </a>
                </li>
            </ul>

        </li>

        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Employee', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'employee') side-menu--active side-menu--open @endif">
                    <div id="hover" class=" side-menu__icon"><i data-feather="briefcase" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Employee
                        <div id="hover" class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i>
                        </div>
                    </div>
                </a>
                <ul class="@if($activePage == 'employee') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/employee')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Index</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/employee/trash')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="trash" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Deleted</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Hrm', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'hrm') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="monitor" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        HRM
                        <div id="hover" class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i>
                        </div>
                    </div>
                </a>
                <ul class="@if($activePage == 'hrm') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/hrm')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Index</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/hrm/attendance')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="trash" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Attendance</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/hrm/payroll')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="trash" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Payroll</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if(\App\Helpers\Permission::hasPermission(\Illuminate\Support\Facades\Auth::user(), 'Agent', 'can_view'))
            <li>
                <a href="javascript:;"
                   class="side-menu @if($activePage == 'agents') side-menu--active side-menu--open @endif">
                    <div id="hover" class="side-menu__icon"><i data-feather="folder-plus" class="h-5 w-4"></i></div>
                    <div id="hover" class="side-menu__title">
                        Agent
                        <div id="hover" class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-4 w-5"></i>
                        </div>
                    </div>
                </a>
                <ul class="@if($activePage == 'hrm') side-menu__sub-open @endif">
                    <li>
                        <a href="{{url('society/agent/active')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="check" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Active</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('society/agent/removed')}}" class="side-menu">
                            <div id="hover" class="side-menu__icon"><i data-feather="trash" class="h-5 w-4"></i></div>
                            <div id="hover" class="side-menu__title"> Removed</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'pages') side-menu__sub-open @endif">
                <div id="hover" class="side-menu__icon"><i data-feather="loader" class="h-5 w-4"></i></div>
                <div id="hover" class="side-menu__title">
                    Pages
                    <div class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i></div>
                </div>
            </a>
            <ul class=side-menu__sub-open">
                <li>
                    <a href="{{ route('about.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> About</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('term.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Term & Condition</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('privacyPolicy.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Privacy & Policy</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Faq's</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq.create') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="eye" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Create Faq's</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div id="hover" class="side-menu__icon"><i data-feather="settings" class="h-5 w-5"></i></div>
                <div id="hover" class="side-menu__title">
                    Settings
                    <div id="hover" class="side-menu__sub-icon "><i data-feather="chevron-down" class="h-5 w-4"></i>
                    </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="activity" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Data List</div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-crud-form.html" class="side-menu">
                        <div id="hover" class="side-menu__icon"><i data-feather="activity" class="h-5 w-4"></i></div>
                        <div id="hover" class="side-menu__title"> Form</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
