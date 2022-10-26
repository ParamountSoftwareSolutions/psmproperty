<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('sale_person.dashboard')  }}">
                <img alt="image" src="{{ asset('public/panel/assets/img/logo.png') }}" class="header-logo" style="height:150px !important;margin-top: -20px !important;"/>
                {{--<span class="logo-name">Psm Property</span>--}}
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if (request()->routeIs('sale_person.dashboard')) active @endif">
                <a href="{{ route('sale_person.dashboard') }}" class="nav-link"><i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown @if (request()->routeIs('sale_person.sale.lead.index', 'sale_person.sale.lead.create', 'sale_person.sale.lead.edit', 'sale_person.sale.online_booking.index', 'sale_person.sale.online_booking.edit', 'sale_person.sale.client.index', 'sale_person.sale.client.create', 'sale_person.sale.client.edit', 'sale_person.sale.client.show')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="shopping-bag"></i><span>Sales</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('property_manager.sale.lead.index', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}">Leads</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.client.index', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}">Client</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.client.history', (new App\Helpers\Helpers)->user_login_route()) }}">Sale History</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.import.view', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Import</a></li>
                    <li><a class="nav-link " href="{{ route('property_manager.sale.bulk.export', (new App\Helpers\Helpers)->user_login_route()) }}">Bulk Export</a></li>
                </ul>
            </li>

        </ul>
    </aside>
</div>
