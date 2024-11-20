<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OneTec</title>
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <main class="notfound">
    <h2>404</h2>
    <h2>Página não encontrada</h2>
    <p>A página solicitada não existe!</p>
    <a href="<?= $_SESSION['redirect']['previous'] ?>" class="btn-primary">Voltar</a>
  </main>


  <script src="assets/js/app.js"></script>
  <script src="assets/js/cart.js"></script>
</body> 
</html>   