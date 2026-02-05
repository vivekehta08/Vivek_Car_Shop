<h1 class="h3 mb-4">Manage Cars</h1>
<div class="mb-3">
    <a href="<?= base_url('admin/cars/add') ?>" class="btn btn-primary"><i class="bi bi-plus"></i> Add Car</a>
    <a href="<?= base_url('admin/cars') ?>" class="btn btn-outline-secondary">All</a>
    <a href="<?= base_url('admin/cars?status=pending') ?>" class="btn btn-outline-warning">Pending</a>
    <a href="<?= base_url('admin/cars?status=approved') ?>" class="btn btn-outline-success">Approved</a>
</div>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Car</th><th>Price</th><th>City</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
        <?php foreach ($cars as $c): ?>
        <tr>
            <td><?= $c->id ?></td>
            <td><?= html_escape($c->brand_name.' '.$c->model_name) ?><?= $c->variant ? ' '.$c->variant : '' ?></td>
            <td>₹ <?= number_format($c->price/100000, 1) ?> L</td>
            <td><?= $c->city_name ?></td>
            <td><span class="badge bg-<?= $c->status=='approved'?'success':($c->status=='pending'?'warning':'secondary') ?>"><?= $c->status ?></span></td>
            <td>
                <a href="<?= base_url('admin/cars/edit/'.$c->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="<?= base_url('admin/cars/delete/'.$c->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this car?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($total_pages > 1): ?>
<nav><ul class="pagination">
    <?php for ($i=1;$i<=$total_pages;$i++): ?><li class="page-item <?= $i==$page?'active':'' ?>"><a class="page-link" href="<?= base_url('admin/cars/index/'.$i) ?>?<?= http_build_query($_GET) ?>"><?= $i ?></a></li><?php endfor; ?>
</ul></nav>
<?php endif; ?>
