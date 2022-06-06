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
                    <th>No Rekening</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>No Rekening</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($nasabah as $n) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $n['email']; ?></td>
                        <td><?= $n['username']; ?></td>
                        <td><?= $n['atm']; ?></td>
                        <td>
                            <a href="/nasabah/reset/<?= $n['id']; ?>" class="btn btn-primary">Reset Password</a>
                            <a href="/nasabah/edit/<?= $n['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/nasabah/<?= $n['id']; ?>" method="post" class="d-inline">
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