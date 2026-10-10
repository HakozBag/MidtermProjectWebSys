<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="auth-page">
    <div class="card auth-card">
        <h1>Staff Sign Up</h1>
        <p class="auth-subtitle">Create an account to access the POS system</p>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger auth-alert" role="alert"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <form action="<?= base_url('signup/store') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" autocomplete="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" autocomplete="email" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" autocomplete="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
            </div>
            <div class="mb-4">
                <label for="avatar" class="form-label">Avatar <span class="fw-normal text-secondary">(optional)</span></label>
                <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn auth-submit w-100">Register</button>
        </form>

        <div class="auth-footer">
            <small>Already have an account? <a href="<?= base_url('login') ?>">Login</a></small>
        </div>
    </div>
</body>
</html>
