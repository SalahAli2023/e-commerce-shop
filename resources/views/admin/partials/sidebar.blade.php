<aside id="sidebar" class="dashboard-sidebar bg-dark text-white p-3 vh-100 position-fixed top-0 start-0 transition-all">
    <div class="sidebar-header d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Admin Dashboard</h3>
        <!-- close Sidebar  -->
        <button class="btn btn-sm text-white d-lg-none" id="openSidebar">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ Request::is('admin/dashboard') ? 'active bg-primary rounded px-3' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ Request::is('admin/products*') ? 'active bg-primary rounded px-3' : '' }}" href="{{ route('admin.products') }}">
                    <i class="fas fa-box me-2"></i> Products Management
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ Request::is('admin/categories*') ? 'active bg-primary rounded px-3' : '' }}" href="{{ route('admin.categories') }}">
                    <i class="fas fa-tags me-2"></i> Categories
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    <i class="fas fa-users me-2"></i> Customers
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    <i class="fas fa-shopping-cart me-2"></i> Orders
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    <i class="fas fa-chart-bar me-2"></i> Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('home') }}">
                    <i class="fas fa-store me-2"></i> Back to Store
                </a>
            </li>
        </ul>
    </nav>
</aside>

