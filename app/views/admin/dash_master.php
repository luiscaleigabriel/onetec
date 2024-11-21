<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OneTec</title>
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/dash.css" />
</head>
<body>
  <main class="dashboard">
    <?php $this->insert('admin/partials/navbar') ?>

    <div id="dashboard-r" class="dashboard-r">
        <?php $this->insert('admin/partials/menu') ?>

      <!-- -----------------------------
        Conteúdo
      -------------------------------- -->

        <div class="container">
            <?= $this->section('main'); ?>
        </div>

    </div>
  </main>

  <script src="assets/js/dash.js"></script>
  <?= $this->section('js'); ?>
  
</body>
</html>