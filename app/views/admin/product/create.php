<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    
    <div class="title-about">
        <h2 class="dash-title">Novo Produto</h2>
        <a href="/products" class="btn btn-primary">Voltar</a>
    </div>
    <?php
        if (isset($_SESSION['error'])) {
            echo flash('error', 'error');
        }

        if (isset($_SESSION['success'])) {
            echo flash('success', 'success');
        }
    ?>
    <form class="form-master" action="/new/product" method="post" enctype="multipart/form-data" >
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
            <label for="descricao">Descrição</label>
            <textarea class="<?= (isset($_SESSION['descricao'])) ? 'validation-error' : '';  ?>" name="descricao" id="descricao" placeholder="Descrição do Produto"></textarea>
            <?= (isset($_SESSION['descricao'])) ? "<span class='validation-error'>{$_SESSION['descricao']}</span>" : '';  ?>
        </div>
        <br />
        <div class="form-group-group">
            <div class="form-group">
                <label for="preco">Preço</label>
                <input class="<?= (isset($_SESSION['preco'])) ? 'validation-error' : '';  ?>" type="number" name="preco" id="preco" placeholder="Preço do Produto" />
                <?= (isset($_SESSION['preco'])) ? "<span class='validation-error'>{$_SESSION['preco']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="preco_anterior">Preço Anterior</label>
                <input class="<?= (isset($_SESSION['preco_anterior'])) ? 'validation-error' : '';  ?>" type="number" name="preco_anterior" id="preco_anterior" placeholder="Preço de Comparação" />
                <?= (isset($_SESSION['preco_anterior'])) ? "<span class='validation-error'>{$_SESSION['preco_anterior']}</span>" : '';  ?>
            </div>
        </div>
        <br />
        <div class="form-group-group">
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input class="<?= (isset($_SESSION['quantidade'])) ? 'validation-error' : '';  ?>" type="number" name="quantidade" id="quantidade" placeholder="Quantidade em Estoque" />
                <?= (isset($_SESSION['quantidade'])) ? "<span class='validation-error'>{$_SESSION['quantidade']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="popular">Popular</label>
                <select name="popular" id="popular" >
                    <option  value="1"  >Sim</option>
                    <option selected  value="0"  >Não</option>
                </select>
            </div>
        </div>
        <br />
        <div class="form-group-group">
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
                <label for="subcategoria">SubCategoria</label>
                <select name="subcategoria" id="subcategoria" >
                <option selected value=""  >Selecione a SubCategoria</option>
                    <?php foreach($subcategories as $subcategory): ?>
                        <option value="<?= $subcategory->id ?>"><?= $subcategory->nome ?></option>
                    <?php endforeach; ?>
                </select>
                <?= (isset($_SESSION['subcategoria'])) ? "<span class='validation-error'>{$_SESSION['subcategoria']}</span>" : '';  ?>
            </div>
        </div>
        <br />
        <br />
        <div class="form-group-image">
            <label id="label" class="file-input" for="image">
                <div id="drop-zone" class="drop-zone">
                    <p>
                        <b>Selecione a imagem do produto</b> ou solte aqui.
                    </p>
                </div>
                <input type="file" name="image" id="image" />
            </label>
            <?= (isset($_SESSION['image'])) ? "<span class='validation-error'>{$_SESSION['image']}</span>" : '';  ?>
        </div>
        <div class="form-group">
            <button class="btn-submit" type="submit">Criar</button>
        </div>
    </form>
<?php
    unset($_SESSION['nome']);
    unset($_SESSION['descricao']);
    unset($_SESSION['preco']);
    unset($_SESSION['preco_anterior']);
    unset($_SESSION['quantidade']);
    unset($_SESSION['categoria']);
    unset($_SESSION['subcategoria']);
    unset($_SESSION['image']);
?>
<?= $this->stop(); ?>