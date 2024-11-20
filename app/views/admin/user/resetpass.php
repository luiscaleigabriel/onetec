<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    
    <div class="title-about">
        <h2 class="dash-title">Alterar Senha</h2>
        <a href="/dash" class="btn btn-primary">Voltar</a>
    </div>
    <?php
        if (isset($_SESSION['error'])) {
            echo flash('error', 'error');
        }

        if (isset($_SESSION['success'])) {
            echo flash('success', 'success');
        }
    ?>
    <form class="form-master" action="/resetpassword" method="post" enctype="multipart/form-data" >
        <div class="form-group-group">
            <?= getToken() ?>
            <div class="form-group">
                <label for="senha">Senha Actual</label>
                <input class="<?= (isset($_SESSION['senha'])) ? 'validation-error' : '';  ?>" type="password" name="senha" id="senha" placeholder="Senha actual" />
                <?= (isset($_SESSION['senha'])) ? "<span class='validation-error'>{$_SESSION['senha']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="novasenha">Nova senha</label>
                <input class="<?= (isset($_SESSION['novasenha'])) ? 'validation-error' : '';  ?>" type="password" name="novasenha" id="novasenha" placeholder="Nova senha" />
                <?= (isset($_SESSION['novasenha'])) ? "<span class='validation-error'>{$_SESSION['novasenha']}</span>" : '';  ?>
            </div>
        </div>
        <div class="form-group">
            <button class="btn-submit" type="submit">Alterar</button>
        </div>
    </form>
<?php
    unset($_SESSION['senha']);
    unset($_SESSION['novasenha']);
?>
<?= $this->stop(); ?>