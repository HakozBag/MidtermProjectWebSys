<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'POS System') ?></title>
    <!-- Load Bootstrap first so the custom theme can override its defaults. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
                <h4 class="text-white text-center py-3 mb-4 border-bottom"><i class="fas fa-cash-register"></i> POS System</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="<?= base_url('dashboard') ?>" class="nav-link"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('products') ?>" class="nav-link"><i class="fas fa-box me-2"></i> Products</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('customers') ?>" class="nav-link"><i class="fas fa-users me-2"></i> Customers</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('staff') ?>" class="nav-link"><i class="fas fa-user-shield me-2"></i> Staff</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('sales/record') ?>" class="nav-link"><i class="fas fa-shopping-cart me-2"></i> Record Sale</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('sales/history') ?>" class="nav-link"><i class="fas fa-history me-2"></i> Sales History</a></li>
                    <li class="nav-item mt-4"><a href="<?= base_url('logout') ?>" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('success')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('error')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
