<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= isset($meta_description) ? html_escape($meta_description) : 'Find your perfect car - VivekCarShop' ?>">
    <meta name="keywords" content="<?= isset($meta_keywords) ? html_escape($meta_keywords) : 'cars, buy car, sell car' ?>">
    <title><?= isset($meta_title) ? html_escape($meta_title) : 'VivekCarShop - Car Marketplace' ?></title>
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
        .nav-link { font-weight: 500; }
        .btn-whatsapp { background: #25d366; color: #fff !important; border: none; }
        .btn-whatsapp:hover { background: #20bd5a; color: #fff; }
        .car-card { transition: transform .2s, box-shadow .2s; border: none; overflow: hidden; }
        .car-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.12) !important; }
        .car-card .card-img-top { height: 200px; object-fit: cover; }
        .price-tag { font-size: 1.25rem; font-weight: 700; color: var(--primary); }
        .whatsapp-float { position: fixed; bottom: 24px; right: 24px; z-index: 999; width: 56px; height: 56px; border-radius: 50%; background: #25d366; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; box-shadow: 0 4px 15px rgba(37,211,102,.5); transition: transform .2s; }
        .whatsapp-float:hover { color: #fff; transform: scale(1.08); }
        footer { background: var(--dark); color: #aaa; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>"><?= html_escape($site_name ?? 'VivekCarShop') ?></a>
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
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
