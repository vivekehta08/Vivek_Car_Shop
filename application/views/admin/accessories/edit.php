<h1 class="h3 mb-4">Edit Accessory</h1>

<div id="msg"></div>

<form id="editForm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Accessory Name *</label>
                <input type="text" name="name" class="form-control" required value="<?= html_escape($accessory->name) ?>">
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat->id ?>" <?= $accessory->category_id == $cat->id ? 'selected' : '' ?>><?= html_escape($cat->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Brand</label>
                <select name="brand_id" class="form-select" id="accBrand">
                    <option value="">Select</option>
                    <?php foreach ($brands as $b): ?>
                    <option value="<?= $b->id ?>" <?= $accessory->brand_id == $b->id ? 'selected' : '' ?>><?= html_escape($b->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Model</label>
                <select name="model_id" class="form-select" id="accModel">
                    <option value="">Select</option>
                    <?php foreach ($models as $m): ?>
                    <option value="<?= $m->id ?>" <?= $accessory->model_id == $m->id ? 'selected' : '' ?>><?= html_escape($m->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Price *</label>
                <input type="number" name="price" class="form-control" required value="<?= $accessory->price ?>">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_available" class="form-check-input" id="isAvailable" value="1" <?= $accessory->is_available ? 'checked' : '' ?>>
                <label class="form-check-label" for="isAvailable">Available</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"><?= html_escape($accessory->description) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Compatible Models</label>
                <textarea name="compatible_models" class="form-control" rows="3"><?= html_escape($accessory->compatible_models) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Upload New Images</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                <small class="text-muted">Uploading new images will replace existing ones.</small>
            </div>

            <?php if (!empty($accessory_images)): ?>
            <div class="mb-3">
                <label>Current Images</label>
                <div class="d-flex flex-wrap gap-2 mt-2">
                    <?php foreach ($accessory_images as $img): ?>
                    <div class="position-relative border rounded overflow-hidden" style="width:90px; height:90px;">
                        <img src="<?= base_url($img->image_path) ?>" alt="" style="width:100%; height:100%; object-fit:cover">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" style="padding:2px 5px; font-size:12px;" onclick="deleteAccessoryImage(<?= $img->id ?>)">×</button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Accessory</button>
    <a href="<?= base_url('admin/accessories') ?>" class="btn btn-secondary">Cancel</a>
</form>

<script>
$('#editForm').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);
    let $submitBtn = $(this).find('button[type="submit"]');
    $submitBtn.prop('disabled', true).text('Updating...');

    $.ajax({
        url: "<?= base_url('admin/accessories/update/'.$accessory->id) ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            let r = JSON.parse(res);
            if (r.status) {
                $('#msg').html('<div class="alert alert-success">'+r.message+'</div>');
            } else {
                $('#msg').html('<div class="alert alert-danger">'+r.errors+'</div>');
            }
            $submitBtn.prop('disabled', false).text('Update Accessory');
        },
        error: function() {
            $('#msg').html('<div class="alert alert-danger">Request failed.</div>');
            $submitBtn.prop('disabled', false).text('Update Accessory');
        }
    });
});

$('#accBrand').change(function(){
    let id = $(this).val();
    if (!id) {
        $('#accModel').html('<option value="">Select</option>');
        return;
    }

    $.get("<?= base_url('admin/cars/models_by_brand') ?>?brand_id="+id, function(res){
        let data = JSON.parse(res);
        let html = '<option value="">Select</option>';
        data.forEach(function(m){
            html += `<option value="${m.id}">${m.name}</option>`;
        });
        $('#accModel').html(html);
    });
});

function deleteAccessoryImage(imageId) {
    if (!confirm('Are you sure you want to delete this image?')) return;
    
    $.ajax({
        url: "<?= base_url('admin/accessories/delete-image/') ?>" + imageId,
        type: "POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(res) {
            let r = JSON.parse(res);
            if (r.status) {
                location.reload();
            } else {
                alert('Failed to delete image');
            }
        },
        error: function() {
            alert('Error deleting image');
        }
    });
}
</script>
