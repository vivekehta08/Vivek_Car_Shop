<h1 class="h3 mb-4">Add Banner</h1>
<?= form_open_multipart('admin/settings/add_banner') ?>
<div class="mb-3"><label class="form-label">Title</label><input type="text" name="title" class="form-control"></div>
<div class="mb-3"><label class="form-label">Image *</label><input type="file" name="image" class="form-control" required accept="image/*"></div>
<div class="mb-3"><label class="form-label">Link URL</label><input type="text" name="link_url" class="form-control" placeholder="Optional"></div>
<div class="mb-3"><label class="form-label">Display Order</label><input type="number" name="display_order" class="form-control" value="0"></div>
<button type="submit" name="submit" class="btn btn-primary">Add Banner</button>
<a href="<?= base_url('admin/settings/banners') ?>" class="btn btn-secondary">Cancel</a>
<?= form_close() ?>
