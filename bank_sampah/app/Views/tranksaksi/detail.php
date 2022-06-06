<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<a href="/tranksaksi" class="btn btn-primary">Kembali</a>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Table Data Tranksaksi</h6>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total</th>
            </tr>
        </tfoot>
        <tbody>
            <?php $i = 1;
            foreach ($detail as $d) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $d['barang']; ?></td>
                    <td><?= $d['kategori']; ?></td>
                    <td><?= $d['jumlah']; ?></td>
                    <td><?= $d['total']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>