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
                    <th>Email</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($admin as $a) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $a['email']; ?></td>
                        <td><?= $a['username']; ?></td>
                        <td>
                            <a href="/admin/reset/<?= $a['id']; ?>" class="btn btn-primary">Reset Password</a>
                            <a href="/admin/edit/<?= $a['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/admin/<?= $a['id']; ?>" method="post" class="d-inline">
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
</div>
<?= $this->endSection(); ?>