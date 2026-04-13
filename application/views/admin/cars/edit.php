<h1 class="h3 mb-4">Edit Car</h1>

<div id="msg"></div>

<form id="editForm" enctype="multipart/form-data">
    <div class="row">

        <div class="col-md-6">

            <div class="mb-3">
                <label>Brand *</label>
                <select name="brand_id" class="form-select" id="brandId">
                    <?php foreach ($brands as $b): ?>
                    <option value="<?= $b->id ?>" <?= $car->brand_id==$b->id?'selected':'' ?>>
                        <?= $b->name ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Model *</label>
                <select name="model_id" class="form-select" id="modelId">
                    <?php foreach ($models as $m): ?>
                    <option value="<?= $m->id ?>" <?= $car->model_id==$m->id?'selected':'' ?>>
                        <?= $m->name ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Variant</label>
                <input type="text" name="variant" class="form-control" value="<?= $car->variant ?>">
            </div>

            <div class="mb-3">
                <label>Year *</label>
                <input type="number" name="year" class="form-control" value="<?= $car->year ?>">
            </div>

            <div class="mb-3">
                <label>Fuel Type</label>
                <select name="fuel_type_id" class="form-select">
                    <?php foreach ($fuel_types as $f): ?>
                    <option value="<?= $f->id ?>" <?= $car->fuel_type_id==$f->id?'selected':'' ?>>
                        <?= $f->name ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Transmission</label>
                <select name="transmission_id" class="form-select">
                    <?php foreach ($transmissions as $t): ?>
                    <option value="<?= $t->id ?>" <?= $car->transmission_id==$t->id?'selected':'' ?>>
                        <?= $t->name ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Mileage</label>
                <input type="text" name="mileage" class="form-control" value="<?= $car->mileage ?>">
            </div>

            <div class="mb-3">
                <label>Price *</label>
                <input type="number" name="price" class="form-control" value="<?= $car->price ?>">
            </div>

            <div class="mb-3">
                <label>City</label>
                <select name="city_id" class="form-select">
                    <?php foreach ($cities as $c): ?>
                    <option value="<?= $c->id ?>" <?= $car->city_id==$c->id?'selected':'' ?>>
                        <?= $c->name ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <div class="col-md-6">

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"><?= $car->description ?></textarea>
            </div>

            <div class="mb-3">
                <label>Seller Name</label>
                <input type="text" name="seller_name" class="form-control" value="<?= $car->seller_name ?>">
            </div>

            <div class="mb-3">
                <label>Seller Phone</label>
                <input type="text" name="seller_phone" class="form-control" value="<?= $car->seller_phone ?>">
            </div>

            <div class="mb-3">
                <label>Seller Email</label>
                <input type="email" name="seller_email" class="form-control" value="<?= $car->seller_email ?>">
            </div>

            <div class="mb-3">
                <label>New Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <?php if(!empty($car_images)): ?>
            <div class="mb-3">
                <label>Current Images</label>
                <div class="d-flex gap-2 flex-wrap">
                    <?php foreach($car_images as $img): ?>
                    <div class="position-relative" style="width:90px;">
                        <img src="<?= base_url($img->image_path) ?>" width="90" style="border:1px solid #ddd;" class="d-block">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" style="padding:2px 5px; font-size:12px;" onclick="deleteCarImage(<?= $img->id ?>)">×</button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>

    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Update Car</button>
        <a href="<?= base_url('admin/cars') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script>
$('#editForm').submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);
    let $submitBtn = $(this).find('button[type="submit"]');
    $submitBtn.prop('disabled', true).text('Updating...');

    $.ajax({
        url: "<?= base_url('admin/cars/update/'.$car->id) ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            let r = JSON.parse(res);

            if(r.status){
                $('#msg').html('<div class="alert alert-success">'+r.message+'</div>');
            }else{
                $('#msg').html('<div class="alert alert-danger">'+r.errors+'</div>');
            }
            $submitBtn.prop('disabled', false).text('Update Car');
        },
        error: function(){
            $('#msg').html('<div class="alert alert-danger">Request failed</div>');
            $submitBtn.prop('disabled', false).text('Update Car');
        }
    });
});
</script>

<script>
$('#brandId').change(function(){
    let id = $(this).val();

    $.get("<?= base_url('admin/cars/models_by_brand') ?>?brand_id="+id, function(res){

        let data = JSON.parse(res);
        let html = '<option value="">Select</option>';

        data.forEach(function(m){
            html += `<option value="${m.id}">${m.name}</option>`;
        });

        $('#modelId').html(html);
    });
});

function deleteCarImage(imageId) {
    if (!confirm('Are you sure you want to delete this image?')) return;
    
    $.ajax({
        url: "<?= base_url('admin/cars/delete-image/') ?>" + imageId,
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