<?php $this->layout('master') ?>

<?php $this->start('css'); ?>
  <link rel="stylesheet" href="assets/css/login.css" />
<?php $this->stop(); ?>

<?php $this->start('main'); ?>

  <?php
    if (isset($_SESSION['error'])) {
      echo flash('error', 'error');
    }
  ?>

<main class="main-container">
    <div class="main-container-content">
      <div class="main-container--image">
        <img src="assets/images/auth-image.png" alt="Login" />
      </div>
      <div class="main-container--form">
        <form action="/register" method="post" class="form">
          <div class="form-text">
            <h2>Crie a sua conta</h2>
            <p>Informe os seus dados</p>
          </div>
          <?= getToken() ?>
          <div class="form-group">
            <input class="<?= (isset($_SESSION['nome'])) ? 'validation-error' : '';  ?>" type="text" name="nome" id="nome" placeholder="Nome" />
            <?= (isset($_SESSION['nome'])) ? "<span class='validation-error'>{$_SESSION['nome']}</span>" : '';  ?>
          </div>
          <div class="form-group">
            <input class="<?= (isset($_SESSION['email'])) ? 'validation-error' : '';  ?>" type="email" name="email" id="email" placeholder="Email" />
            <?= (isset($_SESSION['email'])) ? "<span class='validation-error'>{$_SESSION['email']}</span>" : '';  ?>
          </div>
          <div class="form-group">
            <input class="<?= (isset($_SESSION['senha'])) ? 'validation-error' : '';  ?>" type="password" name="senha" id="senha" placeholder="Senha" />
            <?= (isset($_SESSION['senha'])) ? "<span class='validation-error'>{$_SESSION['senha']}</span>" : '';  ?>
          </div>
          <div style="flex-direction: column;" class="form-group-btn">
            <button style="width: 100%;" type="submit" class="btn-primary">Criar Conta</button>
          </div>
          <p class="p">
            Você já tem uma conta? <a href="/login">Entrar</a>
          </p>
        </form>
      </div>
    </div>
  </main>

  <?php
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
  ?>

<?php $this->stop(); ?>