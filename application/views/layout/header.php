<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= isset($meta_description) ? html_escape($meta_description) : 'Find your perfect car - VAutoSpare' ?>">
    <meta name="keywords" content="<?= isset($meta_keywords) ? html_escape($meta_keywords) : 'cars, buy car, sell car' ?>">
    <title><?= isset($meta_title) ? html_escape($meta_title) : 'V Auto Spare - Car Marketplace' ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/image/favicon icon/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/image/favicon icon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/image/favicon icon/favicon-32x32.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/image/favicon icon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/image/favicon icon/android-chrome-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/image/favicon icon/android-chrome-512x512.png') ?>">
    <link rel="manifest" href="<?= base_url('assets/image/favicon icon/site.webmanifest') ?>">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --accent: #25d366;
            --dark: #1a1d21;
            --gray-100: #f8f9fa;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #333; }
        .navbar { box-shadow: 0 2px 15px rgba(0,0,0,.08); }
        .navbar-brand { font-weight: 700; color: var(--dark) !important; }
        .navbar-brand img { max-height: 36px; width: auto; }
        .nav-link { font-weight: 500; }
        .btn-whatsapp { background: #25d366; color: #fff !important; border: none; }
        .btn-whatsapp:hover { background: #20bd5a; color: #fff; }
        .car-card { transition: transform .2s, box-shadow .2s; border: none; overflow: hidden; }
        .car-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.12) !important; }
        .car-card .card-img-top { height: 200px; object-fit: cover; }
        .price-tag { font-size: 1.25rem; font-weight: 700; color: var(--primary); }
        .whatsapp-float { position: fixed; bottom: 24px; right: 24px; z-index: 999; width: 56px; height: 56px; border-radius: 50%; background: #25d366; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; box-shadow: 0 4px 15px rgba(37,211,102,.5); transition: transform .2s; }
        .whatsapp-float:hover { color: #fff; transform: scale(1.08); }
        :root {
            --bg-color: #ffffff;
            --text-color: #212529;
            --navbar-bg: #ffffff;
            --navbar-text: #1a1d21;
            --navbar-border: rgba(0,0,0,.08);
            --footer-bg: #1a1d21;
            --footer-text: #aaa;
            --card-bg: #ffffff;
            --link: #0d6efd;
            --link-hover: #0b5ed7;
            --muted: #6c757d;
            --btn-whatsapp-bg: #25d366;
            --theme-toggle-bg: rgba(13,110,253,.08);
        }
        html[data-theme="dark"] {
            --bg-color: #0b1220;
            --text-color: #f8fafc;
            --navbar-bg: #0c1220;
            --navbar-text: #f8fafc;
            --navbar-border: rgba(255,255,255,.12);
            --footer-bg: #050913;
            --footer-text: #94a3b8;
            --card-bg: #111827;
            --link: #7dd3fc;
            --link-hover: #38bdf8;
            --muted: #94a3b8;
            --secondary: #94a3b8;
            --btn-whatsapp-bg: #25d366;
            --theme-toggle-bg: rgba(255,255,255,.08);
        }
        html[data-theme="light"] {
            --bg-color: #ffffff;
            --text-color: #212529;
            --navbar-bg: #ffffff;
            --navbar-text: #1a1d21;
            --navbar-border: rgba(0,0,0,.08);
            --footer-bg: #1a1d21;
            --footer-text: #aaa;
            --card-bg: #ffffff;
            --link: #0d6efd;
            --link-hover: #0b5ed7;
            --muted: #6c757d;
            --secondary: #6c757d;
            --btn-whatsapp-bg: #25d366;
            --theme-toggle-bg: rgba(13,110,253,.08);
        }
        html[data-theme="system"] {
            color-scheme: light;
        }
        @media (prefers-color-scheme: dark) {
            html[data-theme="system"] {
                --bg-color: #0b1220;
                --text-color: #f8fafc;
                --navbar-bg: #0c1220;
                --navbar-text: #f8fafc;
                --navbar-border: rgba(255,255,255,.12);
                --footer-bg: #050913;
                --footer-text: #94a3b8;
                --card-bg: #111827;
                --link: #7dd3fc;
                --link-hover: #38bdf8;
                --muted: #94a3b8;
                --secondary: #94a3b8;
                --btn-whatsapp-bg: #25d366;
                --theme-toggle-bg: rgba(255,255,255,.08);
                color-scheme: dark;
            }
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-color); background: var(--bg-color); }
        html[data-theme="dark"] body,
        html[data-theme="dark"] body p,
        html[data-theme="dark"] body h1,
        html[data-theme="dark"] body h2,
        html[data-theme="dark"] body h3,
        html[data-theme="dark"] body h4,
        html[data-theme="dark"] body h5,
        html[data-theme="dark"] body h6,
        html[data-theme="dark"] body span,
        html[data-theme="dark"] body a,
        html[data-theme="dark"] body li,
        html[data-theme="dark"] body label,
        html[data-theme="dark"] body small,
        html[data-theme="dark"] body strong {
            color: var(--text-color) !important;
        }
        html[data-theme="dark"] .text-dark,
        html[data-theme="dark"] .text-black,
        html[data-theme="dark"] .text-body {
            color: var(--text-color) !important;
        }
        html[data-theme="dark"] .text-muted,
        html[data-theme="dark"] .text-secondary {
            color: var(--secondary) !important;
        }
        html[data-theme="dark"] .bg-light,
        html[data-theme="dark"] .bg-white,
        html[data-theme="dark"] .bg-body,
        html[data-theme="dark"] .card,
        html[data-theme="dark"] .dropdown-menu,
        html[data-theme="dark"] .form-control,
        html[data-theme="dark"] .form-select,
        html[data-theme="dark"] .btn-outline-primary,
        html[data-theme="dark"] .btn-outline-secondary {
            background-color: var(--card-bg) !important;
            border-color: rgba(255,255,255,.08) !important;
            color: var(--text-color) !important;
        }
        html[data-theme="dark"] .form-control,
        html[data-theme="dark"] .form-select {
            background-color: #122031 !important;
            color: var(--text-color) !important;
        }
        html[data-theme="dark"] .form-control::placeholder,
        html[data-theme="dark"] .form-select option {
            color: rgba(248,250,252,.7) !important;
        }
        html[data-theme="dark"] a.text-dark,
        html[data-theme="dark"] a.text-black {
            color: var(--text-color) !important;
        }
        html[data-theme="dark"] .btn-primary {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
        }
        html[data-theme="dark"] .btn-outline-primary {
            color: var(--text-color) !important;
            border-color: #3b82f6 !important;
        }
        html[data-theme="dark"] .navbar {
            background: var(--navbar-bg) !important;
        }
        html[data-theme="dark"] .navbar-light .navbar-nav .nav-link {
            color: var(--navbar-text) !important;
        }
        html[data-theme="dark"] .navbar-toggler-icon {
            filter: invert(1);
        }
        .navbar { box-shadow: 0 2px 15px rgba(0,0,0,.08); background: var(--navbar-bg) !important; }
        .navbar-brand { font-weight: 700; color: var(--navbar-text) !important; }
        .navbar-brand img { max-height: 36px; width: auto; }
        .nav-link { font-weight: 500; color: var(--navbar-text) !important; }
        .nav-link:hover { color: var(--link) !important; }
        .btn-whatsapp { background: var(--btn-whatsapp-bg); color: #fff !important; border: none; }
        .btn-whatsapp:hover { background: #20bd5a; color: #fff; }
        .dropdown-menu { background: var(--card-bg); color: var(--text-color); border-color: var(--navbar-border); }
        .dropdown-item { color: var(--text-color); }
        .dropdown-item.active, .dropdown-item:hover { background: var(--theme-toggle-bg); color: var(--text-color); }
        .theme-toggle-btn { color: var(--navbar-text); border-color: var(--navbar-border); }
        footer { background: var(--footer-bg); color: var(--footer-text); }
        .card, .dropdown-menu { background: var(--card-bg); }
        a, .text-secondary { color: var(--link) !important; }
        a:hover { color: var(--link-hover) !important; }
        .btn-outline-secondary { color: var(--navbar-text); border-color: var(--navbar-border); }
        .btn-outline-secondary:hover { background: var(--theme-toggle-bg); }
        .navbar-toggler-icon { filter: none; }
        html[data-theme="dark"] .navbar-toggler-icon { filter: invert(1); }
        .car-card { transition: transform .2s, box-shadow .2s; border: none; overflow: hidden; }
        .car-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.12) !important; }
        .car-card .card-img-top { height: 200px; object-fit: cover; }
        .price-tag { font-size: 1.25rem; font-weight: 700; color: var(--primary); }
        .whatsapp-float { position: fixed; bottom: 24px; right: 24px; z-index: 999; width: 56px; height: 56px; border-radius: 50%; background: var(--btn-whatsapp-bg); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; box-shadow: 0 4px 15px rgba(37,211,102,.5); transition: transform .2s; }
        .whatsapp-float:hover { color: #fff; transform: scale(1.08); }
        /* Animation Container - Only in main section */
        main { position: relative; }
        .animation-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: 0; }
        .ball { position: absolute; border-radius: 100%; opacity: 0.7; will-change: transform; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('/assets/image/logo.jpeg') ?>" 
                    alt="Logo" 
                    style="width:30px; height:30px; object-fit:contain; margin-right:8px;">
                V AutoSpare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('cars') ?>">Cars</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('accessories') ?>">Accessories</a></li>
                </ul>
                <ul class="navbar-nav">
                    <?php if ($this->session->userdata('user_id')): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('account') ?>"><i class="bi bi-person-circle"></i> Account</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('logout') ?>">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Login</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-whatsapp btn-sm ms-1" href="<?= html_escape($whatsapp_url ?? '#') ?>" target="_blank"><i class="bi bi-whatsapp"></i> Inquire</a></li>
                    <?php endif; ?>
                    <li class="nav-item dropdown ms-2">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle theme-toggle-btn" type="button" id="themeSwitcherBtn" data-bs-toggle="dropdown" aria-expanded="false" style="height: 40px;">
                            <i class="bi bi-circle-half"></i> Theme
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeSwitcherBtn">
                            <li><button class="dropdown-item theme-option" type="button" data-theme="system"><i class="bi bi-circle-half me-2"></i>System Default</button></li>
                            <li><button class="dropdown-item theme-option" type="button" data-theme="light"><i class="bi bi-brightness-high me-2"></i>Light Mode</button></li>
                            <li><button class="dropdown-item theme-option" type="button" data-theme="dark"><i class="bi bi-moon-stars me-2"></i>Dark Mode</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="animation-container" id="animationContainer"></div>
        <div style="position: relative; z-index: 1;">
