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
$('#btnSave').on('click', function(){
    var btn = $(this), carId = btn.data('car-id');
    $.post('<?= base_url("auth/toggle_save") ?>', {car_id: carId}, function(r){
        if(r.success){
            btn.data('saved', r.saved ? 1 : 0);
            btn.find('i').attr('class', 'bi bi-' + (r.saved ? 'heart-fill text-danger' : 'heart'));
            btn.html((r.saved ? '<i class="bi bi-heart-fill text-danger"></i> Saved' : '<i class="bi bi-heart"></i> Save Car'));
        }
    }, 'json');
});
</script>
