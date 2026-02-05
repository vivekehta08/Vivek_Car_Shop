<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?= isset($title) ? $title : 'VivekCarShop' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Admin Login</h2>
                        <?php if (isset($error)): ?><div class="alert alert-danger"><?= html_escape($error) ?></div><?php endif; ?>
                        <?= form_open('admin/auth/login') ?>
                        <div class="mb-3">
                            <label class="form-label">Username or Email</label>
                            <input type="text" name="username" class="form-control" required placeholder="admin" autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        <?= form_close() ?>
                    </div>
                </div>
                <p class="text-center mt-3"><a href="<?= base_url() ?>">← Back to Website</a></p>
            </div>
        </div>
    </div>
</body>
</html>
