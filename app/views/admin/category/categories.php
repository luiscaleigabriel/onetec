<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <div class="title-about">
        <h2 class="dash-title">Categorias</h2>
        <a href="/newcategory" class="btn btn-primary">Nova Categoria</a>
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
        <form class="form-s" action="/categories">
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
            <th>Editar</th>
            <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\count($categories) > 0): ?>
                <?php foreach($categories as $category): ?>
                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->nome ?></td>
                        <td><?= $category->slug ?></td>
                        <td> <a class="edit" href="/editcategory?id=<?= $category->id ?>"><i class="fa fa-edit"></i></a> </td>
                        <td> 
                            <form action="/delete/category/<?= $category->id ?>" method="post">
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
                    <h2>Nenhuma Categoria encontrada</h2>
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