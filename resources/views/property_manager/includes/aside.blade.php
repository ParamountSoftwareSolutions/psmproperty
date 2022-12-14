<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('property_manager.dashboard')  }}">
                <img alt="image" src="{{ asset('public/panel/assets/img/logo.png') }}" class="header-logo" style="height:150px !important;margin-top: -20px !important;"/>
                {{--<span class="logo-name">Psm Property</span>--}}
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if (request()->routeIs('property_manager.dashboard')) active @endif">
                <a href="{{ route('property_manager.dashboard') }}" class="nav-link"><i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if((new App\Helpers\Helpers)->building_detail()->count() > 1)
            <li class="dropdown @if (request()->routeIs('property_manager.custom_building.dashboard')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="home"></i><span>Building Dashboard</span></a>
                <ul class="dropdown-menu">
                    @foreach((new App\Helpers\Helpers)->building_detail() as $data)
                        <li><a class="nav-link" href="{{ route('property_manager.custom_building.dashboard', $data->id) }}">{{ $data->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endif

            <li class="menu-header">Building Management</li>
            <li class="dropdown @if (request()->routeIs('property_manager.building.index', 'property_manager.building.create', 'property_manager.building.edit', 'property_manager.building.show', 'property_manager.building_details.index', 'property_manager.building_details.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="home"></i><span>Building</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.building.index') }}">All Building</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.building_details.index') }}">All Building Extra Detail</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.property.index', 'property_manager.property.create', 'property_manager.property.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="home"></i><span>Property</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.property.index') }}">Property</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.membership.index', 'property_manager.membership.create', 'property_manager.membership.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="home"></i><span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.membership.index') }}">Membership Form</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.payment_plan.index', 'property_manager.payment_plan.create', 'property_manager.payment_plan.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="image"></i><span>Payment Plan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.payment_plan.index') }}">Payment Plan</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.banner.index', 'property_manager.banner.update')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="image"></i><span>Banner</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.banner.index') }}">Banner List</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.expense.index', 'property_manager.expense.edit', 'property_manager.expense.create', 'property_manager.office_expense.index', 'property_manager.office_expense.create', 'property_manager.office_expense.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="book"></i><span>Expense</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.office_expense.index') }}">Office Expense</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.expense.index') }}">Construction Expense</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.employee.index', 'property_manager.employee.create', 'property_manager.employee.edit', 'property_manager.employee_payroll.index', 'property_manager.employee_payroll.create', 'property_manager.employee_payroll.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="users"></i><span>HRM</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.employee.index') }}">Employee</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.employee_payroll.index') }}">Payroll</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.request.index', 'property_manager.request.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="mail"></i><span>Request</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.request.index', ['type' => 'possession']) }}">Possession</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.request.index', ['type' => 'transfer']) }}">Transfer</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.request.index', ['type' => 'file']) }}">File</a></li>
                </ul>
            </li>
            {{--@dd((new App\Helpers\Helpers)->user_login_route())--}}
            <li class="dropdown @if (request()->routeIs('property_manager.sale.lead.index', 'property_manager.sale.lead.create', 'property_manager.sale.lead.edit', 'property_manager.sale.online_booking.index', 'property_manager.sale.online_booking.edit', 'property_manager.sale.client.index', 'property_manager.sale.client.create', 'property_manager.sale.client.edit', 'property_manager.sale.client.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="shopping-bag"></i><span>Sales</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.sale.lead.index', (new App\Helpers\Helpers)->user_login_route()) }}">Leads</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.online_booking.index', (new App\Helpers\Helpers)->user_login_route()) }}">Online
                            Booking</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.client.index', (new App\Helpers\Helpers)->user_login_route()) }}">Client</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.client.history', (new App\Helpers\Helpers)->user_login_route()) }}">Sale History</a>
                    </li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.import.view', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Import</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.bulk.export', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Export</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.webhook.index')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="shopping-bag"></i><span>WebHook</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.webhook.index') }}">webhook</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.custom_notification.index', 'property_manager.custom_notification.create', 'property_manager.custom_notification.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="shopping-bag"></i><span>Custom Notification</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.custom_notification.index') }}">Notification List</a></li>
                </ul>
            </li>
            {{--  <li class="dropdown @if (request()->routeIs('property_manager.property_admin.index', 'property_admin.profile.update')) active @endif">
                  <a href="#" class="menu-toggle nav-link has-dropdown">
                      <i data-feather="user"></i><span>Profile</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link " href="{{ route('property_manager.profile.index') }}">Profile</a></li>
                  </ul>
              </li>--}}
            <li class="dropdown @if (request()->routeIs('property_manager.report.sale', 'property_manager.report.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="alert-circle"></i><span>Accounts</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Sales Report</a></li>
                    <li><a class="nav-link" href="{{ route('property_manager.report.expense_report') }}">Expenses Report</a></li>
                    <li><a class="nav-link" href="">Employee</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.update.index', 'property_manager.update.create', 'property_manager.update.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="alert-circle"></i><span>News</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('property_manager.update.index') }}">Building Update</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('property_manager.about.index', 'property_manager.about.edit', 'property_manager.privacyPolicy.index', 'property_manager.privacyPolicy.edit', 'property_manager.term.index', 'property_manager.term.edit', 'property_manager.faq.index', 'property_manager.faq.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="clipboard"></i><span>More</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.about.index') }}">About</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.privacyPolicy.index') }}">Privacy & Policy</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.term.index') }}">Term & Condition</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.faq.index') }}">Faqs</a></li>
                </ul>
            </li>

        </ul>
    </aside>
</div>
