<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <div class="title-about">
        <h2 class="dash-title">SubCategorias</h2>
        <a href="/newsubcategory" class="btn btn-primary">Nova SubCategoria</a>
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
        <form class="form-s" action="/subcategories">
            <input type="search" placeholder="Buscar pelo nome" name="search" id="search" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <table class="table">
        <thead>
            <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Slug</th>
            <th>Categoria</th>
            <th>Editar</th>
            <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\count($subcategories) > 0): ?>
                <?php foreach($subcategories as $subcategory): ?>
                    <tr>
                        <td><?= $subcategory->id ?></td>
                        <td><?= $subcategory->nome ?></td>
                        <td><?= $subcategory->slug ?></td>
                        <td>
                            <?php foreach($categories as $category): ?>
                                <?php if($category->id == $subcategory->idcategoria): ?>
                                    <?= $category->nome ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td> <a class="edit" href="/editsubcategory?id=<?= $subcategory->id ?>"><i class="fa fa-edit"></i></a> </td>
                        <td> 
                            <form action="/delete/subcategory/<?= $subcategory->id ?>" method="post">
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
                    <h2>Nenhuma SubCategoria encontrada</h2>
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