<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?= view('\Myth\Auth\Views\_message_block') ?>

<form action="<?= base_url(); ?>/nasabah/update/<?= $nasabah['id']; ?>" class="user" method="post">
    <?= csrf_field() ?>

    <input type="hidden" name="usernameLama" value="<?= $nasabah['username']; ?>">
    <input type="hidden" name="emailLama" value="<?= $nasabah['email']; ?>">
    <input type="hidden" name="atmLama" value="<?= $nasabah['atm']; ?>">

    <div class="form-group row">
        <div class="col-sm-12">
            <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= (old('email')) ? old('email') : $nasabah['email'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= (old('username')) ? old('username') : $nasabah['username'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <input type="text" class="form-control form-control-user <?= ($validation->hasError('atm')) ? 'is-invalid' : ''; ?>" name="atm" placeholder="No Rekening" value="<?= (old('atm')) ? old('atm') : $nasabah['atm'] ?>">
            <?php if ($validation->hasError('atm')) : ?>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    <?= $validation->getError('atm'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>

</form>

<?= $this->endSection() ?>