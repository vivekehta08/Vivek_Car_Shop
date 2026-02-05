<div class="container py-5" style="max-width: 450px;">
    <div class="card shadow">
        <div class="card-body p-4">
            <h2 class="h4 mb-4">Register</h2>
            <?= form_open('register') ?>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required value="<?= set_value('name') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="<?= set_value('email') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= set_value('phone') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirm" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
            <?= form_close() ?>
            <p class="mt-3 text-center text-muted">Already have an account? <a href="<?= base_url('login') ?>">Login</a></p>
        </div>
    </div>
</div>
