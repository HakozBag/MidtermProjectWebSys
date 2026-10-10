<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<h1>Add New Product</h1>

<div class="form-container">
    <?php if (isset($validation)): ?>
        <div class="error-message"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form action="<?= base_url('products/store') ?>" method="post" enctype="multipart/form-data">
        <label>Product Name</label>
        <input type="text" name="name" required>

        <label>Price (₱)</label>
        <input type="text" name="price" required placeholder="0.00">

        <label>Stock Quantity</label>
        <input type="text" name="stock_quantity" required placeholder="0">

        <label>Product Image</label>
        <input type="file" name="image">

        <div style="margin-top: 20px;">
            <button type="submit">Save Product</button>
            <a href="<?= base_url('products') ?>" style="margin-left: 15px; text-decoration: none; color: #263b66; font-weight: bold;">Cancel</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>