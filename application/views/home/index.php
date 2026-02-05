<!-- Hero Search -->
<section class="py-5 bg-light rounded-4 mx-2 mx-md-4 mb-4">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">Find Your Right Car</h1>
        <p class="lead text-muted mb-4">Search from thousands of cars. Connect with sellers via WhatsApp.</p>
        <form action="<?= base_url('cars') ?>" method="get" class="row g-3 justify-content-center">
            <div class="col-md-2">
                <select name="brand" class="form-select">
                    <option value="">All Brands</option>
                    <?php foreach ($brands as $b): ?>
                        <option value="<?= $b->id ?>"><?= html_escape($b->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="fuel" class="form-select">
                    <option value="">Fuel Type</option>
                    <option value="1">Petrol</option>
                    <option value="2">Diesel</option>
                    <option value="3">Electric</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="city" class="form-select">
                    <option value="">City</option>
                    <?php foreach ($cities as $c): ?>
                        <option value="<?= $c->id ?>"><?= html_escape($c->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Min Price (₹)" min="0">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Max Price (₹)" min="0">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i></button>
            </div>
        </form>
        <a href="<?= base_url('cars') ?>" class="btn btn-link mt-2">Advanced Search</a>
    </div>
</section>

<?php if (!empty($banners)): ?>
<!-- Banners -->
<section class="container mb-5">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded-3 overflow-hidden">
            <?php foreach ($banners as $i => $b): ?>
            <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                <a href="<?= $b->link_url ? base_url($b->link_url) : '#' ?>">
                    <img src="<?= base_url($b->image_path) ?>" class="d-block w-100" style="height:350px;object-fit:cover" alt="<?= html_escape($b->title) ?>">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($banners) > 1): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Featured Cars -->
<section class="container mb-5">
    <h2 class="h4 fw-bold mb-4">Featured Cars</h2>
    <?php if (!empty($featured_cars)): ?>
    <div class="row g-4">
        <?php foreach ($featured_cars as $car): 
            $img_src = $car->primary_image ?? 'https://via.placeholder.com/400x200?text=No+Image';
            $car_url = base_url('car/'.$car->id.'/'.url_title($car->brand_name.'-'.$car->model_name,'-',TRUE));
        ?>
        <div class="col-md-6 col-lg-3">
            <a href="<?= $car_url ?>" class="text-decoration-none text-dark">
                <div class="card car-card h-100 shadow-sm">
                    <img src="<?= $img_src ?>" class="card-img-top" alt="<?= html_escape($car->brand_name.' '.$car->model_name) ?>">
                    <div class="card-body">
                        <h6 class="card-title"><?= html_escape($car->brand_name.' '.$car->model_name) ?><?= $car->variant ? ' '.$car->variant : '' ?></h6>
                        <p class="text-muted small mb-2"><?= $car->year ?> • <?= $car->fuel_type ?> • <?= $car->city_name ?></p>
                        <p class="price-tag mb-0">₹ <?= number_format($car->price/100000, 1) ?> Lakh</p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-4"><a href="<?= base_url('cars') ?>" class="btn btn-outline-primary">View All Cars</a></div>
    <?php else: ?>
    <p class="text-muted">No featured cars at the moment. <a href="<?= base_url('cars') ?>">Browse all cars</a></p>
    <?php endif; ?>
</section>

<!-- Latest Cars -->
<section class="container mb-5">
    <h2 class="h4 fw-bold mb-4">Latest Cars</h2>
    <?php if (!empty($latest_cars)): ?>
    <div class="row g-4">
        <?php foreach ($latest_cars as $car): 
            $img_src = $car->primary_image ?? 'https://via.placeholder.com/400x200?text=No+Image';
            $car_url = base_url('car/'.$car->id.'/'.url_title($car->brand_name.'-'.$car->model_name,'-',TRUE));
        ?>
        <div class="col-md-6 col-lg-3">
            <a href="<?= $car_url ?>" class="text-decoration-none text-dark">
                <div class="card car-card h-100 shadow-sm">
                    <img src="<?= $img_src ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h6 class="card-title"><?= html_escape($car->brand_name.' '.$car->model_name) ?></h6>
                        <p class="text-muted small mb-2"><?= $car->year ?> • <?= $car->city_name ?></p>
                        <p class="price-tag mb-0">₹ <?= number_format($car->price/100000, 1) ?> Lakh</p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Popular Brands -->
<?php if (!empty($popular_brands)): ?>
<section class="container mb-5">
    <h2 class="h4 fw-bold mb-4">Popular Brands</h2>
    <div class="row g-3">
        <?php foreach ($popular_brands as $b): ?>
        <div class="col-4 col-md-2">
            <a href="<?= base_url('cars?brand='.$b->id) ?>" class="d-block text-center p-3 bg-light rounded-3 text-decoration-none text-dark">
                <span class="fw-semibold"><?= html_escape($b->name) ?></span>
                <?php if (isset($b->car_count) && $b->car_count): ?>
                <small class="d-block text-muted"><?= $b->car_count ?> cars</small>
                <?php endif; ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- Car Accessories -->
<?php if (!empty($featured_accessories)): ?>
<section class="container mb-5">
    <h2 class="h4 fw-bold mb-4">Car Accessories</h2>
    <div class="row g-4">
        <?php foreach ($featured_accessories as $acc): 
            $img_src = $acc->primary_image ?? 'https://via.placeholder.com/300x200?text=Accessory';
            $acc_url = base_url('accessory/'.$acc->id.'/'.$acc->slug);
        ?>
        <div class="col-md-6 col-lg-4">
            <a href="<?= $acc_url ?>" class="text-decoration-none text-dark">
                <div class="card car-card h-100 shadow-sm">
                    <img src="<?= $img_src ?>" class="card-img-top" style="height:180px;object-fit:cover" alt="">
                    <div class="card-body">
                        <h6 class="card-title"><?= html_escape($acc->name) ?></h6>
                        <p class="price-tag mb-0">₹ <?= number_format($acc->price) ?></p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-4"><a href="<?= base_url('accessories') ?>" class="btn btn-outline-primary">View All Accessories</a></div>
</section>
<?php endif; ?>
