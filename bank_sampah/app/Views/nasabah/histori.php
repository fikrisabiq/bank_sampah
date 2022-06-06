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
                    <th>Total</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Waktu</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($histori as $h) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= "Rp " . number_format($h['total'], 0, ',', '.'); ?></td>
                        <td><?= $h['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>