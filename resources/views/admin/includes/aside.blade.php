
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('property_manager.dashboard')  }}">
                <img alt="image" src="{{ asset('public/panel/assets/img/logo.png') }}" class="header-logo" style="height:150px !important;margin-top: -20px !important;"/>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            @if(Helpers::isPropertyManager())
                <li class="dropdown @if (request()->routeIs('property_manager.dashboard')) active @endif">
                    <a href="{{ route('property_manager.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            @elseif(Helpers::isPropertyAdmin())
                <li class="dropdown @if (request()->routeIs('property_admin.dashboard')) active @endif">
                    <a href="{{ route('property_admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            @elseif(Helpers::isEmployee())
            <li class="dropdown @if (request()->routeIs('sale_person.dashboard')) active @endif">
                <a href="{{ route('sale_person.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @elseif(Helpers::isSaleManager())
            <li class="dropdown @if (request()->routeIs('sale_manager.dashboard')) active @endif">
                <a href="{{ route('sale_manager.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @elseif(Helpers::isSuperAdmin())
                <li class="dropdown @if (request()->routeIs('admin.dashboard')) active @endif">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i><span>Dashboard</span></a>
                </li>
            @endif
            @if(Helpers::isPropertyManager() && (new App\Helpers\Helpers)->building_detail()->count() > 1)
            <li class="dropdown @if (request()->routeIs('property_manager.custom_building.dashboard')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-sharp fa-solid fa-building-columns"></i><span>Building Dashboard</span></a>
                <ul class="dropdown-menu">
                    @foreach((new App\Helpers\Helpers)->building_detail() as $data)
                        <li><a class="nav-link" href="{{ route('property_manager.custom_building.dashboard', $data->id) }}">{{ $data->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endif
            @if(Helpers::isSuperAdmin())
            <li class="menu-header">User Management</li>
            <li class="dropdown @if (request()->routeIs('admin.society_admin.index', 'admin.society_admin.create', 'admin.society_admin.edit', 'admin.society_admin.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-users"></i><span>Society Data</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('admin.society_admin.index') }}">Society Admin</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('admin.property_admin.index', 'admin.property_admin.create', 'admin.property_admin.edit', 'admin.property_admin.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-sharp fa-solid fa-house-chimney"></i></i><span>Property Data</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('admin.property_admin.index') }}">Property Admin</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isSaleManager())
            <li class="dropdown @if (request()->routeIs('sale_manager.employee.index', 'sale_manager.employee.create', 'sale_manager.employee.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-user"></i></i><span>Sales Person</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('sale_manager.employee.index') }}">Employee</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="menu-header">Building Management</li>
            <li class="dropdown @if (request()->routeIs('property_manager.building.index', 'property_manager.building.create', 'property_manager.building.edit', 'property_manager.building.show', 'property_manager.building_details.index', 'property_manager.building_details.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-sharp fa-solid fa-building-columns"></i>
                    <span>Building</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.building.index') }}">All Building</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.building_details.index') }}">All Building Extra Detail</a></li>
                </ul>
            </li>
            @elseif(Helpers::isPropertyAdmin())
            <li class="menu-header">Building Management</li>
            <li class="dropdown @if (request()->routeIs('property_admin.building.index', 'property_admin.building.create', 'property_admin.building.edit', 'property_admin.building.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-sharp fa-solid fa-building-columns"></i><span>Building</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_admin.building.index') }}">Building List</a></li>
                    {{--<li><a class="nav-link" href="{{ route('property_admin.building.detail_form') }}">Add Building Details</a></li>--}}
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyAdmin())
            <li class="dropdown @if (request()->routeIs('property_admin.manager.index', 'property_admin.manager.create', 'property_admin.manager.edit', 'property_admin.manager.show', 'property_admin.sale_manager.index', 'property_admin.sale_manager.create', 'property_admin.sale_manager.edit', 'property_admin.sale_manager.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-user"></i><span>Manager</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_admin.manager.index') }}">Manager List</a></li>
                    <li><a class="nav-link" href="{{ route('property_admin.sale_manager.index') }}">Sale Manager List</a></li>
                    {{--<li><a class="nav-link" href="{{ route('property_admin.building.detail_form') }}">Add Building Details</a></li>--}}
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.property.index', 'property_manager.property.create', 'property_manager.property.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-sharp fa-solid fa-house-chimney"></i>
                    <span>Property</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.property.index') }}">Property</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.membership.index', 'property_manager.membership.create', 'property_manager.membership.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.membership.index') }}">Membership Form</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.payment_plan.index', 'property_manager.payment_plan.create', 'property_manager.payment_plan.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Payment Plan</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.payment_plan.index') }}">Payment Plan</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.banner.index', 'property_manager.banner.update')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-image"></i>
                    <span>Banner</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.banner.index') }}">Banner List</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager() || Helpers::isPropertyAdmin())
            <li class="dropdown @if (request()->routeIs('property_manager.expense.index', 'property_manager.expense.edit', 'property_manager.expense.create', 'property_manager.office_expense.index', 'property_manager.office_expense.create', 'property_manager.office_expense.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-sharp fa-solid fa-sack-dollar"></i>
                    <span>Expense</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.office_expense.index') }}">Office Expense</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.expense.index') }}">Construction Expense</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager() || Helpers::isPropertyAdmin())
            <li class="dropdown @if (request()->routeIs('property_manager.employee.index', 'property_manager.employee.create', 'property_manager.employee.edit', 'property_manager.employee_payroll.index', 'property_manager.employee_payroll.create', 'property_manager.employee_payroll.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-users"></i>
                    <span>HRM</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.employee.index') }}">Employee</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.employee_payroll.index') }}">Payroll</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.request.index', 'property_manager.request.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-regular fa-envelope"></i><span>Request</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.request.index', ['type' => 'possession']) }}">Possession</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.request.index', ['type' => 'transfer']) }}">Transfer</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.request.index', ['type' => 'file']) }}">File</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager() || Helpers::isPropertyAdmin() || Helpers::isSaleManager() || Helpers::isSaleManager() || Helpers::isEmployee())
            <li class="dropdown @if (request()->routeIs('property_manager.sale.lead.index', 'property_manager.sale.lead.create', 'property_manager.sale.lead.edit', 'property_manager.sale.online_booking.index', 'property_manager.sale.online_booking.edit', 'property_manager.sale.client.index', 'property_manager.sale.client.create', 'property_manager.sale.client.edit', 'property_manager.sale.client.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="far fa-handshake"></i>
                    <span>Sales</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.sale.lead.index', (new App\Helpers\Helpers)->user_login_route()) }}">Leads</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.online_booking.index', (new App\Helpers\Helpers)->user_login_route()) }}">Online Booking</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.client.index', (new App\Helpers\Helpers)->user_login_route()) }}">Client</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.client.history', (new App\Helpers\Helpers)->user_login_route()) }}">Sale History</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.import.view', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Import</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.bulk.export', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Export</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.custom_notification.index', 'property_manager.custom_notification.create', 'property_manager.custom_notification.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-regular fa-bell"></i>
                    <span>Custom Notification</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.custom_notification.index') }}">Notification List</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyAdmin())
            <li class="dropdown @if (request()->routeIs('property_admin.setting.*')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="alert-circle"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_admin.setting.push_notification') }}">Push Notification</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyAdmin())
            <li class="dropdown @if (request()->routeIs('property_admin.profile.index')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-user"></i><span>Profile</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_admin.profile.index') }}">Profile</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.report.sale', 'property_manager.report.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-user"></i>
                    <span>Accounts</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Sales Report</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.report.expense_report') }}">Expenses Report</a></li>
                    <li><a class="nav-link" href="">Employee</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.update.index', 'property_manager.update.create', 'property_manager.update.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>News</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.update.index') }}">Building Update</a></li>
                </ul>
            </li>
            @endif
            @if(Helpers::isPropertyManager())
            <li class="dropdown @if (request()->routeIs('property_manager.about.index', 'property_manager.about.edit', 'property_manager.privacyPolicy.index', 'property_manager.privacyPolicy.edit', 'property_manager.term.index', 'property_manager.term.edit', 'property_manager.faq.index', 'property_manager.faq.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-caret-right"></i>
                    <span>More</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.about.index') }}">About</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.privacyPolicy.index') }}">Privacy & Policy</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.term.index') }}">Term & Condition</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.faq.index') }}">Faqs</a></li>
                </ul>
            </li>
            @endif

        </ul>
    </aside>
</div>
