<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Barang : <?= $jenis_barang; ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Total Barang : <?= $total_barang; ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Kategori : <?= $kategori; ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Admin : <?= $admin; ?></h5>
    </div>
</div>
<br>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Tranksaksi Masuk : <?= $masuk; ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Tranksaksi Keluar : <?= $keluar; ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Semua Tranksaksi : <?= $tranksaksi; ?></h5>
    </div>
</div>
<br>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Barang yang Tranksaksi Masuk : <?= $masuk_jumlah; ?> KG</h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Barang yang Tranksaksi Keluar : <?= $keluar_jumlah; ?> KG</h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Jumlah Barang yang Semua Tranksaksi : <?= $tranksaksi_jumlah; ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Total Tranksaksi Masuk : <?= "Rp " . number_format($masuk_sum, 0, ',', '.'); ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Total Tranksaksi Keluar : <?= "Rp " . number_format($keluar_sum, 0, ',', '.'); ?></h5>
    </div>
</div>
<div class="card kartu">
    <div class="card-body">
        <h5 class="card-title">Total Semua Tranksaksi : <?= "Rp " . number_format($tranksaksi_sum, 0, ',', '.'); ?></h5>
    </div>
</div>
<?= $this->endSection(); ?>