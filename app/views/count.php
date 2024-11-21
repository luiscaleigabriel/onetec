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
      <h3>Edite Seu Perfil</h3>
      <form action="/acount" method="post" class="form">
      <?= getToken() ?>
        <div class="form-group">
          <label for="nome">Nome</label>
          <input class="<?= (isset($_SESSION['nome'])) ? 'validation-error' : '';  ?>" value="<?= $user->nome ?>" type="text" name="nome" id="nome" />
          <?= (isset($_SESSION['nome'])) ? "<span class='validation-error'>{$_SESSION['nome']}</span>" : '';  ?>
        </div>
        <div class="group">
          <div class="form-group">
            <label for="email">Email</label>
            <input class="<?= (isset($_SESSION['email'])) ? 'validation-error' : '';  ?>" value="<?= $user->email ?>" type="email" name="email" id="email" />
            <?= (isset($_SESSION['email'])) ? "<span class='validation-error'>{$_SESSION['email']}</span>" : '';  ?>
          </div>
          <div class="form-group">
            <label for="telefone">Nº Telefone</label>
            <input class="<?= (isset($_SESSION['telefone'])) ? 'validation-error' : '';  ?>" value="<?= $user->telefone ?>" type="text" name="telefone" id="telefone" />
            <?= (isset($_SESSION['telefone'])) ? "<span class='validation-error'>{$_SESSION['telefone']}</span>" : '';  ?>
          </div>
        </div>
        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input class="<?= (isset($_SESSION['endereco'])) ? 'validation-error' : '';  ?>" value="<?= $user->endereco ?>" type="text" name="endereco" id="endereco" />
          <?= (isset($_SESSION['endereco'])) ? "<span class='validation-error'>{$_SESSION['endereco']}</span>" : '';  ?>
        </div>
        <div class="form-btns">
          <button class="btn-primary" type="submit">Savar Alterações</button>
        </div>
      </form>
    </div>
</section>

<?php
    unset($_SESSION['email']);
    unset($_SESSION['nome']);
    unset($_SESSION['endereco']);
    unset($_SESSION['telefone']);
  ?>

<?php $this->stop(); ?>

<?php $this->start('js'); ?>
<script>
// Máscara para telefone
document.getElementById('telefone').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 12) value = value.slice(0, 12);
    
    if (value.length > 0) {
        value = '(+244) ' + value.slice(3);
    }
    if (value.length > 9) {
        value = value.slice(0,9) + value.slice(9);
    }
    
    e.target.value = value;
});
</script>
<?php $this->stop(); ?>