<h1 class="h3 mb-4"><?= $car ? 'Edit' : 'Add' ?> Car</h1>
<?php if ($this->session->flashdata('upload_errors')): ?>
<div class="alert alert-warning">
    <strong>Image upload issue:</strong>
    <ul class="mb-0">
        <?php foreach ($this->session->flashdata('upload_errors') as $err): ?>
        <li><?= html_escape($err) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<?= form_open_multipart($car ? 'admin/cars/edit/'.$car->id : 'admin/cars/add') ?>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Brand *</label>
            <select name="brand_id" class="form-select" id="brandId" required>
                <option value="">Select</option>
                <?php foreach ($brands as $b): ?>
                <option value="<?= $b->id ?>" <?= ($car && $car->brand_id==$b->id) ? 'selected' : '' ?>><?= html_escape($b->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Model *</label>
            <select name="model_id" class="form-select" id="modelId" required>
                <option value="">Select brand first</option>
                <?php foreach ($models as $m): ?>
                <option value="<?= $m->id ?>" <?= ($car && $car->model_id==$m->id) ? 'selected' : '' ?>><?= html_escape($m->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Variant</label>
            <input type="text" name="variant" class="form-control" value="<?= $car ? html_escape($car->variant) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Year *</label>
            <input type="number" name="year" class="form-control" required value="<?= $car ? $car->year : date('Y') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Fuel Type *</label>
            <select name="fuel_type_id" class="form-select" required>
                <?php foreach ($fuel_types as $f): ?>
                <option value="<?= $f->id ?>" <?= ($car && $car->fuel_type_id==$f->id) ? 'selected' : '' ?>><?= $f->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Transmission *</label>
            <select name="transmission_id" class="form-select" required>
                <?php foreach ($transmissions as $t): ?>
                <option value="<?= $t->id ?>" <?= ($car && $car->transmission_id==$t->id) ? 'selected' : '' ?>><?= $t->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mileage</label>
            <input type="text" name="mileage" class="form-control" value="<?= $car ? html_escape($car->mileage) : '' ?>" placeholder="e.g. 18 kmpl">
        </div>
        <div class="mb-3">
            <label class="form-label">Price (₹) *</label>
            <input type="number" name="price" class="form-control" required value="<?= $car ? $car->price : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">City *</label>
            <select name="city_id" class="form-select" required>
                <?php foreach ($cities as $c): ?>
                <option value="<?= $c->id ?>" <?= ($car && $car->city_id==$c->id) ? 'selected' : '' ?>><?= $c->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= $car ? html_escape($car->description) : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Seller Name</label>
            <input type="text" name="seller_name" class="form-control" value="<?= $car ? html_escape($car->seller_name) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Seller Phone</label>
            <input type="text" name="seller_phone" class="form-control" value="<?= $car ? html_escape($car->seller_phone) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Seller Email</label>
            <input type="email" name="seller_email" class="form-control" value="<?= $car ? html_escape($car->seller_email) : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="pending" <?= ($car && $car->status=='pending') ? 'selected' : '' ?>>Pending</option>
                <option value="approved" <?= ($car && $car->status=='approved') ? 'selected' : '' ?>>Approved</option>
                <option value="sold" <?= ($car && $car->status=='sold') ? 'selected' : '' ?>>Sold</option>
            </select>
        </div>
        <div class="mb-3">
            <div class="form-check"><input type="checkbox" name="is_featured" class="form-check-input" value="1" <?= ($car && $car->is_featured) ? 'checked' : '' ?>><label class="form-check-label">Featured</label></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Images</label>
            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            <?php if (!empty($car_images)): ?>
            <p class="small text-muted mt-1">Current: <?= count($car_images) ?> image(s)</p>
            <div class="d-flex flex-wrap gap-2 mt-2">
                <?php foreach ($car_images as $img): ?>
                <div class="border rounded overflow-hidden" style="width:90px; height:90px;">
                    <img src="<?= base_url($img->image_path) ?>" alt="" style="width:100%; height:100%; object-fit:cover">
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<button type="submit" name="submit" class="btn btn-primary">Save Car</button>
<a href="<?= base_url('admin/cars') ?>" class="btn btn-secondary">Cancel</a>
<?= form_close() ?>
<script>
document.addEventListener('DOMContentLoaded', function(){
    if (!window.jQuery) return;
    var $ = window.jQuery;

    $('#brandId').change(function(){
        var bid = $(this).val();
        if (!bid) {
            $('#modelId').html('<option value="">Select brand first</option>');
            return;
        }
        $.get('<?= base_url("admin/cars/models_by_brand") ?>?brand_id='+bid, function(d){
            var o = '<option value="">Select</option>';
            $.each(d, function(i,m){ o += '<option value="'+m.id+'">'+m.name+'</option>'; });
            $('#modelId').html(o);
        });
    });
});
</script>
