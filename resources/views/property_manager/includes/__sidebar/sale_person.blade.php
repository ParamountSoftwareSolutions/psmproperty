<li class="menu-header">Main</li>
<li class="dropdown @if (request()->routeIs('sale_person.dashboard')) active @endif">
    <a href="{{ route('sale_person.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
        <span>Dashboard</span>
    </a>
</li>
