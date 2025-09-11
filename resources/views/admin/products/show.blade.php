<!-- In resources/views/admin/products/show.blade.php -->

@extends('admin.layouts.app')

@section('title', 'Product Details - ' . $product->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
        <div>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit Product
            </a>
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Products
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Product Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Product Name</label>
                                <p class="form-control-plaintext">{{ $product->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <p class="form-control-plaintext">
                                    @if($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        <span class="text-muted">Uncategorized</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <p class="form-control-plaintext">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Discounted Price</label>
                                <p class="form-control-plaintext">
                                    ${{ number_format($product->discounted_price, 2) }}
                                    @if($product->on_sale)
                                        <span class="badge bg-success ms-2">On Sale</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <div class="form-control-plaintext bg-light p-3 rounded">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p>
                                    @if($product->on_sale)
                                        <span class="badge bg-success">On Sale</span>
                                    @else
                                        <span class="badge bg-secondary">Regular Price</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Created At</label>
                                <p class="form-control-plaintext">{{ $product->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Last Updated</label>
                                <p class="form-control-plaintext">{{ $product->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Product ID</label>
                                <p class="form-control-plaintext">#{{ $product->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Product Image Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Image</h6>
                </div>
                <div class="card-body text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded mb-3" 
                             style="max-height: 300px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                             style="height: 200px;">
                            <i class="fas fa-box text-muted fa-3x"></i>
                        </div>
                        <p class="text-muted mt-3">No image available</p>
                    @endif
                </div>
            </div>

            <!-- Category Information Card -->
            @if($product->category)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>{{ $product->category->name }}</h5>
                            <p class="text-muted mb-1">Slug: {{ $product->category->slug }}</p>
                            <p class="text-muted">Products in category: {{ $product->category->products_count ?? 'N/A' }}</p>
                        </div>
                        <a href="{{ route('admin.categories') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn {{ $product->on_sale ? 'btn-success' : 'btn-outline-success' }} sale-toggle" 
                                data-id="{{ $product->id }}" 
                                data-sale="{{ $product->on_sale ? 'true' : 'false' }}">
                            <i class="fas {{ $product->on_sale ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                            {{ $product->on_sale ? 'On Sale' : 'Not on Sale' }}
                        </button>
                        
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit Product
                        </a>
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-1"></i> Delete Product
                            </button>
                        </form>
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
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    // Toggle product sale status
    document.querySelector('.sale-toggle').addEventListener('click', function() {
        const productId = this.dataset.id;
        const isOnSale = this.dataset.sale === 'true';
        const url = `/admin/products/${productId}/toggle-sale`;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ on_sale: !isOnSale })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update button
                this.dataset.sale = !isOnSale;
                if (!isOnSale) {
                    this.classList.remove('btn-outline-success');
                    this.classList.add('btn-success');
                    this.innerHTML = '<i class="fas fa-check-circle me-1"></i> On Sale';
                } else {
                    this.classList.remove('btn-success');
                    this.classList.add('btn-outline-success');
                    this.innerHTML = '<i class="fas fa-times-circle me-1"></i> Not on Sale';
                }
                
                // Show success message
                showAlert('Product status updated successfully', 'success');
            } else {
                showAlert('Error updating product status', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error updating product status', 'danger');
        });
    });

    // Function to show alert messages
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Add alert at the top of the page
        const container = document.querySelector('.container-fluid');
        container.insertBefore(alertDiv, container.firstChild);
        
        // Remove alert automatically after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 5000);
    }
</script>
@endsection