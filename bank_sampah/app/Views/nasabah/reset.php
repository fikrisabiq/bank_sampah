<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?= view('\Myth\Auth\Views\_message_block') ?>

<form action="<?= base_url(); ?>/nasabah/res/<?= $nasabah['id']; ?>" class="user" method="post">
    <?= csrf_field() ?>

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" name="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
        </div>

        <div class="col-sm-6">
            <input type="password" name="pass_confirm" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
        </div>
    </div>

    <br>

    <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>

</form>

<?= $this->endSection() ?>