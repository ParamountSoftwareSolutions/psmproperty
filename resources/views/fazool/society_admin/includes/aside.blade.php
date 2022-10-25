<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Paramount HTML Admin" class="w-6" src="{{url('dist/images/logo11.png')}}">
        <span class="hidden xl:block font-bold text-lg ml-3"> Property &nbsp;<span class="font-bold font-medium">Manager</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{url('/societyAdmin')}}" class="side-menu @if($activePage == 'dashboard') side-menu--active @endif">
                <div id="hover" class="side-menu__icon"> <i data-feather="home" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title">
                    Dashboard
                </div>
            </a>
        </li>
        <a href="{{url('/societyAdmin/receipt')}}" class="side-menu @if($activePage == 'receipt') side-menu--active @endif">
            <div id="hover" class="side-menu__icon"> <i data-feather="credit-card" class="h-4 w-4"></i> </div>
            <div id="hover" class="side-menu__title">
                Receipt
            </div>
        </a>
        </li>

        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'society') side-menu--active side-menu--open @endif">
                <div  id="hover" class="side-menu__icon"> <i data-feather="codesandbox" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title">
                    Societies
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-4 w-4"></i> </div>
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
                <div id="hover" class="side-menu__icon"> <i data-feather="feather" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title">
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
                        <div id="hover" class="side-menu__icon"> <i data-feather="eye" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Expense Reports </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'employees') side-menu--active side-menu--open @endif">
                <div id="hover" class="side-menu__icon"> <i data-feather="users" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title">
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
                <div id="hover" class="side-menu__icon"> <i data-feather="dollar-sign" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title">
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

        <li class="side-nav__devider my-6"></li>

        <li>
            <a href="javascript:;" class="side-menu">
                <div id="hover" class="side-menu__icon"> <i data-feather="edit" class="h-4 w-4"></i> </div>
                <div id="hover" class="side-menu__title">
                    Settings
                    <div id="hover" class="side-menu__sub-icon "> <i data-feather="chevron-down" class="h-4 w-4"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="activity" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Society </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div id="hover" class="side-menu__icon"> <i data-feather="activity" class="h-4 w-4"></i> </div>
                        <div id="hover" class="side-menu__title"> Website </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
