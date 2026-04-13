<h1 class="h3 mb-4">Add Car</h1>

<div id="msg"></div>

<form id="createForm" enctype="multipart/form-data">
    <div class="row">

        <div class="col-md-6">

            <div class="mb-3">
                <label>Brand *</label>
                <select name="brand_id" class="form-select" id="brandId" required>
                    <option value="">Select</option>
                    <?php foreach ($brands as $b): ?>
                    <option value="<?= $b->id ?>"><?= $b->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Model *</label>
                <select name="model_id" class="form-select" id="modelId" required>
                    <option value="">Select brand first</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Variant</label>
                <input type="text" name="variant" class="form-control">
            </div>

            <div class="mb-3">
                <label>Year *</label>
                <input type="number" name="year" class="form-control" value="<?= date('Y') ?>" required>
            </div>

            <div class="mb-3">
                <label>Fuel Type *</label>
                <select name="fuel_type_id" class="form-select">
                    <?php foreach ($fuel_types as $f): ?>
                    <option value="<?= $f->id ?>"><?= $f->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Transmission *</label>
                <select name="transmission_id" class="form-select">
                    <?php foreach ($transmissions as $t): ?>
                    <option value="<?= $t->id ?>"><?= $t->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Mileage</label>
                <input type="text" name="mileage" class="form-control">
            </div>

            <div class="mb-3">
                <label>Price *</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>City *</label>
                <select name="city_id" class="form-select">
                    <?php foreach ($cities as $c): ?>
                    <option value="<?= $c->id ?>"><?= $c->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <div class="col-md-6">

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label>Seller Name</label>
                <input type="text" name="seller_name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Seller Phone</label>
                <input type="text" name="seller_phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Seller Email</label>
                <input type="email" name="seller_email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

        </div>

    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Save Car</button>
        <a href="<?= base_url('admin/cars') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script>
$('#createForm').submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);
    let $submitBtn = $(this).find('button[type="submit"]');
    $submitBtn.prop('disabled', true).text('Saving...');

    $.ajax({
        url: "<?= base_url('admin/cars/store') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            let r = JSON.parse(res);

            if(r.status){
                $('#msg').html('<div class="alert alert-success">'+r.message+'</div>');
                $('#createForm')[0].reset();
                $submitBtn.prop('disabled', false).text('Save Car');
            }else{
                $('#msg').html('<div class="alert alert-danger">'+r.errors+'</div>');
                $submitBtn.prop('disabled', false).text('Save Car');
            }
        },
        error: function(){
            $('#msg').html('<div class="alert alert-danger">Request failed</div>');
            $submitBtn.prop('disabled', false).text('Save Car');
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
</script>