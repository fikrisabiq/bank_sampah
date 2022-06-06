<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Table Data Kategori Barang</h6>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
        <tbody>
            <?php $i = 1;
            foreach ($kategori as $k) : ?>
                <tr>
                    <th><?= $i++; ?></th>
                    <td><?= $k['nama']; ?></td>
                    <?php if ($k['nama'] == 'Lainnya') : ?>
                        <td></td>
                    <?php else : ?>
                        <td>
                            <a href="/kategori/edit/<?= $k['nama']; ?>" class="btn btn-warning me-4">Edit</a>
                            <form action="/kategori/<?= $k['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>