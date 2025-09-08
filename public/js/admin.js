// JavaScript for Product Management Dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Enable tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Confirm before deletion
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
    
    // Show image preview before upload
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px;">`;
                }
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Toggle product sale status
    const saleToggleButtons = document.querySelectorAll('.sale-toggle');
    saleToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
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
        const container = document.querySelector('.content-wrapper');
        container.insertBefore(alertDiv, container.firstChild);
        
        // Remove alert automatically after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 5000);
    }

    // حذف عبر AJAX مع SweetAlert
    const deleteButtons = document.querySelectorAll('.btn-delete-ajax');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${productName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // إرسال طلب الحذف
                    fetch(`/admin/products/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Product has been deleted successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the product.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the product.',
                            'error'
                        );
                    });
                }
            });
        });
    });

    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('openSidebar');
    openBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
});