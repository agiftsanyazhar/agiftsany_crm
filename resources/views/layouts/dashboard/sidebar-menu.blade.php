<div class="sidebar-menu">
    <ul class="menu">
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
            <li class="sidebar-item {{ request()->is('dashboard/lead') ? 'active' : '' }}">
                <a href="{{ route('dashboard.lead.index') }}" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Leads</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('dashboard/project') ? 'active' : '' }}">
                <a href="{{ route('dashboard.project.index') }}" class="sidebar-link">
                    <i class="bi bi-building-fill"></i>
                    <span>Projects</span>
                </a>
            </li>
        @endif
        
        <li class="sidebar-item {{ request()->is('dashboard/product') ? 'active' : '' }}">
            <a href="{{ route('dashboard.product.index') }}" class="sidebar-link">
                <i class="bi bi-box-fill"></i>
                <span>Products</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('dashboard/customer*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.customer.index') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Customers</span>
            </a>
        </li>
    </ul>
</div>
