<h1 class="h3 mb-4">Inquiries</h1>
<form method="get" class="row g-3 mb-4">
    <div class="col-auto"><select name="type" class="form-select form-select-sm"><option value="">All Types</option><option value="car" <?= (isset($filters['type'])&&$filters['type']=='car')?'selected':'' ?>>Car</option><option value="accessory" <?= (isset($filters['type'])&&$filters['type']=='accessory')?'selected':'' ?>>Accessory</option></select></div>
    <div class="col-auto"><input type="date" name="from_date" class="form-control form-control-sm" value="<?= $filters['from_date']??'' ?>" placeholder="From"></div>
    <div class="col-auto"><input type="date" name="to_date" class="form-control form-control-sm" value="<?= $filters['to_date']??'' ?>" placeholder="To"></div>
    <div class="col-auto"><button type="submit" class="btn btn-sm btn-primary">Filter</button></div>
</form>
<table class="table table-bordered table-sm">
    <thead><tr><th>Date</th><th>Type</th><th>Customer</th><th>Phone</th><th>Item</th><th>Message</th></tr></thead>
    <tbody>
        <?php foreach ($inquiries as $i): ?>
        <tr>
            <td><?= date('d M Y H:i', strtotime($i->created_at)) ?></td>
            <td><?= ucfirst($i->type) ?></td>
            <td><?= html_escape($i->customer_name) ?></td>
            <td><?= html_escape($i->customer_phone ?? '-') ?></td>
            <td><?= html_escape($i->car_variant ?? $i->accessory_name ?? '-') ?></td>
            <td><?= html_escape(character_limiter($i->message ?? '', 50)) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($total_pages > 1): ?><nav><ul class="pagination"><?php for ($p=1;$p<=$total_pages;$p++): ?><li class="page-item <?= $p==$page?'active':'' ?>"><a class="page-link" href="<?= base_url('admin/inquiries/index/'.$p) ?>?<?= http_build_query($filters) ?>"><?= $p ?></a></li><?php endfor; ?></ul></nav><?php endif; ?>
