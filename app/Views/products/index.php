<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Product Inventory</h1>
    <a href="<?= base_url('products/create') ?>" class="button-link" style="margin-top: 0;">Add New Product</a>
</div>

<!-- Success and Error Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="success-message" style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid rgba(16, 185, 129, 0.4);"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="error-message" style="background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.4);"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Stock Quantity</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($productsList)): ?>
            <?php foreach ($productsList as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" alt="Product" width="40" height="40" style="object-fit: cover; border-radius: 6px;">
                        <?php else: ?>
                            <span style="color: #888; font-size: 12px;">No image</span>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($product['name']) ?></strong></td>
                    <td>₱<?= number_format($product['price'], 2) ?></td>
                    <td>
                        <span class="status <?= $product['stock_quantity'] > 0 ? 'completed' : 'pending' ?>">
                            <?= $product['stock_quantity'] ?> in stock
                        </span>
                    </td>
                    <td><?= $product['created_at'] ?></td>
                    <td>
                        <div class="actions" style="display: flex; gap: 8px;">
                            <!-- Edit Trigger Modal -->
                            <button type="button" class="button-link" style="padding: 6px 12px; font-size: 12px; cursor: pointer;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editProductModal"
                                data-id="<?= $product['id'] ?>"
                                data-name="<?= esc($product['name']) ?>"
                                data-price="<?= $product['price'] ?>"
                                data-stock="<?= $product['stock_quantity'] ?>">
                                Edit
                            </button>

                            <!-- Delete Trigger Modal -->
                            <button type="button" class="archive-button" style="padding: 6px 12px; font-size: 12px; cursor: pointer; background: #ef4444; color: white; border: none; border-radius: 6px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteConfirmModal"
                                data-deleteurl="<?= base_url('products/delete/' . $product['id']) ?>">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align: center; color: #69778e;">No products found in inventory.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Edit Product Modal Overlay -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #111827; border: 1px solid rgba(6, 182, 212, 0.3); color: #ffffff;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" method="post">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price (₱)</label>
                        <input type="text" name="price" id="editPrice" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="editStock" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Delete Confirmation Modal Overlay -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #111827; border: 1px solid rgba(239, 68, 68, 0.4); color: #ffffff;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="fs-5 mb-0">Are you sure you want to delete this product?</p>
                <p class="text-secondary small mt-1">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-top border-secondary justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger px-4">Confirm Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to pass data dynamically into the modals -->
<script>
    // Edit Modal Data Handler
    const editProductModal = document.getElementById('editProductModal');
    editProductModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const price = button.getAttribute('data-price');
        const stock = button.getAttribute('data-stock');

        const form = document.getElementById('editProductForm');
        form.action = "<?= base_url('products/update/') ?>" + id;

        document.getElementById('editName').value = name;
        document.getElementById('editPrice').value = price;
        document.getElementById('editStock').value = stock;
    });

    // Delete Confirmation Modal Handler
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const deleteUrl = button.getAttribute('data-deleteurl');
        
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        confirmBtn.href = deleteUrl;
    });
</script>
<?= $this->endSection() ?>