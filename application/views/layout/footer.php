    </main>
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3"><?= html_escape($site_name ?? 'VivekCarShop') ?></h5>
                    <p>Your trusted car marketplace. Find the perfect car or sell yours with ease.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>" class="text-secondary text-decoration-none">Home</a></li>
                        <li><a href="<?= base_url('cars') ?>" class="text-secondary text-decoration-none">Browse Cars</a></li>
                        <li><a href="<?= base_url('accessories') ?>" class="text-secondary text-decoration-none">Accessories</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="text-white mb-3">Account</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('login') ?>" class="text-secondary text-decoration-none">Login</a></li>
                        <li><a href="<?= base_url('register') ?>" class="text-secondary text-decoration-none">Register</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4 text-md-end">
                    <a href="<?= html_escape($whatsapp_url ?? '#') ?>" target="_blank" class="btn btn-whatsapp btn-lg"><i class="bi bi-whatsapp"></i> Chat on WhatsApp</a>
                </div>
            </div>
            <hr class="border-secondary">
            <p class="text-center text-secondary mb-0">&copy; <?= date('Y') ?> <?= html_escape($site_name ?? 'VivekCarShop') ?>. All rights reserved.</p>
        </div>
    </footer>
    <!-- WhatsApp Floating Button -->
    <a href="<?= html_escape($whatsapp_url ?? '#') ?>" target="_blank" class="whatsapp-float" title="Chat on WhatsApp"><i class="bi bi-whatsapp"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
