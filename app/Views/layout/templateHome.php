<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title . " | " . lang('Auth.appName'); ?></title>
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/main/app.css" />
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/main/app-dark.css" />
  <link rel="shortcut icon" href="<?= base_url() ?>/template/assets/images/logo/favicon.ico" type="image/x-icon" />
</head>


<body>

  <div id="app">
    <?= $this->renderSection('content'); ?>
  </div>

  <script src="<?= base_url() ?>/template/assets/js/bootstrap.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/app.js"></script>

</body>

</html>