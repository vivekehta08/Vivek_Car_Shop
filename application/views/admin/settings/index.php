<h1 class="h3 mb-4">Settings</h1>
<?= form_open_multipart('admin/settings') ?>
<div class="card mb-4">
    <div class="card-header"><strong>WhatsApp</strong></div>
    <div class="card-body">
        <div class="mb-3"><label class="form-label">WhatsApp Number (with country code, no +)</label>
            <input type="text" name="whatsapp_number" class="form-control" value="<?= html_escape($settings['whatsapp_number']??'') ?>" placeholder="919876543210">
        </div>
        <div class="mb-3"><label class="form-label">Default Message Template</label>
            <textarea name="whatsapp_message" class="form-control" rows="2"><?= html_escape($settings['whatsapp_message']??'') ?></textarea>
            <small class="text-muted">Use {item_name} for car/accessory name</small>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header"><strong>General</strong></div>
    <div class="card-body">
        <div class="mb-3"><label class="form-label">Site Name</label><input type="text" name="site_name" class="form-control" value="<?= html_escape($settings['site_name']??'') ?>"></div>
        <div class="mb-3"><label class="form-label">Logo</label><input type="file" name="site_logo" class="form-control" accept="image/*"></div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header"><strong>SEO</strong></div>
    <div class="card-body">
        <div class="mb-3"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="<?= html_escape($settings['meta_title']??'') ?>"></div>
        <div class="mb-3"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="2"><?= html_escape($settings['meta_description']??'') ?></textarea></div>
        <div class="mb-3"><label class="form-label">Meta Keywords</label><input type="text" name="meta_keywords" class="form-control" value="<?= html_escape($settings['meta_keywords']??'') ?>"></div>
    </div>
</div>
<button type="submit" name="submit" class="btn btn-primary">Save Settings</button>
<?= form_close() ?>
<p class="mt-3"><a href="<?= base_url('admin/settings/banners') ?>">Manage Homepage Banners →</a></p>
