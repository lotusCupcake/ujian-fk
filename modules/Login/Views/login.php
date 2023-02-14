<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h1>Sign in</h1>
<p class="auth-subtitle mb-5">
	Log in with your data that you entered during registration.
</p>
<?= view('\Modules\Login\Views\_message_block') ?>

<form action="<?= route_to('login') ?>" method="post">
	<?php if ($config->validFields === ['email']) : ?>
		<div class="form-group position-relative has-icon-left mb-4">
			<input type="text" class="form-control form-control-xl <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" name="login" />
			<div class="form-control-icon">
				<i class="bi bi-person"></i>
			</div>
			<div class="invalid-feedback">
				<?= session('errors.login') ?>
			</div>
		</div>
	<?php else : ?>
		<div class="form-group position-relative has-icon-left mb-4">
			<input type="text" class="form-control form-control-xl <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.emailOrUsername') ?>" name="login" />
			<div class="form-control-icon">
				<i class="bi bi-person"></i>
			</div>
			<div class="invalid-feedback">
				<?= session('errors.login') ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="form-group position-relative has-icon-left mb-4">
		<input type="password" name="password" class="form-control form-control-xl <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" />
		<div class="form-control-icon">
			<i class="bi bi-shield-lock"></i>
		</div>
		<div class="invalid-feedback">
			<?= session('errors.password') ?>
		</div>
	</div>
	<?php if ($config->allowRemembering) : ?>
		<div class="form-check form-check-lg d-flex align-items-end">
			<input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" name="password" <?php if (old('remember')) : ?> checked <?php endif ?> />
			<label class="form-check-label text-gray-600" for="flexCheckDefault">
				<?= lang('Auth.rememberMe') ?>
			</label>
		</div>
	<?php endif; ?>
	<button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
		Sign in
	</button>
</form>
<div class="text-center mt-5 text-lg fs-4">
	<?php if ($config->allowRegistration) : ?>
		<p class="text-gray-600">
			Don't have an account?
			<a href="<?= route_to('register') ?>" class="font-bold">Sign up.</a>
		</p>
	<?php endif; ?>
	<?php if ($config->activeResetter) : ?>
		<p>
			<a class="font-bold" href="<?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
		</p>
	<?php endif; ?>
</div>

<?= $this->endSection() ?>