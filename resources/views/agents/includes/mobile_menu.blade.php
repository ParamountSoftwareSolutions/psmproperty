<div class="mobile-menu bg-white md:hidden">
    <div class="mobile-menu-bar bg-white">
        <a href="" class="flex mr-auto">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{url('dist/images/logo1.png')}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        <li>
            <a href="{{url('/agent')}}" class="side-menu  @if($activePage == 'dashboard') side-menu--active @endif">
                <div id="hover" class="side-menu__icon text-center"> <i data-feather="home" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center ">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            {{--<div id="hover" class="heading_style text-center">Properties Sections</div>--}}
            <a href="javascript:;" class="side-menu @if($activePage == 'properties') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-4"> <i data-feather="book" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center">
                    Properties
                </div>
            </a>
            <ul class="@if($activePage == 'property_index') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('agent/properties/active')}}" class="side-menu">
                        <div id="hover" class="side-menu__title text-center bg-white"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/properties/trash')}}" class="side-menu">
                        <div id="hover"  class="side-menu__title bg-white text-center"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            {{--<div id="hover" class="heading_style">Societies Sections</div>--}}
            <a href="javascript:;" class="side-menu @if($activePage == 'societies') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon text-center pt-4 "> <i data-feather="package" class="h-5 w-5 "></i> </div>
                <div id="hover"  class="side-menu__title bg-white text-center">
                    Societies
                </div>
            </a>
            <ul class="@if($activePage == 'societies_index') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('agent/societies/active')}}" class="side-menu">
                        <div id="hover" class="side-menu__title bg-white text-center"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/societies/pending')}}" class="side-menu">
                        <div id="hover" class="side-menu__title bg-white text-center"> Pending Approval </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/societies/trash')}}" class="side-menu">
                        <div id="hover" class="side-menu__title bg-white text-center"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'employees') side-menu--active side-menu--open @endif">
                <div id="hover"   class="side-menu__icon text-center pt-4"> <i data-feather="users" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center bg-white">
                    Employees
                </div>
            </a>
            <ul class="@if($activePage == 'employees') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('societyAdmin/employees')}}" class="side-menu">
                        <div id="hover" class="side-menu__title text-center bg-white"> index</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__title text-center bg-white"> Trashed </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'reports') side-menu--active side-menu--open @endif">
                <div id="hover"  class="side-menu__icon text-center pt-4"> <i data-feather="dollar-sign" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title text-center bg-white">
                    Expenses
                </div>
            </a>
            <ul class="@if($activePage == 'reports') side-menu__sub-open @endif">
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon bg-white text-center"> <i data-feather="codesandbox"  class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title text-center bg-white"> index</div>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</div>
