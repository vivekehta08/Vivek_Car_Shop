<h1 class="h3 mb-4">Manage Users</h1>
<form method="get" class="mb-3">
    <div class="input-group" style="max-width:400px">
        <input type="text" name="keyword" class="form-control" value="<?= html_escape($filters['keyword']??'') ?>" placeholder="Search by name or email">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u->id ?></td>
            <td><?= html_escape($u->name) ?></td>
            <td><?= html_escape($u->email) ?></td>
            <td><?= html_escape($u->phone ?? '-') ?></td>
            <td><?= date('d M Y', strtotime($u->created_at)) ?></td>
            <td><span class="badge bg-<?= $u->is_blocked?'danger':'success' ?>"><?= $u->is_blocked?'Blocked':'Active' ?></span></td>
            <td><a href="<?= base_url('admin/users/toggle_block/'.$u->id) ?>" class="btn btn-sm btn-<?= $u->is_blocked?'success':'warning' ?>"><?= $u->is_blocked?'Unblock':'Block' ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($total_pages > 1): ?><nav><ul class="pagination"><?php for ($p=1;$p<=$total_pages;$p++): ?><li class="page-item <?= $p==$page?'active':'' ?>"><a class="page-link" href="<?= base_url('admin/users/index/'.$p) ?>?<?= http_build_query($filters) ?>"><?= $p ?></a></li><?php endfor; ?></ul></nav><?php endif; ?>
