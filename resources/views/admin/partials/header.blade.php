{{-- <header class="dashboard-header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fas fa-store me-2"></i>Back to Store
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('home') }}" method="Get">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> --}}

<header class="dashboard-header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-3">
        <div class="container-fluid">

            <!-- زر التحكم بالسايدبار (يظهر في الموبايل والتابلت) -->
            <button class="btn btn-dark d-lg-none me-2" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand fw-bold text-uppercase" href="#">
                Admin Panel
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeaderContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeaderContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2 fs-5"></i>
                            <span>Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fas fa-store me-2"></i>Back to Store
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('home') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


{{-- <header class="dashboard-header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-3">
        <div class="container-fluid">

            <!-- زر التحكم بالسايدبار (فقط هنا) -->
            <button class="btn btn-dark d-lg-none me-2" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand fw-bold text-uppercase" href="#">
                Admin Panel
            </a>

            <div class="collapse navbar-collapse" id="navbarHeaderContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2 fs-5"></i>
                            <span>Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-store me-2"></i>Back to Store</a></li>
                            <li>
                                <form action="{{ route('home') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

    <header class="dashboard-header">
        <nav class="navbar navbar-dark bg-dark shadow-sm px-3">
            <div class="container-fluid">
                <button class="btn btn-dark d-lg-none me-2" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand fw-bold text-uppercase" href="#">Admin Panel</a>

                <ul class="navbar-nav ms-auto flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-store me-2"></i>Back to Store</a></li>
                            <li>
                                <form action="{{ route('home') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header> --}}


