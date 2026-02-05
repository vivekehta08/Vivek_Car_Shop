<div class="container">
    <h1 class="h3 fw-bold mb-4">Car Accessories</h1>
    
    <div class="row">
        <aside class="col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Filters</strong></div>
                <div class="card-body">
                    <form method="get" action="<?= base_url('accessories') ?>">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="">All</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat->id ?>" <?= (isset($filters['category_id']) && $filters['category_id'] == $cat->id) ? 'selected' : '' ?>><?= html_escape($cat->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Car Brand</label>
                            <select name="brand" class="form-select form-select-sm" id="accBrand">
                                <option value="">All</option>
                                <?php foreach ($brands as $b): ?>
                                <option value="<?= $b->id ?>" <?= (isset($filters['brand_id']) && $filters['brand_id'] == $b->id) ? 'selected' : '' ?>><?= html_escape($b->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keyword</label>
                            <input type="text" name="keyword" class="form-control form-control-sm" value="<?= html_escape($filters['keyword'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">Apply</button>
                    </form>
                </div>
            </div>
        </aside>
        <div class="col-lg-9">
            <p class="text-muted mb-3"><?= $total ?> accessories found</p>
            <?php if (empty($accessories)): ?>
            <div class="alert alert-info">No accessories match your filters.</div>
            <?php else: ?>
            <div class="row g-4">
                <?php foreach ($accessories as $acc): 
                    $img_src = $acc->primary_image ?? 'https://via.placeholder.com/300x200?text=Accessory';
                    $acc_url = base_url('accessory/'.$acc->id.'/'.$acc->slug);
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card car-card h-100 shadow-sm">
                        <a href="<?= $acc_url ?>"><img src="<?= $img_src ?>" class="card-img-top" style="height:200px;object-fit:cover" alt=""></a>
                        <div class="card-body">
                            <h6 class="card-title"><a href="<?= $acc_url ?>" class="text-dark text-decoration-none"><?= html_escape($acc->name) ?></a></h6>
                            <p class="price-tag mb-2">₹ <?= number_format($acc->price) ?></p>
                            <a href="<?= $acc_url ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if ($total_pages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="<?= base_url('accessories/'.$i).'?'.http_build_query($_GET) ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
