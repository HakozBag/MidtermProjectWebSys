<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product Management</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="fas fa-plus me-1"></i> Add New Product
    </button>
</div>

<!-- Products Table Card -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Static Row for UI Preview -->
                    <tr>
                        <td>1</td>
                        <td>
                            <img src="https://via.placeholder.com/40" alt="Product" class="rounded" width="40" height="40">
                        </td>
                        <td>Sample Product Item</td>
                        <td>₱499.00</td>
                        <td><span class="badge bg-success">25 in stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning text-white me-1"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Product Modal Placeholder -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price (₱)</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="productStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Save Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>