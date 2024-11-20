<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    
    <div class="title-about">
        <h2 class="dash-title">Nova Categoria</h2>
        <a href="/categories" class="btn btn-primary">Voltar</a>
    </div>
    <?php
        if (isset($_SESSION['error'])) {
            echo flash('error', 'error');
        }

        if (isset($_SESSION['success'])) {
            echo flash('success', 'success');
        }
    ?>
    <form class="form-master" action="/new/category" method="post">
        <div class="form-group-group">
            <?= getToken() ?>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="<?= (isset($_SESSION['nome'])) ? 'validation-error' : '';  ?>" type="text" name="nome" id="nome" placeholder="Nome da categoria" />
                <?= (isset($_SESSION['nome'])) ? "<span class='validation-error'>{$_SESSION['nome']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" disabled name="slug" id="slug" placeholder="Slug" />
            </div>
        </div>
        <div class="form-group">
            <button class="btn-submit" type="submit">Criar</button>
        </div>
    </form>
<?php
    unset($_SESSION['nome']);
?>
<?= $this->stop(); ?>