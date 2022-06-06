<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Table Data Histori Tranksaksi</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nasabah</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nasabah</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($tranksaksi as $t) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $t['username']; ?></td>
                        <td><?= $t['created_at']; ?></td>
                        <td>
                            <a href="/tranksaksi/detailmasuk/<?= $t['id']; ?>" class="btn btn-success">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>