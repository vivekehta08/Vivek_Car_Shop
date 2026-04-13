<h1 class="h3 mb-4">Add Accessory</h1>

<div id="msg"></div>

<form id="createForm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Accessory Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat->id ?>"><?= html_escape($cat->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Brand</label>
                <select name="brand_id" class="form-select" id="accBrand">
                    <option value="">Select</option>
                    <?php foreach ($brands as $b): ?>
                    <option value="<?= $b->id ?>"><?= html_escape($b->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Model</label>
                <select name="model_id" class="form-select" id="accModel">
                    <option value="">Select brand first</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Price *</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_available" class="form-check-input" id="isAvailable" value="1" checked>
                <label class="form-check-label" for="isAvailable">Available</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label>Compatible Models</label>
                <textarea name="compatible_models" class="form-control" rows="3" placeholder="e.g. Swift, Baleno"></textarea>
            </div>

            <div class="mb-3">
                <label>Images</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Accessory</button>
    <a href="<?= base_url('admin/accessories') ?>" class="btn btn-secondary">Cancel</a>
</form>

<script>
$('#createForm').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);
    let $submitBtn = $(this).find('button[type="submit"]');
    $submitBtn.prop('disabled', true).text('Saving...');

    $.ajax({
        url: "<?= base_url('admin/accessories/store') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            let r = JSON.parse(res);
            if (r.status) {
                $('#msg').html('<div class="alert alert-success">'+r.message+'</div>');
                $('#createForm')[0].reset();
                $('#accModel').html('<option value="">Select brand first</option>');
            } else {
                $('#msg').html('<div class="alert alert-danger">'+r.errors+'</div>');
            }
            $submitBtn.prop('disabled', false).text('Save Accessory');
        },
        error: function(xhr) {
            $('#msg').html('<div class="alert alert-danger">Request failed.</div>');
            $submitBtn.prop('disabled', false).text('Save Accessory');
        }
    });
});

$('#accBrand').change(function(){
    let id = $(this).val();
    if (!id) {
        $('#accModel').html('<option value="">Select brand first</option>');
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
</script>
