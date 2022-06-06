<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<form action="/tranksaksi/checkmasuk/<?= user_id(); ?>" method="POST">
    <div class="form-group row mb-3">
        <label for="kategori" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <select multiple class="chosen-select form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="barang[]">
                <?php foreach ($barang as $b) : ?>
                    <?php if (!in_array($b['nama'], $namaBarang)) : ?>
                        <option value="<?= $b['id']; ?>"><?= $b['nama']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <div class="input-group-append d-inline-block">
                <button class="btn btn-outline-secondary" type="submit">Button</button>
            </div>
        </div>
    </div>
</form>
<form action="/tranksaksi/tambahMasuk" method="POST">
    <?php if (in_groups(1)) : ?>
        <input type="hidden" name="user" value="ada">
    <?php endif; ?>
    <?php if (in_groups(2)) : ?>
        <input type="hidden" name="nama" value="<?= user_id(); ?>">
    <?php endif; ?>
    <div class="table-wrapper-scroll-y my-custom-scrollbar">

        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Total</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($hasil == '') : ?>
                    <tr></tr>
                <?php else : ?>
                    <?php $i = 1;
                    foreach ($hasil as $h) : ?>
                        <input type="hidden" value="<?= $h['id']; ?>" name="barang[]">
                        <tr class="baris">
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $h['nama']; ?></td>
                            <td><?= $h['nama_kategori']; ?></td>
                            <td><?= $h['harga_beli']; ?></td>
                            <td><input type="number" min="1" name="jumlah[]" id="jumlah" class="jumlah angka" data-nama="<?= $h['nama']; ?>" required> KG</td>
                            <td><input type="number" readonly id="totalMasuk" class="totalMasuk" name="total[]" value="<?= old('total[]'); ?>"></td>
                            <td><a href="/tranksaksi/hapusmasuk/<?= $h['id_masuk']; ?>" class="btn btn-danger" style="border-radius: 50%;">X</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    <?= csrf_field(); ?>
    <?php if (in_groups(1)) : ?>
        <div class="form-group row my-4">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <select class="js-example-basic-single <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama">
                    <option value="" <?= (old('nama')) ? '' : 'selected'; ?>>Pilihan Nasabah</option>
                    <?php foreach ($nasabah as $n) : ?>
                        <option value="<?= $n['id']; ?>" <?= ($n['username'] == old('nama')) ? 'selected' : ''; ?>><?= $n['username']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('nama')) : ?>
                    <div id="validationServer04Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group row mb-3">
        <?php if (!empty($hasil)) : ?>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" id="submit">Tambah Data</button>
                <?php if ($validation->hasError('jumlah[]')) : ?>
                    <div id="validationServer04Feedback" class="invalid-feedback d-block">Isi jumlah barang</div>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div id="validationServer04Feedback" class="invalid-feedback d-block">Pilih Barang Terlebih Dahulu</div>
        <?php endif; ?>
    </div>
</form>
<?= $this->endSection(); ?>