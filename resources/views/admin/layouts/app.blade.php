<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    @yield('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        
        <div class="dashboard-content">
            <!-- Header -->
            @include('admin.partials.header')
            
            <!-- Main Content -->
            <main class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
            
            <!-- Footer -->
            @include('admin.partials.footer')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>