<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home / </span>Minha Conta 
    </p>
</div>

<?php
    if (isset($_SESSION['error'])) {
      echo flash('error', 'error');
    }
    
    if (isset($_SESSION['success'])) {
      echo flash('success', 'success');
    }
?>

<section class="acount container">
    <?php $this->insert('partials/userpaine') ?>
    <div class="acout-form">
      <h3>Alterar Senha</h3>
      <form action="/resetpass" method="post" class="form">
      <?= getToken() ?>
        <div class="form-group">
          <label for="senha">Senha Anterior</label>
          <input class="<?= (isset($_SESSION['senha'])) ? 'validation-error' : '';  ?>"  type="password" name="senha" id="senha" />
          <?= (isset($_SESSION['senha'])) ? "<span class='validation-error'>{$_SESSION['senha']}</span>" : '';  ?>
        </div>
        <div class="form-group">
          <label for="novasenha">Nova Senha</label>
          <input class="<?= (isset($_SESSION['novasenha'])) ? 'validation-error' : '';  ?>"  type="password" name="novasenha" id="novasenha" />
          <?= (isset($_SESSION['novasenha'])) ? "<span class='validation-error'>{$_SESSION['novasenha']}</span>" : '';  ?>
        </div>
        <div class="form-btns">
          <button class="btn-primary" type="submit">Savar Alterações</button>
        </div>
      </form>
    </div>
</section>

<?php
    unset($_SESSION['senha']);
    unset($_SESSION['novasenha']);
  ?>

<?php $this->stop(); ?>