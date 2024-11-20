<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OneTec</title>
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <?= $this->section('css_swip'); ?>
  <link rel="stylesheet" href="assets/css/style.css" />
  <?= $this->section('css'); ?>
</head>
<body>
  <?php $this->insert('partials/header') ?>

  <?= $this->section('main'); ?>

  <?php $this->insert('partials/footer') ?>

  <?= $this->section('js'); ?>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/cart.js"></script>

</body>
</html>