<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Table Data Barang</h6>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Diupdate</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Diupdate</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
        <tbody>
            <?php $i = 1;
            foreach ($barang as $b) : ?>
                <tr>
                    <th><?= $i++; ?></th>
                    <td><?= $b['nama']; ?></td>
                    <td><?= $b['nama_kategori']; ?></td>
                    <td><?= $b['jumlah']; ?> KG</td>
                    <td><?= $b['harga_jual']; ?></td>
                    <td><?= $b['harga_beli']; ?></td>
                    <td><?= $b['updated_at']; ?></td>
                    <td>
                        <a href="/barang/edit/<?= $b['nama']; ?>" class="btn btn-warning">Edit</a>
                        <form action="/barang/<?= $b['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>