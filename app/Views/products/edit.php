<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Edit Product</h1>
                <a href="<?= base_url('products') ?>" class="button-link" style="margin-top: 0; background: #334155; text-decoration: none; padding: 8px 16px;">Back to Inventory</a>
            </div>

            <div class="card form-container p-5 shadow-lg">
                <form action="<?= base_url('products/update/' . $product['id']) ?>" method="post">
                    <div class="mb-4">
                        <label class="form-label fs-5">Product Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="<?= esc($product['name']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fs-5">Price (₱)</label>
                        <input type="text" name="price" class="form-control form-control-lg" value="<?= esc($product['price']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fs-5">Stock Quantity</label>
                        <input type="number" name="stock_quantity" class="form-control form-control-lg" value="<?= esc($product['stock_quantity']) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold fs-5 mt-3">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>