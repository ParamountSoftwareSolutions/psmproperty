<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('property_admin.dashboard')  }}">
                <img alt="image" src="{{ asset('public/panel/assets/img/logo.png') }}" class="header-logo" style="height:150px !important;margin-top: -20px !important;"/>
                {{--<span class="logo-name">Psm Property</span>--}}
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if (request()->routeIs('property_admin.dashboard')) active @endif">
                <a href="{{ route('property_admin.dashboard') }}" class="nav-link"><i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Building Management</li>
            <li class="dropdown @if (request()->routeIs('property_admin.building.index', 'property_admin.building.create', 'property_admin.building.edit', 'property_admin.building.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="home"></i><span>Building</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_admin.building.index') }}">Building List</a></li>
                    {{--<li><a class="nav-link" href="{{ route('property_admin.building.detail_form') }}">Add Building Details</a></li>--}}
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_admin.manager.index', 'property_admin.manager.create', 'property_admin.manager.edit', 'property_admin.manager.show', 'property_admin.sale_manager.index', 'property_admin.sale_manager.create', 'property_admin.sale_manager.edit', 'property_admin.sale_manager.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="user"></i><span>Manager</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_admin.manager.index') }}">Manager List</a></li>
                    <li><a class="nav-link" href="{{ route('property_admin.sale_manager.index') }}">Sale Manager List</a></li>
                    {{--<li><a class="nav-link" href="{{ route('property_admin.building.detail_form') }}">Add Building Details</a></li>--}}
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_admin.sale.index', 'property_admin.sale.update')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="clipboard"></i><span>Sale</span></a>
<<<<<<< HEAD
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="#">Sale List</a></li>
                </ul>
            </li>
            <li class="dropdown {{--@if (request()->routeIs('property_admin.sale.index', 'property_admin.sale.update')) active @endif--}}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="clipboard"></i><span>Expense</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Expense List</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_admin.employee.index', 'property_admin.employee.update')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="users"></i><span>Employee</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="#">Employee</a></li>
=======
                    <ul class="dropdown-menu">
                        <li><a class="nav-link " href="{{ route('property_manager.sale.lead.index', (new App\Helpers\Helpers)->user_login_route()) }}">Leads</a></li>
                        <li><a class="nav-link " href="{{ route('property_manager.sale.online_booking.index', (new App\Helpers\Helpers)->user_login_route()) }}">Online Booking</a></li>
                        <li><a class="nav-link " href="{{ route('property_manager.sale.client.index', (new App\Helpers\Helpers)->user_login_route()) }}">Client</a></li>
                        <li><a class="nav-link " href="{{ route('property_manager.sale.client.history', (new App\Helpers\Helpers)->user_login_route()) }}">Sale History</a></li>
                        <li><a class="nav-link " href="{{ route('property_manager.sale.import.view', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Import</a></li>
                        <li><a class="nav-link " href="{{ route('property_manager.sale.bulk.export', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Export</a></li>
                    </ul>
            </li>
            <li class="dropdown {{--@if (request()->routeIs('property_admin.sale.index', 'property_admin.sale.update')) active @endif--}}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="clipboard"></i><span>Expense</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.office_expense.index') }}">Office Expense</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.expense.index') }}">Construction Expense</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.employee.index', 'property_manager.employee.create', 'property_manager.employee.edit', 'property_manager.employee_payroll.index', 'property_manager.employee_payroll.create', 'property_manager.employee_payroll.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-users"></i>
                    <span>HRM</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.employee.index') }}">Employee</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.employee_payroll.index') }}">Payroll</a></li>
>>>>>>> e73d3dd94bd58f71271ee38c5a091babc3d277f5
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_admin.setting.*')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="alert-circle"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_admin.setting.push_notification') }}">Push Notification</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_admin.profile.index')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="user"></i><span>Profile</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_admin.profile.index') }}">Profile</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>





















{{--
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{url('dist/images/logo.svg')}}">
        <span class="hidden xl:block text-white text-lg ml-3"> Ru<span class="font-medium">bick</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{url('/admin')}}" class="side-menu @if($activePage == 'dashboard') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'society') side-menu--active side-menu--open @endif">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    Societies
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'society') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('admin/societies/index')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="check"></i> </div>
                        <div class="side-menu__title"> Active</div>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/societies/pending')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="eye"></i> </div>
                        <div class="side-menu__title"> Pending Approval </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/societies/trash')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="trash"></i> </div>
                        <div class="side-menu__title"> Deleted </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="side-menu-light-inbox.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="side-menu__title"> Inbox </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-file-manager.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                <div class="side-menu__title"> File Manager </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-point-of-sale.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
                <div class="side-menu__title"> Point of Sale </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-chat.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="message-square"></i> </div>
                <div class="side-menu__title"> Chat </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-post.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                <div class="side-menu__title"> Post </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="calendar"></i> </div>
                <div class="side-menu__title"> Calendar </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
                <div class="side-menu__title">
                    Status Settings
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{url('admin/status/user')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> User Status </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/status/society')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Society Status </div>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/status/employee')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Employee Status </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/status/agent')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Agent Status </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{url('admin/noc')}}" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    Society NOCs
                </div>
            </a>
        </li>
        <li>
            <a href="{{url('admin/society/category')}}" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    Society Categories
                </div>
            </a>
        </li>

        <li>
            <a href="{{url('admin/sector')}}" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
                <div class="side-menu__title">
                    Sectors
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu @if($activePage == 'location') side-menu--active side-menu--open @endif">
                <div class="side-menu__icon"> <i data-feather="layout"></i> </div>
                <div class="side-menu__title">
                    Locations
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="@if($activePage == 'location') side-menu__sub-open @endif">
                <li>
                    <a href="{{url('admin/location/province')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title">
                            Province
                            <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/location/city')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title">
                            City
                            <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="side-menu__title">
                    Components
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title">
                            Table
                            <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-regular-table.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Regular Table</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-tabulator.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Tabulator</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title">
                            Overlay
                            <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="side-menu-light-modal.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Modal</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-slide-over.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Slide Over</div>
                            </a>
                        </li>
                        <li>
                            <a href="side-menu-light-notification.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Notification</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="side-menu-light-accordion.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Accordion </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-button.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Button </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-alert.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Alert </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-progress-bar.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Progress Bar </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-tooltip.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Tooltip </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-dropdown.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Dropdown </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-typography.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Typography </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-icon.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Icon </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-loading-icon.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Loading Icon </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="sidebar"></i> </div>
                <div class="side-menu__title">
                    Forms
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-regular-form.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Regular Form </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-datepicker.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Datepicker </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-tom-select.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Tom Select </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-file-upload.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> File Upload </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-wysiwyg-editor.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Wysiwyg Editor </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-validation.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Validation </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                <div class="side-menu__title">
                    Widgets
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-light-chart.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Chart </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-slider.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Slider </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-image-zoom.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Image Zoom </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
--}}
