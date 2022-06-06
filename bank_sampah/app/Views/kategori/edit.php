<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<form action="/kategori/update/<?= $kategori['id']; ?>">
    <div class="row mb-3">
        <?= csrf_field(); ?>
        <input type="hidden" value="<?= $kategori['nama']; ?>" name="namaLama">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= old('nama') ? old('nama') : $kategori['nama']; ?>">
            <?php if ($validation->hasError('nama')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Edit Data</button>
</form>
<?= $this->endSection(); ?>