<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add New Customer</h1>
    <a href="<?= base_url('customers') ?>" class="btn btn-outline-secondary btn-sm">Back to Directory</a>
</div>

<div class="card form-container p-4" style="max-width: 700px;">
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form action="<?= base_url('customers/store') ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="text" name="email" class="form-control" required placeholder="customer@example.com">
        </div>

        <div class="mb-4">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required placeholder="09123456789">
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Customer</button>
    </form>
</div>
<?= $this->endSection() ?>