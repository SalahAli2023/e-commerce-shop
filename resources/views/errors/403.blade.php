@extends('layouts.app')

@section('title', '403 - Forbidden')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-container">
                <h1 class="display-1 text-primary">403</h1>
                <h2 class="mb-4">Access Forbidden</h2>
                <p class="lead mb-4">Sorry, you don't have permission to access this page.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Go Back
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    
                    @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-info">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    @endauth
                </div>
                
                @auth
                <div class="mt-5">
                    <p class="text-muted">If you believe this is an error, please contact the administrator.</p>
                    <p class="text-muted small">User: {{ auth()->user()->email }}</p>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
.error-container {
    padding: 3rem 0;
}
.display-1 {
    font-size: 8rem;
    font-weight: 300;
    line-height: 1.2;
}
</style>
@endsection