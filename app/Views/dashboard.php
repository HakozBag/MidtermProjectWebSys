<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 dashboard-header">
    <h1 class="h2">Dashboard Overview</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <span class="text-muted">Welcome back, <strong><?= esc(session()->get('full_name')) ?></strong>!</span>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
    <div class="col">
        <div class="card border-start border-success border-4 h-100">
            <div class="card-body">
                <div class="metric-label small text-uppercase fw-bold">Total Revenue</div>
                <div class="h3 fw-bold text-success my-2">₱<?= number_format($totalRevenue, 2) ?></div>
                <div class="metric-note small"><?= number_format($totalTransactions) ?> completed transactions</div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-start border-primary border-4 h-100">
            <div class="card-body">
                <div class="metric-label small text-uppercase fw-bold">Products in Inventory</div>
                <div class="h3 fw-bold text-primary my-2"><?= number_format($totalProducts) ?></div>
                <div class="small"><a href="<?= base_url('products') ?>" class="link-info text-decoration-none">Manage products &rarr;</a></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-start border-warning border-4 h-100">
            <div class="card-body">
                <div class="metric-label small text-uppercase fw-bold">Registered Customers</div>
                <div class="h3 fw-bold text-warning my-2"><?= number_format($totalCustomers) ?></div>
                <div class="metric-note small">Active customer base</div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-start border-info border-4 h-100">
            <div class="card-body">
                <div class="metric-label small text-uppercase fw-bold">Staff Accounts</div>
                <div class="h3 fw-bold text-info my-2"><?= number_format($totalStaff) ?></div>
                <div class="small"><a href="<?= base_url('staff') ?>" class="link-info text-decoration-none">View staff list &rarr;</a></div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header py-3">
        <h2 class="h5 mb-0 fw-bold">Recent Transactions</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">Sale ID</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date &amp; Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentSales)): ?>
                        <?php foreach ($recentSales as $sale): ?>
                            <tr>
                                <td>#<?= esc($sale['id']) ?></td>
                                <td><?= esc($sale['quantity']) ?></td>
                                <td class="fw-bold text-success">₱<?= number_format((float) $sale['total_price'], 2) ?></td>
                                <td><?= esc($sale['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No transactions recorded yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
