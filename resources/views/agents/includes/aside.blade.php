<nav class="side-nav ">
    <a href="" class="intro-x flex items-center pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{url('dist/images/logo11.png')}}">
        <span class="hidden xl:block text-white text-lg ml-3"> Paramount Software <span class="font-medium">Solutions</span> </span>
    </a>
{{--<div class="pt-2 pb-2"></div>--}}
    {{--<div id="hover"  class="pl-5 mt-4 mb-5">--}}
        {{--<i data-feather="briefcase" class="h-5 w-5 "></i>&nbsp;&nbsp;&nbsp;&nbsp;POS</div>--}}
    <ul>
        <li>
            <div id="hover"class="heading_style">POS</div>
            <a href="{{url('/agent')}}" class="side-menu  @if($activePage == 'dashboard') side-menu--active @endif">
                <div id="hover" class="side-menu__icon"> <i data-feather="home" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title ">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            <div id="hover" class="heading_style">Properties Sections</div>
            <a href="javascript:;" class="side-menu @if($activePage == 'properties') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon"> <i data-feather="book" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title">
                    Properties
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-5"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'property_index') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('agent/properties/active')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check"class="h-5 w-5"></i> </div>
                        <div id="hover" class="side-menu__title"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/properties/trash')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover"  class="side-menu__title"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <div id="hover" class="heading_style">Apartment Sections</div>
            <a href="javascript:;" class="side-menu @if($activePage == 'apartment') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon"> <i data-feather="flag" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title">
                    Apartments
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-5 w-5"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'apartment_index') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('agent/apartments/active')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check"class="h-5 w-5"></i> </div>
                        <div id="hover" class="side-menu__title"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/apartment/trash')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="trash" class="h-5 w-4"></i> </div>
                        <div id="hover"  class="side-menu__title"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <div id="hover" class="heading_style">Societies Sections</div>
            <a href="javascript:;" class="side-menu @if($activePage == 'societies') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon"> <i data-feather="package" class="h-5 w-5"></i> </div>
                <div id="hover"  class="side-menu__title">
                    Societies
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'societies_index') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('agent/societies/active')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="check" class="h-5 w-5"></i> </div>
                        <div id="hover" class="side-menu__title"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/societies/pending')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="eye" class="h-5 w-5"></i> </div>
                        <div id="hover" class="side-menu__title"> Pending Approval </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('agent/societies/trash')}}" class="side-menu">
                        <div id="hover"  class="side-menu__icon"> <i data-feather="trash" class="h-5 w-5"></i> </div>
                        <div id="hover" class="side-menu__title"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <div id="hover" class="heading_style">Employee Sections</div>
            <a href="javascript:;" class="side-menu @if($activePage == 'employees') side-menu--active side-menu--open @endif">
                <div id="hover"   class="side-menu__icon"> <i data-feather="users" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title">
                    Employees
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-4 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'employees') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('societyAdmin/employees')}}" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="codesandbox" class="h-4 w-4"></i> </div>
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
            <div id="hover" class="heading_style">Expensive Sections</div>
            <a href="javascript:;" class="side-menu @if($activePage == 'reports') side-menu--active side-menu--open @endif">
                <div id="hover"  class="side-menu__icon"> <i data-feather="book" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title">
                    Expenses
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"  class="h-4 w-4"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'reports') side-menu__sub-open @endif">
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="codesandbox"  class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> index</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div id="hover"  class="side-menu__icon"> <i data-feather="settings" class="h-5 w-5"></i> </div>
                <div id="hover" class="side-menu__title">
                    Settings
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"  class="h-4 w-4"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="package" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Society </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="activity"  class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Website </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
