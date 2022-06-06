<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<form action="/kategori/save">
    <?= csrf_field(); ?>
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
            <?php if ($validation->hasError('nama')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
</form>
<?= $this->endSection(); ?>