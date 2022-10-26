<div class="mobile-menu bg-white md:hidden">
    <div class="mobile-menu-bar bg-white">
        <a href="" class="flex mr-auto">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{url('dist/images/logo1.png')}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        <li>
            <a href="{{url('/society')}}" class="side-menu pb-3 @if($activePage == 'dashboard') side-menu--active @endif">
                <div id="hover" class="side-menu__icon text-center"> <i data-feather="home" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center ">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            {{--<div id="hover" class="heading_style text-center">Properties Sections</div>--}}
            <a href="javascript:;" class="side-menu    @if($activePage == 'sales') side-menu--active side-menu--open  @endif">
                <div id="hover" class="side-menu__icon text-center pt-5 "> <i data-feather="book" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Sales
                </div>
            </a>
            <ul class="@if($activePage == 'sales') side-menu__sub-open text-center bg-white @endif">
                <li>
                    <a href="{{url('society/sales')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Index</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/societies/pending')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="eye" class="h-5 w-4"></i> </div>
                        <div  id="hover"class="side-menu__title"> Installments </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/societies/trash')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Sold out </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'leads') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="book-open" class="h-5 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Leads
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'leads') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('society/leads')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div  id="hover" class="side-menu__title"> All Leads</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/leads/mature')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Mature Leads (Clients) </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'slider') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="book-open" class="h-5 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Leads
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'slider') side-menu__sub-open @endif">
                <li>
                    <a href="{{ route('slider.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div  id="hover" class="side-menu__title"> All Sliders</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('slider.create') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Add New Slider </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'employee') side-menu--active side-menu--open @endif">
                <div id="hover" class=" side-menu__icon text-center pt-5"> <i data-feather="briefcase" class="h-5 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Employee
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'employee') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('society/employee')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Index</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/employee/trash')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'hrm') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="monitor" class="h-5 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    HRM
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'hrm') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('society/hrm')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Index</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/hrm/attendance')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Attendance </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/hrm/payroll')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Payroll </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'pages') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="monitor" class="h-5 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Pages
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'pages') side-menu__sub-open @endif">
                <li>
                    <a href="{{ route('about.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> About</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('term.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Terms & Condition</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('privacyPolicy.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Privacy Policy</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq.index') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Faq</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq.create') }}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Create Faq</div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'agents') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="folder-plus" class="h-5 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Agent
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-4 w-5"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'hrm') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('society/agent/active')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('society/agent/removed')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Removed </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</div>
