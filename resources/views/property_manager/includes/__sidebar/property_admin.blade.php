<li class="menu-header">Main</li>
<li class="dropdown @if (request()->routeIs('property_admin.dashboard')) active @endif">
    <a href="{{ route('property_admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-tv"></i>
        <span>Dashboard</span>
    </a>
</li>
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
        <i class="fa-sharp fa-solid fa-house-chimney"></i><span>Property Data</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link " href="{{ route('admin.property_admin.index') }}">Property Admin</a></li>
    </ul>
</li>
<li class="menu-header">Project Management</li>
<li class="dropdown @if (request()->routeIs('property_admin.building.index', 'property_admin.building.create', 'property_admin.building.edit', 'property_admin.building.show')) active @endif">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fa-sharp fa-solid fa-building-columns"></i><span>Building</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('property_admin.building.index') }}">Project List</a></li>
        {{--<li><a class="nav-link" href="{{ route('property_admin.building.detail_form') }}">Add Project Details</a></li>--}}
    </ul>
</li>
<li class="dropdown @if (request()->routeIs('property_admin.manager.index', 'property_admin.manager.create', 'property_admin.manager.edit', 'property_admin.manager.show', 'property_admin.sale_manager.index', 'property_admin.sale_manager.create', 'property_admin.sale_manager.edit', 'property_admin.sale_manager.show')) active @endif">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fa-solid fa-user"></i><span>Manager</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('property_admin.manager.index') }}">Manager List</a></li>
        <li><a class="nav-link" href="{{ route('property_admin.sale_manager.index') }}">Sale Manager List</a></li>
        {{--<li><a class="nav-link" href="{{ route('property_admin.building.detail_form') }}">Add Project Details</a></li>--}}
    </ul>
</li>
<li class="dropdown @if (request()->routeIs('property_manager.expense.index', 'property_manager.expense.edit', 'property_manager.expense.create', 'property_manager.office_expense.index', 'property_manager.office_expense.create', 'property_manager.office_expense.edit')) active @endif">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fa-sharp fa-solid fa-sack-dollar"></i>
        <span>Expense</span></a>
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
    </ul>
</li>
<li class="dropdown @if (request()->routeIs('property_admin.setting.*')) active @endif">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fa-solid fa-gear"></i><span>Settings</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('property_admin.setting.push_notification') }}">Push Notification</a></li>
    </ul>
</li>
<li class="dropdown @if (request()->routeIs('property_admin.profile.index')) active @endif">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fa-solid fa-user"></i><span>Profile</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link " href="{{ route('property_admin.profile.index') }}">Profile</a></li>
    </ul>
</li>
