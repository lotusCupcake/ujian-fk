<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h1><?= lang('Auth.forgotPassword') ?></h1>
<p class="auth-subtitle mb-5">
    Input your email and we will send you reset password link.
</p>
<?= view('\Modules\Login\Views\_message_block') ?>

<form action="<?= route_to('forgot') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" name="email" class="form-control form-control-xl <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" />
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.email') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
        <?= lang('Auth.sendInstructions') ?>
    </button>
</form>
<div class="text-center mt-5 text-lg fs-4">
    <p class="text-gray-600">
        Remember your account?
        <a href="<?= route_to('login') ?>" class="font-bold"><?= lang('Auth.signIn') ?></a>.
    </p>
</div>

<?= $this->endSection() ?>