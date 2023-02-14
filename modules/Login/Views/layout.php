<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang('Auth.appName'); ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/main/app.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/pages/auth.css" />
    <link rel="shortcut icon" href="<?= base_url() ?>/template/assets/images/logo/favicon.ico" type="image/x-icon" />
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="<?= base_url() ?>/template/assets/images/logo/logo.png" alt="Logo" /></a>
                    </div>
                    <?= $this->renderSection('main') ?>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <!-- <div id="auth-right"></div> -->
                <img src="<?= base_url() ?>/template/assets/images/bg/bg-login.png" alt="Logo" width="100%">
            </div>
        </div>
    </div>
</body>

</html>