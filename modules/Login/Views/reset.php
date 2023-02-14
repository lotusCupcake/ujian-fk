<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h1><?= lang('Auth.resetYourPassword') ?></h1>
<p class="auth-subtitle mb-5">
    <?= lang('Auth.enterCodeEmailPassword') ?>
</p>
<?= view('\Modules\Login\Views\_message_block') ?>
<form action="<?= route_to('reset-password') ?>" method="POST">
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="text" name="token" class="form-control form-control-xl <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>" />
        <div class="form-control-icon">
            <i class="bi bi-regex"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.token') ?>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" name="email" class="form-control form-control-xl <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" />
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.email') ?>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" name="password" class="form-control form-control-xl  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.newPassword') ?>" />
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.password') ?>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" name="pass_confirm" class="form-control form-control-xl <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.newPasswordRepeat') ?>" />
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.pass_confirm') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
        <?= lang('Auth.resetPassword') ?>
    </button>
</form>

<?= $this->endSection() ?>