<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<form action="/barang/save" method="POST">
    <?= csrf_field(); ?>
    <div class="form-group row mb-3">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
            <?php if ($validation->hasError('nama')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
        <div class="col-sm-10">
            <input type="number" min="1" class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" value="<?= old('harga_jual'); ?>">
            <?php if ($validation->hasError('harga_jual')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('harga_jual'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
        <div class="col-sm-10">
            <input type="number" min="1" class="form-control <?= ($validation->hasError('harga_beli')) ? 'is-invalid' : ''; ?>" id="harga_beli" name="harga_beli" value="<?= old('harga_beli'); ?>">
            <?php if ($validation->hasError('harga_beli')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('harga_beli'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <label for="kategori">Pilih Kategori</label>
            <select multiple class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori">
                <?php foreach ($kategori as $k) : ?>
                    <option value="<?= $k['id']; ?>" <?= ($k['id'] == old('kategori')) ? 'selected' : ''; ?>><?= $k['nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if ($validation->hasError('kategori')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('kategori'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row mb-3">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>