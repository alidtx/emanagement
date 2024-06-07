<ul class="menu-inner py-1">
    <!-- Dashboards -->
    @if (Auth::user()->hasAnyPermission(['dashboard.view']))
        <li class="menu-item {{ Route::is('home') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
            @can('dashboard.view')
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="menu-link">
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                </ul>
            @endcan
        </li>
    @endif
    @if (Auth::user()->hasAnyPermission(['User-view']))
        <li class="menu-item {{ Route::is('users.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                @can('User-view')
                    <li class="menu-item {{ Route::is('users.*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="menu-link">
                            <div data-i18n="List">List</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif

    @if (Auth::user()->hasAnyPermission(['role-list']))
        <li class="menu-item {{ Route::is('roles.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            @can('role-list')
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('roles.*') ? 'active ' : '' }}">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <div data-i18n="Roles">Roles</div>
                        </a>
                    </li>
                </ul>
            @endcan
        </li>
    @endif

    @if (Auth::user()->hasAnyPermission(['employees.list']))
    <li class="menu-item {{ Route::is('employees.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Employee">Employee</div>
        </a>
        @can('role-list')
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('employees.*') ? 'active ' : '' }}">
                    <a href="{{ route('employees.list') }}" class="menu-link">
                        <div data-i18n="Employee">Employee</div>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endif

@if (Auth::user()->hasAnyPermission(['event.list']))
    <li class="menu-item {{ Route::is('event.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Event">Event</div>
        </a>
        @can('event.list')
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('event.*') ? 'active ' : '' }}">
                    <a href="{{ route('event.list') }}" class="menu-link">
                        <div data-i18n="Event">Event</div>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endif

@if (Auth::user()->hasAnyPermission(['designation.list']))
    <li class="menu-item {{ Route::is('designation.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Designation">Designation</div>
        </a>
        @can('designation.list')
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('designation.*') ? 'active ' : '' }}">
                    <a href="{{ route('designation.list') }}" class="menu-link">
                        <div data-i18n="designation">Designation</div>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endif


@if (Auth::user()->hasAnyPermission(['expense.list']))
    <li class="menu-item {{ Route::is('expense.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Expense">Expense</div>
        </a>
        @can('expense.list')
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('expense.*') ? 'active ' : '' }}">
                    <a href="{{ route('expense.list') }}" class="menu-link">
                        <div data-i18n="Expense">Expense</div>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endif

@if (Auth::user()->hasAnyPermission(['department.list']))
    <li class="menu-item {{ Route::is('department.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Department">Department</div>
        </a>
        @can('department.list')
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('department.*') ? 'active ' : '' }}">
                    <a href="{{ route('department.list') }}" class="menu-link">
                        <div data-i18n="Department">Department</div>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endif


@if (Auth::user()->hasAnyPermission(['payment.list']))
    <li class="menu-item {{ Route::is('payment.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Payment">Payment</div>
        </a>
        @can('payment.list')
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('payment.*') ? 'active ' : '' }}">
                    <a href="{{ route('payment.list') }}" class="menu-link">
                        <div data-i18n="Payment">Payment</div>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endif



</ul>
