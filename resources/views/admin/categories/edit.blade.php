@extends('admin.layouts.app')

@section('title', 'Edit Category - ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category: {{ $category->name }}</h1>
        <div>
            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">
                <i class="fas fa-eye me-1"></i> View Details
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Category Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Category Slug</label>
                            <input type="text" class="form-control" value="{{ $category->slug }}" disabled>
                            <small class="form-text text-muted">
                                Slug is automatically generated from the category name and cannot be edited directly.
                            </small>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Category Stats</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong>Products:</strong> 
                                    <span class="badge bg-primary">{{ $category->products_count }}</span>
                                </p>
                                <p class="mb-2">
                                    <strong>Created:</strong> 
                                    {{ $category->created_at->format('M d, Y') }}
                                </p>
                                <p class="mb-0">
                                    <strong>Last Updated:</strong> 
                                    {{ $category->updated_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Category
                                    </button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection