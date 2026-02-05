<h1 class="h3 mb-4"><?= $accessory ? 'Edit' : 'Add' ?> Accessory</h1>
<?= form_open_multipart($accessory ? 'admin/accessories/edit/'.$accessory->id : 'admin/accessories/add') ?>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required value="<?= $accessory ? html_escape($accessory->name) : '' ?>"></div>
        <div class="mb-3"><label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <option value="">None</option>
                <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat->id ?>" <?= ($accessory && $accessory->category_id==$cat->id) ? 'selected' : '' ?>><?= html_escape($cat->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Brand</label>
            <select name="brand_id" class="form-select" id="accBrand">
                <option value="">None</option>
                <?php foreach ($brands as $b): ?>
                <option value="<?= $b->id ?>" <?= ($accessory && $accessory->brand_id==$b->id) ? 'selected' : '' ?>><?= html_escape($b->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Model</label>
            <select name="model_id" class="form-select" id="accModel">
                <option value="">None</option>
                <?php foreach ($models as $m): ?>
                <option value="<?= $m->id ?>" <?= ($accessory && $accessory->model_id==$m->id) ? 'selected' : '' ?>><?= html_escape($m->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Price (₹) *</label><input type="number" name="price" class="form-control" required value="<?= $accessory ? $accessory->price : '' ?>"></div>
        <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"><?= $accessory ? html_escape($accessory->description) : '' ?></textarea></div>
        <div class="mb-3"><label class="form-label">Compatible Models</label><textarea name="compatible_models" class="form-control" rows="2" placeholder="e.g. Swift, Baleno"><?= $accessory ? html_escape($accessory->compatible_models) : '' ?></textarea></div>
        <div class="mb-3"><div class="form-check"><input type="checkbox" name="is_available" class="form-check-input" value="1" <?= ($accessory && $accessory->is_available) ? 'checked' : '' ?>><label class="form-check-label">Available</label></div></div>
        <div class="mb-3"><label class="form-label">Images</label><input type="file" name="images[]" class="form-control" multiple accept="image/*"></div>
    </div>
</div>
<button type="submit" name="submit" class="btn btn-primary">Save</button>
<a href="<?= base_url('admin/accessories') ?>" class="btn btn-secondary">Cancel</a>
<?= form_close() ?>
<script>
$('#accBrand').change(function(){
    var bid=$(this).val();
    if(!bid){ $('#accModel').html('<option value="">None</option>'); return; }
    $.get('<?= base_url("admin/cars/models_by_brand") ?>?brand_id='+bid, function(d){
        var o='<option value="">None</option>';
        $.each(d, function(i,m){ o+='<option value="'+m.id+'">'+m.name+'</option>'; });
        $('#accModel').html(o);
    });
});
</script>
