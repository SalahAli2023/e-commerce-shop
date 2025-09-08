@extends('admin.layouts.app')

@section('title', 'Edit Product - ' . $product->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    <div>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">
            <i class="fas fa-eye me-1"></i> View Details
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Products
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4 admin-form">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Product Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Product Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="price" class="form-label">Price ($)</label>
                                        <input type="number" step="0.01" min="0" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="on_sale" name="on_sale" value="1" 
                                                {{ old('on_sale', $product->on_sale) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="on_sale">
                                                Put product on sale
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                
                                @if($product->image_path)
                                <div class="current-image mb-3 text-center">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                                         alt="Current product image" 
                                         class="img-thumbnail" 
                                         style="max-height: 200px;">
                                    <p class="text-muted mt-2">Current Image</p>
                                </div>
                                @endif
                                
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <div id="image-preview" class="mt-3 text-center">
                                    @if(!$product->image_path)
                                    <p class="text-muted">No image selected yet</p>
                                    @endif
                                </div>

                                @if($product->image_path)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                    <label class="form-check-label" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                                @endif
                            </div>

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Product Stats</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Created:</strong> {{ $product->created_at->format('M d, Y') }}</p>
                                    <p><strong>Last Updated:</strong> {{ $product->updated_at->format('M d, Y') }}</p>
                                    <p><strong>Status:</strong> 
                                        @if($product->on_sale)
                                        <span class="badge bg-success">On Sale</span>
                                        @else
                                        <span class="badge bg-secondary">Regular</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-admin btn-admin-primary">
                            <i class="fas fa-save me-1"></i> Update Product
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // معاينة الصورة قبل الرفع
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        const preview = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px;">`;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<p class="text-muted">No image selected yet</p>';
        }
    });

    // إظهار/إخفاء حذف الصورة بناءً على اختيار صورة جديدة
    document.getElementById('image').addEventListener('change', function() {
        const removeImageCheckbox = document.getElementById('remove_image');
        if (removeImageCheckbox && this.files.length > 0) {
            removeImageCheckbox.checked = false;
        }
    });

    document.getElementById('remove_image').addEventListener('change', function() {
        const imageInput = document.getElementById('image');
        if (this.checked) {
            imageInput.value = '';
            document.getElementById('image-preview').innerHTML = '<p class="text-muted">Image will be removed</p>';
        }
    });
</script>
@endsection