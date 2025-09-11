@extends('admin.layouts.app')

@section('title', 'Category Details - ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category Details</h1>
        <div>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit Category
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Category Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Category Name</label>
                                <p class="form-control-plaintext">{{ $category->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Category Slug</label>
                                <p class="form-control-plaintext">{{ $category->slug }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Total Products</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-primary">{{ $category->products_count }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-success">Active</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Created At</label>
                                <p class="form-control-plaintext">{{ $category->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Last Updated</label>
                                <p class="form-control-plaintext">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products in this Category Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Products in this Category</h6>
                    <span class="badge bg-primary">{{ $category->products_count }} products</span>
                </div>
                <div class="card-body">
                    @if($category->products_count > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            @if($product->on_sale)
                                                <span class="badge bg-success">On Sale</span>
                                            @else
                                                <span class="badge bg-secondary">Regular</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" 
                                                class="btn btn-sm btn-info" title="View Product">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted my-4">
                            <i class="fas fa-box-open fa-2x mb-3"></i><br>
                            No products found in this category.
                        </p>
                        <div class="text-center">
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Add New Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Quick Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.create') }}?category={{ $category->id }}" 
                           class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Add Product to this Category
                        </a>
                        
                        <a href="{{ route('products.index') }}?category={{ $category->id }}" 
                           class="btn btn-info">
                            <i class="fas fa-list me-1"></i> View All Products
                        </a>
                        
                        <a href="{{ route('categories.edit', $category->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit Category
                        </a>
                        
                        @if($category->products_count == 0)
                        <form action="{{ route('categories.destroy', $category->id) }}" 
                              method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" 
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fas fa-trash me-1"></i> Delete Category
                            </button>
                        </form>
                        @else
                        <button class="btn btn-danger w-100" disabled title="Cannot delete category with products">
                            <i class="fas fa-trash me-1"></i> Delete Category
                        </button>
                        <small class="text-muted text-center">
                            Remove all products before deleting this category.
                        </small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Category Statistics Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="mb-4">
                            <span class="display-4 text-primary">{{ $category->products_count }}</span>
                            <p class="text-muted">Total Products</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <span class="h5 text-success">
                                        {{ $category->products()->where('on_sale', true)->count() }}
                                    </span>
                                    <p class="small text-muted mb-0">On Sale</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <span class="h5 text-info">
                                        {{ $category->products()->where('on_sale', false)->count() }}
                                    </span>
                                    <p class="small text-muted mb-0">Regular Price</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Enable tooltips
    $(document).ready(function() {
        $('[title]').tooltip();
    });
</script>
@endsection