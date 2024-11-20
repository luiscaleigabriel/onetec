<?php $this->layout('master') ?>

<?php $this->start('css'); ?>
  <link rel="stylesheet" href="assets/css/login.css" />
<?php $this->stop(); ?>

<?php $this->start('main'); ?>

  <?php
    if (isset($_SESSION['error'])) {
      echo flash('error', 'error');
    }
    if (isset($_SESSION['success'])) {
      echo flash('success', 'success');
    }
?>
  
  <main class="main-container">
    <div class="main-container-content">
      <div class="main-container--image">
        <img src="assets/images/auth-image.png" alt="Login" />
      </div>
      <div class="main-container--form">
        <form action="/auth" method="post" class="form">
          <div class="form-text">
            <h2>Benvindo de volta</h2>
            <p>Informe os seus dados de acesso</p>
          </div>
          <?= getToken() ?>
          <div class="form-group">
            <input class="<?= (isset($_SESSION['email'])) ? 'validation-error' : '';  ?>" type="email" name="email" id="email" placeholder="Email" />
            <?= (isset($_SESSION['email'])) ? "<span class='validation-error'>{$_SESSION['email']}</span>" : '';  ?>
          </div>
          <div class="form-group">
            <input class="<?= (isset($_SESSION['senha'])) ? 'validation-error' : '';  ?>" type="password" name="senha" id="senha" placeholder="Senha" />
            <?= (isset($_SESSION['senha'])) ? "<span class='validation-error'>{$_SESSION['senha']}</span>" : '';  ?>
          </div>
          <div class="form-group-btn">
            <button type="submit" class="btn-primary">Entrar</button>
            <a href="#">Esqueceu a senha?</a>
          </div>
          <p class="p">
            Você não tem uma conta? <a href="/register">Criar</a>
          </p>
        </form>
      </div>
    </div>
  </main>
  <?php
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
  ?>
<?php $this->stop(); ?>
  


