<li class="menu-header">Main</li>
<li class="dropdown @if (request()->routeIs('sale_manager.dashboard')) active @endif">
    <a href="{{ route('sale_manager.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="dropdown @if (request()->routeIs('sale_manager.employee.index', 'sale_manager.employee.create', 'sale_manager.employee.edit')) active @endif">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fa-solid fa-user"></i><span>Sales Person</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('sale_manager.employee.index') }}">Employee</a></li>
    </ul>
</li>
