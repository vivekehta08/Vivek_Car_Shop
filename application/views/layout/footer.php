        </div>
    </main>
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('/assets/image/logo.jpeg') ?>" 
                            alt="<?= html_escape($site_name ?? 'V Auto Spare') ?> Logo" 
                            style="width:30px; height:30px; object-fit:contain; margin-right:8px;">
                            
                        <h5 class="text-white mb-0">
                            <?= html_escape($site_name ?? 'V Auto Spare') ?>
                        </h5>
                    </div>
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
            <p class="text-center text-secondary mb-0">&copy; <?= date('Y') ?> <?= html_escape($site_name ?? 'V Auto Spare') ?>. All rights reserved.</p>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="<?= html_escape($whatsapp_url ?? '#') ?>" target="_blank" class="whatsapp-float" title="Chat on WhatsApp"><i class="bi bi-whatsapp"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Background Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('animationContainer');
            if (!container) return;

            const colors = ["#3CC157", "#2AA7FF", "#1B1B1B", "#FCBC0F", "#F85F36"];
            const numBalls = 50;
            const balls = [];

            for (let i = 0; i < numBalls; i++) {
                let ball = document.createElement("div");
                ball.classList.add("ball");
                ball.style.background = colors[Math.floor(Math.random() * colors.length)];
                ball.style.left = `${Math.floor(Math.random() * 100)}%`;
                ball.style.top = `${Math.floor(Math.random() * 100)}%`;
                ball.style.transform = `scale(${Math.random()})`;
                ball.style.width = `${Math.random() * 4 + 1}em`;
                ball.style.height = ball.style.width;

                balls.push(ball);
                container.append(ball);
            }

            balls.forEach((el, i) => {
                let to = {
                    x: Math.random() * (i % 2 === 0 ? -11 : 11),
                    y: Math.random() * 12
                };

                el.animate(
                    [
                        { transform: `translate(0, 0) ${el.style.transform}` },
                        { transform: `translate(${to.x}rem, ${to.y}rem) ${el.style.transform}` }
                    ],
                    {
                        duration: (Math.random() + 1) * 2000,
                        direction: "alternate",
                        fill: "both",
                        iterations: Infinity,
                        easing: "ease-in-out"
                    }
                );
            });
        });
    </script>
    <!-- Theme Toggle Script -->
    <script>
        (function() {
            const themeKey = 'vautospareTheme';
            const themeMeta = document.querySelector('meta[name="theme-color"]');
            const themeSwitcherBtn = document.getElementById('themeSwitcherBtn');
            const themeOptions = document.querySelectorAll('.theme-option');
            const labels = { system: 'System Default', light: 'Light Mode', dark: 'Dark Mode' };
            const icons = { system: 'bi-circle-half', light: 'bi-brightness-high', dark: 'bi-moon-stars' };

            const getPreferred = () => window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

            const applyTheme = (theme) => {
                const html = document.documentElement;
                const selected = theme || localStorage.getItem(themeKey) || 'system';
                html.setAttribute('data-theme', selected);

                const activeTheme = selected === 'system' ? getPreferred() : selected;
                themeMeta.setAttribute('content', activeTheme === 'dark' ? '#0b1220' : '#ffffff');
                html.style.colorScheme = activeTheme;

                if (themeSwitcherBtn) {
                    themeSwitcherBtn.innerHTML = `<i class="bi ${icons[selected]}"></i> ${labels[selected]}`;
                }

                themeOptions.forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.theme === selected);
                });
            };

            const saveTheme = (theme) => {
                localStorage.setItem(themeKey, theme);
                applyTheme(theme);
            };

            if (themeOptions.length) {
                themeOptions.forEach(btn => {
                    btn.addEventListener('click', function() {
                        saveTheme(this.dataset.theme);
                    });
                });
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if ((localStorage.getItem(themeKey) || 'system') === 'system') {
                    applyTheme('system');
                }
            });

            applyTheme(localStorage.getItem(themeKey) || 'system');
        })();
    </script>
</body>
</html>
