<div class="container py-5" style="max-width: 400px;">
    <div class="card shadow">
        <div class="card-body p-4">
            <h2 class="h4 mb-4">Login</h2>
            <?php if (isset($error)): ?><div class="alert alert-danger"><?= html_escape($error) ?></div><?php endif; ?>
            <?= form_open('login') ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="<?= set_value('email') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            <?= form_close() ?>
            <p class="mt-3 text-center text-muted">Don't have an account? <a href="<?= base_url('register') ?>">Register</a></p>
        </div>
    </div>
</div>
