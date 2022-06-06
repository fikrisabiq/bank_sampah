<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<form action="/tranksaksi/checkKeluar/<?= user_id(); ?>" method="POST">
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
<form action="/tranksaksi/tambahKeluar" method="POST">
    <input type="hidden" name="user" value="<?= user_id(); ?>">
    <div class="table-wrapper-scroll-y my-custom-scrollbar">

        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Stok</th>
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
                            <td id="nama"><?= $h['nama']; ?></td>
                            <td><?= $h['nama_kategori']; ?></td>
                            <td><?= $h['harga_jual']; ?></td>
                            <td id="stok"><?= $h['jumlah']; ?> KG</td>
                            <td><input type="number" min="1" max="<?= $h['jumlah']; ?>" name="jumlah[]" id="jumlah" class="jumlah-keluar angka" data-nama="<?= $h['nama']; ?>" required> KG</td>
                            <td><input type="number" readonly id="totalMasuk" class="totalMasuk" name="total[]"></td>
                            <td><a href="/tranksaksi/hapuskeluar/<?= $h['id_keluar']; ?>" class="btn btn-danger" style="border-radius: 50%;">X</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
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