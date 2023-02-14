<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h1>Sign Up</h1>
<p class="auth-subtitle mb-5">
    Input your data to register to our website.
</p>
<?= view('\Modules\Login\Views\_message_block') ?>
<form action="<?= route_to('register') ?>" method="POST">
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
        <input type="text" name="username" class="form-control form-control-xl <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" />
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.username') ?>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" name="password" class="form-control form-control-xl  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" />
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.password') ?>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" name="pass_confirm" class="form-control form-control-xl <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" />
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <div class="invalid-feedback">
            <?= session('errors.pass_confirm') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
        Sign Up
    </button>
</form>
<div class="text-center mt-5 text-lg fs-4">
    <p class="text-gray-600">
        <?= lang('Auth.alreadyRegistered') ?>
        <a href="<?= route_to('login') ?>" class="font-bold"><?= lang('Auth.signIn') ?></a>.
    </p>
</div>

<?= $this->endSection() ?>