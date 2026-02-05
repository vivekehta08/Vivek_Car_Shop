<h1 class="h3 mb-4">Manage Accessories</h1>
<div class="mb-3"><a href="<?= base_url('admin/accessories/add') ?>" class="btn btn-primary"><i class="bi bi-plus"></i> Add Accessory</a></div>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Actions</th></tr></thead>
    <tbody>
        <?php foreach ($accessories as $a): ?>
        <tr>
            <td><?= $a->id ?></td>
            <td><?= html_escape($a->name) ?></td>
            <td><?= html_escape($a->category_name ?? '-') ?></td>
            <td>₹ <?= number_format($a->price) ?></td>
            <td>
                <a href="<?= base_url('admin/accessories/edit/'.$a->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="<?= base_url('admin/accessories/delete/'.$a->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($total_pages > 1): ?>
<nav><ul class="pagination">
    <?php for ($i=1;$i<=$total_pages;$i++): ?><li class="page-item <?= $i==$page?'active':'' ?>"><a class="page-link" href="<?= base_url('admin/accessories/index/'.$i) ?>"><?= $i ?></a></li><?php endfor; ?>
</ul></nav>
<?php endif; ?>
