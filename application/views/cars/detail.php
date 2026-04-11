<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('cars') ?>">Cars</a></li>
            <li class="breadcrumb-item active"><?= html_escape($car_name) ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-8">
            <?php if (!empty($images)): ?>
            <div id="carGallery" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner rounded-3 overflow-hidden">
                    <?php foreach ($images as $i => $img): ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url($img->image_path) ?>" class="d-block w-100" style="height:450px;object-fit:cover" alt="">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($images) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carGallery" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carGallery" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                <?php endif; ?>
            </div>
            <?php if (count($images) > 1): ?>
            <div class="car-image-thumbnails d-flex gap-2 flex-row overflow-auto mt-3 pb-2" style="max-width:100%;">
                <?php foreach ($images as $i => $img): ?>
                <div class="thumbnail-item" style="flex:0 0 auto;">
                    <img src="<?= base_url($img->image_path) ?>" class="img-thumbnail car-thumb <?= $i === 0 ? 'active border-primary' : '' ?>" style="width:120px;height:80px;object-fit:cover;cursor:pointer" data-index="<?= $i ?>" alt="">
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php else: ?>
            <img src="https://via.placeholder.com/800x450?text=No+Image" class="img-fluid rounded-3 mb-4" alt="">
            <?php endif; ?>
            
            <h1 class="h3 fw-bold mb-3"><?= html_escape($car_name) ?></h1>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-secondary"><?= $car->year ?></span>
                <span class="badge bg-secondary"><?= $car->fuel_type ?></span>
                <span class="badge bg-secondary"><?= $car->transmission ?></span>
                <span class="badge bg-secondary"><?= $car->city_name ?></span>
                <?php if ($car->mileage): ?><span class="badge bg-secondary"><?= html_escape($car->mileage) ?></span><?php endif; ?>
            </div>
            
            <?php if ($car->description): ?>
            <div class="card mb-4">
                <div class="card-header"><strong>Description</strong></div>
                <div class="card-body"><?= nl2br(html_escape($car->description)) ?></div>
            </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-header"><strong>Specifications</strong></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td width="40%">Brand</td><td><?= html_escape($car->brand_name) ?></td></tr>
                        <tr><td>Model</td><td><?= html_escape($car->model_name) ?></td></tr>
                        <?php if ($car->variant): ?><tr><td>Variant</td><td><?= html_escape($car->variant) ?></td></tr><?php endif; ?>
                        <tr><td>Year</td><td><?= $car->year ?></td></tr>
                        <tr><td>Fuel Type</td><td><?= $car->fuel_type ?></td></tr>
                        <tr><td>Transmission</td><td><?= $car->transmission ?></td></tr>
                        <?php if ($car->mileage): ?><tr><td>Mileage</td><td><?= html_escape($car->mileage) ?></td></tr><?php endif; ?>
                        <tr><td>Location</td><td><?= $car->city_name ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 90px;">
                <div class="card-body">
                    <h2 class="h4 text-primary mb-3">₹ <?= number_format($car->price/100000, 1) ?> Lakh</h2>
                    <?php if ($car->seller_name): ?>
                    <p class="mb-2"><strong>Seller:</strong> <?= html_escape($car->seller_name) ?></p>
                    <?php if ($car->seller_phone): ?><p class="mb-2"><i class="bi bi-telephone"></i> <?= html_escape($car->seller_phone) ?></p><?php endif; ?>
                    <?php endif; ?>
                    <a href="<?= html_escape($whatsapp_url) ?>" target="_blank" class="btn btn-whatsapp btn-lg w-100 mb-2" id="btnWhatsApp">
                        <i class="bi bi-whatsapp"></i> Inquire on WhatsApp
                    </a>
                    <?php if ($this->session->userdata('user_id')): ?>
                    <button type="button" class="btn btn-outline-secondary w-100" id="btnSave" data-car-id="<?= $car->id ?>" data-saved="<?= $is_saved ? '1' : '0' ?>">
                        <i class="bi bi-<?= $is_saved ? 'heart-fill text-danger' : 'heart' ?>"></i> <?= $is_saved ? 'Saved' : 'Save Car' ?>
                    </button>
                    <?php else: ?>
                    <a href="<?= base_url('login?redirect='.urlencode(current_url())) ?>" class="btn btn-outline-secondary w-100">Login to Save</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnSave = document.getElementById('btnSave');
        if (btnSave) {
            btnSave.addEventListener('click', function() {
                var carId = btnSave.getAttribute('data-car-id');
                var formData = new URLSearchParams();
                formData.append('car_id', carId);
                fetch('<?= base_url("auth/toggle_save") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: formData.toString(),
                    credentials: 'same-origin'
                })
                .then(function(response) { return response.json(); })
                .then(function(r) {
                    if (r.success) {
                        btnSave.setAttribute('data-saved', r.saved ? '1' : '0');
                        btnSave.innerHTML = r.saved ? '<i class="bi bi-heart-fill text-danger"></i> Saved' : '<i class="bi bi-heart"></i> Save Car';
                    }
                })
                .catch(function() {
                    console.error('Unable to save car.');
                });
            });
        }

        var gallery = document.getElementById('carGallery');
        if (gallery) {
            var thumbnails = document.querySelectorAll('.car-thumb');
            thumbnails.forEach(function(thumb) {
                thumb.addEventListener('click', function() {
                    var idx = parseInt(thumb.getAttribute('data-index'), 10);
                    var carousel = bootstrap.Carousel.getInstance(gallery) || new bootstrap.Carousel(gallery);
                    carousel.to(idx);
                    thumbnails.forEach(function(item) { item.classList.remove('active'); });
                    thumb.classList.add('active');
                });
            });
            gallery.addEventListener('slid.bs.carousel', function() {
                var activeIndex = Array.prototype.findIndex.call(gallery.querySelectorAll('.carousel-item'), function(item) {
                    return item.classList.contains('active');
                });
                thumbnails.forEach(function(item) { item.classList.remove('active'); });
                if (thumbnails[activeIndex]) {
                    thumbnails[activeIndex].classList.add('active');
                }
            });
        }
    });
</script>

