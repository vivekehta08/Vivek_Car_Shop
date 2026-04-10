<div class="container py-5" style="max-width: 450px;">
    <div class="card shadow">
        <div class="card-body p-4">
            <h2 class="h4 mb-4">Register</h2>
            <?= form_open('auth/register') ?>
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
                <input type="text" name="phone" class="form-control" pattern="[0-9]{10}" maxlength="10" title="Enter 10 digit phone number" required value="<?= set_value('phone') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password','eyeIcon1')">
                        <span id="eyeIcon1">👁</span>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirm" id="confirm_password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirm_password','eyeIcon2')">
                        <span id="eyeIcon2">👁</span>
                    </button>
                </div>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
            <?= form_close() ?>
            <p class="mt-3 text-center text-muted">Already have an account? <a href="<?= base_url('login') ?>">Login</a></p>
        </div>
    </div>
</div>
<script>
function togglePassword(fieldId, iconId) {
    let pass = document.getElementById(fieldId);
    let icon = document.getElementById(iconId);

    if (pass.type === "password") {
        pass.type = "text";
        icon.innerHTML = "🙈";
    } else {
        pass.type = "password";
        icon.innerHTML = "👁";
    }
}
</script>