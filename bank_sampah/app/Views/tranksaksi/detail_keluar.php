<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<a href="/tranksaksi/keluars" class="btn btn-primary">Kembali</a>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Table Data Histori Tranksaksi</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Kategori</th>
                    <th>Berat</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Kategori</th>
                    <th>Berat</th>
                    <th>Total</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($tranksaksi as $t) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $t['barang']; ?></td>
                        <td><?= $t['kategori']; ?></td>
                        <td><?= $t['jumlah']; ?> KG</td>
                        <td><?= "Rp " . number_format($t['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>