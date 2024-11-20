<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <div class="title-about">
        <h2 class="dash-title">Produtos</h2>
        <a href="/newproduct" class="btn btn-primary">Novo Produto</a>
    </div>
    <?php
        if (isset($_SESSION['error'])) {
            echo flash('error', 'error');
        }

        if (isset($_SESSION['success'])) {
            echo flash('success', 'success');
        }
    ?>
    <div class="table-container">
        <div class="table-header">
        <form class="form-s" action="/products">
            <input type="search" placeholder="Buscar pelo nome" name="search" id="search" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <table class="table">
        <thead>
            <tr>
            <th>#</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>SubCategoria</th>
            <th>Editar</th>
            <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\count($products) > 0): ?>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?= $product->id ?></td>
                        <td>
                            <div class="product_image">
                                <img src="<?= $product->image ?>" alt="Product" />
                            </div>
                        </td>
                        <td><?= $product->nome ?></td>
                        <td><?= number_format($product->preco, 2, ',', '.') ?> Kz</td>
                        <td><?= $product->quantidade ?></td>
                        <td>
                            <?php foreach($categories as $category): ?>
                                <?php if($category->id == $product->idcategoria): ?>
                                    <?= $category->nome ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach($subcategories as $subcategory): ?>
                                <?php if($subcategory->id == $product->idsubcategoria): ?>
                                    <?= $subcategory->nome ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td> <a class="edit" href="/editproduct?id=<?= $product->id ?>"><i class="fa fa-edit"></i></a> </td>
                        <td> 
                            <form action="/delete/product/<?= $product->id ?>" method="post">
                                <button type="submit">
                                <span class="danger" >
                                    <i class="fa fa-delete-left"></i>
                                </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <h2>Nenhum Produto encontrado</h2>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>
        <div class="table-body">
            <?= $pagination->links(); ?>
        </div>
    </div>
    <?php $this->insert('admin/partials/footer') ?>
<?= $this->stop(); ?>