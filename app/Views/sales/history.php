<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Sales History & Transactions</h1>
    <a href="<?= base_url('sales/record') ?>" class="btn btn-primary">
        <i class="fas fa-cash-register me-1"></i> Record New Sale
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Customer</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($salesList)): ?>
                    <?php foreach ($salesList as $sale): ?>
                        <tr>
                            <td><strong>#<?= $sale['id'] ?></strong></td>
                            <td><?= !empty($sale['customer_name']) ? esc($sale['customer_name']) : '<span class="text-secondary">Walk-in Customer</span>' ?></td>
                            <td><?= esc($sale['product_name']) ?></td>
                            <td><?= $sale['quantity'] ?></td>
                            <td class="text-success fw-bold">₱<?= number_format($sale['total_amount'], 2) ?></td>
                            <td class="text-secondary"><?= $sale['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-5">No sales transactions recorded yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>