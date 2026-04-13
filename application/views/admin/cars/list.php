<h1 class="h3 mb-4">Manage Cars</h1>

<div class="mb-3">
    <a href="<?= base_url('admin/cars/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Car
    </a>

    <a href="<?= base_url('admin/cars') ?>" class="btn btn-outline-secondary">All</a>
    <a href="<?= base_url('admin/cars?status=pending') ?>" class="btn btn-outline-warning">Pending</a>
    <a href="<?= base_url('admin/cars?status=approved') ?>" class="btn btn-outline-success">Approved</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Car</th>
            <th>Price</th>
            <th>City</th>
            <th>Status</th>
            <th width="150">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($cars as $c): ?>
        <tr>
            <td><?= $c->id ?></td>

            <td>
                <?= html_escape($c->brand_name.' '.$c->model_name) ?>
                <?= $c->variant ? ' '.$c->variant : '' ?>
            </td>

            <td>
                ₹ <?= number_format($c->price/100000, 1) ?> L
            </td>

            <td><?= $c->city_name ?></td>

            <td>
                <span class="badge bg-<?= $c->status=='approved'?'success':($c->status=='pending'?'warning':'secondary') ?>">
                    <?= $c->status ?>
                </span>
            </td>

            <td>
                <a href="<?= base_url('admin/cars/edit/'.$c->id) ?>"
                   class="btn btn-sm btn-outline-primary">
                   Edit
                </a>

                <button class="btn btn-sm btn-outline-danger"
                        onclick="deleteCar(<?= $c->id ?>)">
                    Delete
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($total_pages > 1): ?>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= $i==$page?'active':'' ?>">
            <a class="page-link"
               href="<?= base_url('admin/cars/index/'.$i) ?>?<?= http_build_query($_GET) ?>">
               <?= $i ?>
            </a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Are you sure you want to delete this car?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
      </div>

    </div>
  </div>
</div>

<script>
    let deleteId = null;
    let deleteModal = null;

    // initialize modal AFTER DOM loads
    document.addEventListener("DOMContentLoaded", function () {
        deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    });

    // open modal
    function deleteCar(id) {
        deleteId = id;
        deleteModal.show();
    }

    // confirm delete
    document.getElementById("confirmDeleteBtn").addEventListener("click", function () {
        fetch("<?= base_url('admin/cars/delete/') ?>" + deleteId, {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }
            return res.json();
        })
        .then(data => {

            deleteModal.hide();

            if (data.status) {
                alert("Deleted successfully");
                location.reload();
            } else {
                alert("Delete failed");
            }
        })
        .catch(err => {
            console.log(err);
            alert("Error occurred");
        });
    });
</script>