<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    
    <div class="title-about">
        <h2 class="dash-title">Nova SubCategoria</h2>
        <a href="/subcategories" class="btn btn-primary">Voltar</a>
    </div>
    <?php
        if (isset($_SESSION['error'])) {
            echo flash('error', 'error');
        }

        if (isset($_SESSION['success'])) {
            echo flash('success', 'success');
        }
    ?>
    <form class="form-master" action="/new/subcategory" method="post">
        <div class="form-group-group">
            <?= getToken() ?>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="<?= (isset($_SESSION['nome'])) ? 'validation-error' : '';  ?>" type="text" name="nome" id="nome" placeholder="Nome da Subcategoria" />
                <?= (isset($_SESSION['nome'])) ? "<span class='validation-error'>{$_SESSION['nome']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" disabled name="slug" id="slug" placeholder="Slug" />
            </div>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" >
                <option selected value=""  >Selecione a Categoria</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->nome ?></option>
                <?php endforeach; ?>
            </select>
            <?= (isset($_SESSION['categoria'])) ? "<span class='validation-error'>{$_SESSION['categoria']}</span>" : '';  ?>
        </div>
        <div class="form-group">
            <button class="btn-submit" type="submit">Criar</button>
        </div>
    </form>
<?php
    unset($_SESSION['nome']);
    unset($_SESSION['categoria']);
?>
<?= $this->stop(); ?>