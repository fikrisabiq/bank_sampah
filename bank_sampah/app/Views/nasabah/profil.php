<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h3>Email : <?= $nasabah['email']; ?></h3>
<hr>
<h3>Username : <?= $nasabah['username']; ?></h3>
<hr>
<h3>No Rekening : <?= $nasabah['atm']; ?></h3>
<hr>
<h3>Total Tunai : <?= "Rp " . number_format($tunai['tunai'], 0, ',', '.'); ?></h3>
<hr>
<a href="/nasabah/reset/<?= user_id(); ?>" class="btn btn-primary mt-5">Reset Passowrd</a>
<a href="/nasabah/edit/<?= user_id(); ?>" class="btn btn-warning mt-5">Edit</a>
<a href="/nasabah/tarik" class="btn btn-success mt-5">Tarik Tunai</a>
<?= $this->endSection(); ?>