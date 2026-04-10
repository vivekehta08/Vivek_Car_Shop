<div class="container py-5" style="max-width: 400px;">
    <div class="card shadow">
        <div class="card-body p-4">
            <h2 class="h4 mb-4">Login</h2>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger"><?= validation_errors() ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= html_escape($error) ?></div>
            <?php endif; ?>

            <?= form_open('auth/login') ?>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?= set_value('email') ?>">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                        <span id="eyeIcon">👁</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <?= form_close() ?>

            <p class="mt-3 text-center">
                Don't have an account? <a href="<?= base_url('register') ?>">Register</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    let icon = document.getElementById("eyeIcon");

    if (pass.type === "password") {
        pass.type = "text";
        icon.innerHTML = "🙈";
    } else {
        pass.type = "password";
        icon.innerHTML = "👁";
    }
}
</script>