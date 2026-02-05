<div class="container">
    <h1 class="h3 fw-bold mb-4">Browse Cars</h1>
    
    <div class="row">
        <aside class="col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Filters</strong></div>
                <div class="card-body">
                    <form method="get" action="<?= base_url('cars') ?>" id="filterForm">
                        <div class="mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand" class="form-select form-select-sm" id="filterBrand">
                                <option value="">All</option>
                                <?php foreach ($brands as $b): ?>
                                <option value="<?= $b->id ?>" <?= (isset($filters['brand_id']) && $filters['brand_id'] == $b->id) ? 'selected' : '' ?>><?= html_escape($b->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Model</label>
                            <select name="model" class="form-select form-select-sm" id="filterModel">
                                <option value="">All</option>
                                <?php foreach ($models as $m): ?>
                                <option value="<?= $m->id ?>" <?= (isset($filters['model_id']) && $filters['model_id'] == $m->id) ? 'selected' : '' ?>><?= html_escape($m->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fuel Type</label>
                            <select name="fuel" class="form-select form-select-sm">
                                <option value="">All</option>
                                <?php foreach ($fuel_types as $f): ?>
                                <option value="<?= $f->id ?>" <?= (isset($filters['fuel_type_id']) && $filters['fuel_type_id'] == $f->id) ? 'selected' : '' ?>><?= html_escape($f->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <select name="city" class="form-select form-select-sm">
                                <option value="">All</option>
                                <?php foreach ($cities as $c): ?>
                                <option value="<?= $c->id ?>" <?= (isset($filters['city_id']) && $filters['city_id'] == $c->id) ? 'selected' : '' ?>><?= html_escape($c->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Min Price (₹)</label>
                            <input type="number" name="min_price" class="form-control form-control-sm" value="<?= html_escape($filters['min_price'] ?? '') ?>" placeholder="e.g. 100000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Price (₹)</label>
                            <input type="number" name="max_price" class="form-control form-control-sm" value="<?= html_escape($filters['max_price'] ?? '') ?>" placeholder="e.g. 1500000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <div class="row g-1">
                                <div class="col"><input type="number" name="min_year" class="form-control form-control-sm" value="<?= html_escape($filters['min_year'] ?? '') ?>" placeholder="From" min="2000"></div>
                                <div class="col"><input type="number" name="max_year" class="form-control form-control-sm" value="<?= html_escape($filters['max_year'] ?? '') ?>" placeholder="To" max="2030"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keyword</label>
                            <input type="text" name="keyword" class="form-control form-control-sm" value="<?= html_escape($filters['keyword'] ?? '') ?>" placeholder="Search...">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
                        <a href="<?= base_url('cars') ?>" class="btn btn-outline-secondary btn-sm w-100 mt-2">Reset</a>
                    </form>
                </div>
            </div>
        </aside>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="mb-0 text-muted"><?= $total ?> cars found</p>
                <select class="form-select form-select-sm w-auto" id="sortSelect" onchange="window.location.href=this.value">
                    <?php $q = array_merge($_GET, ['sort'=>'newest']); unset($q['page']); ?>
                    <option value="<?= base_url('cars').'?'.http_build_query($q) ?>" <?= ($order_by ?? '') == 'newest' ? 'selected' : '' ?>>Newest First</option>
                    <?php $q['sort']='price_low'; ?>
                    <option value="<?= base_url('cars').'?'.http_build_query($q) ?>" <?= ($order_by ?? '') == 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                    <?php $q['sort']='price_high'; ?>
                    <option value="<?= base_url('cars').'?'.http_build_query($q) ?>" <?= ($order_by ?? '') == 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                    <?php $q['sort']='popular'; ?>
                    <option value="<?= base_url('cars').'?'.http_build_query($q) ?>" <?= ($order_by ?? '') == 'popular' ? 'selected' : '' ?>>Most Popular</option>
                </select>
            </div>
            <?php if (empty($cars)): ?>
            <div class="alert alert-info">No cars match your filters. Try adjusting your search.</div>
            <?php else: ?>
            <div class="row g-4">
                <?php foreach ($cars as $car): 
                    $img_src = $car->primary_image ?? 'https://via.placeholder.com/400x200?text=No+Image';
                    $car_url = base_url('car/'.$car->id.'/'.url_title($car->brand_name.'-'.$car->model_name,'-',TRUE));
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card car-card h-100 shadow-sm">
                        <a href="<?= $car_url ?>"><img src="<?= $img_src ?>" class="card-img-top" alt=""></a>
                        <div class="card-body">
                            <h6 class="card-title"><a href="<?= $car_url ?>" class="text-dark text-decoration-none"><?= html_escape($car->brand_name.' '.$car->model_name) ?><?= $car->variant ? ' '.$car->variant : '' ?></a></h6>
                            <p class="text-muted small mb-2"><?= $car->year ?> • <?= $car->fuel_type ?> • <?= $car->transmission ?> • <?= $car->city_name ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price-tag">₹ <?= number_format($car->price/100000, 1) ?> Lakh</span>
                                <a href="<?= $car_url ?>" class="btn btn-sm btn-outline-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if ($total_pages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): 
                        $page_url = $i > 1 ? base_url('cars/'.$i) : base_url('cars');
                        $page_url .= empty($_GET) ? '' : '?'.http_build_query($_GET);
                    ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="<?= $page_url ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
$(function(){
    $('#filterBrand').change(function(){
        var brandId = $(this).val();
        if (!brandId) { $('#filterModel').html('<option value="">All</option>'); return; }
        $.get('<?= base_url("cars/models_by_brand") ?>?brand_id='+brandId, function(data){
            var opts = '<option value="">All</option>';
            $.each(data, function(i,m){ opts += '<option value="'+m.id+'">'+m.name+'</option>'; });
            $('#filterModel').html(opts);
        });
    });
});
</script>
