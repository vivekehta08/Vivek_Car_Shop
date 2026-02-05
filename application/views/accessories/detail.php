<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('accessories') ?>">Accessories</a></li>
            <li class="breadcrumb-item active"><?= html_escape($accessory->name) ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-8">
            <?php if (!empty($images)): ?>
            <div id="accGallery" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner rounded-3 overflow-hidden">
                    <?php foreach ($images as $i => $img): ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url($img->image_path) ?>" class="d-block w-100" style="height:400px;object-fit:cover" alt="">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($images) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#accGallery" data-bs-slide="prev"></button>
                <button class="carousel-control-next" type="button" data-bs-target="#accGallery" data-bs-slide="next"></button>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <img src="https://via.placeholder.com/800x400?text=No+Image" class="img-fluid rounded-3 mb-4" alt="">
            <?php endif; ?>
            
            <h1 class="h3 fw-bold mb-3"><?= html_escape($accessory->name) ?></h1>
            <?php if ($accessory->description): ?>
            <div class="card mb-4">
                <div class="card-header"><strong>Description</strong></div>
                <div class="card-body"><?= nl2br(html_escape($accessory->description)) ?></div>
            </div>
            <?php endif; ?>
            <?php if ($accessory->compatible_models): ?>
            <div class="card">
                <div class="card-header"><strong>Compatible Car Models</strong></div>
                <div class="card-body"><?= nl2br(html_escape($accessory->compatible_models)) ?></div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 90px;">
                <div class="card-body">
                    <h2 class="h4 text-primary mb-4">₹ <?= number_format($accessory->price) ?></h2>
                    <a href="<?= html_escape($whatsapp_url) ?>" target="_blank" class="btn btn-whatsapp btn-lg w-100">
                        <i class="bi bi-whatsapp"></i> Inquiry via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
