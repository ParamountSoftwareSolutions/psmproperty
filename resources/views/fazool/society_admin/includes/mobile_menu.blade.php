<div class="mobile-menu bg-white md:hidden">
    <div class="mobile-menu-bar bg-white">
        <a href="" class="flex mr-auto">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{url('dist/images/logo1.png')}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        <li>
            <a href="{{url('/societyAdmin')}}" class="side-menu @if($activePage == 'dashboard') side-menu--active @endif">
                <div id="hover" class="side-menu__icon text-center"> <i data-feather="home" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center ">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            {{--<div id="hover" class="heading_style text-center">Properties Sections</div>--}}
            <a href="javascript:;" class="side-menu @if($activePage == 'society') side-menu--active side-menu--open @endif">
            <div id="hover" class="side-menu__icon text-center pt-5 "> <i data-feather="book" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Sales
                </div>
            </a>
            <ul class="@if($activePage == 'society') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('societyAdmin/all-societies')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('societyAdmin/societies/pending')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="eye" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Pending Approval </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('societyAdmin/societies/trash')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'reports') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="feather" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Reports
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'reports') side-menu__sub-open @endif">
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Society Sales</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon "> <i data-feather="eye" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Expense Reports </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'employees') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="users" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Employees
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-4 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'employees') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('societyAdmin/employees')}}" class="side-menu" >
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> index</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="eye" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Trashed </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'reports') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-5"> <i data-feather="dollar-sign" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Expenses
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-4 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'reports') side-menu__sub-open @endif">
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> index</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</div>
