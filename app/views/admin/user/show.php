<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <div class="title-about">
        <h2 class="dash-title">Usuários</h2>
        <a href="/newuser" class="btn btn-primary">Novo Usuário</a>
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
        <form class="form-s" action="/users">
            <input type="search" placeholder="Buscar pelo nome" name="search" id="search" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Acesso</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\count($users) > 0): ?>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->nome ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->telefone ?></td>
                        <td><?= $user->acesso ?></td>
                        <td> <a class="edit" href="/edituser?id=<?= $user->id ?>"><i class="fa fa-edit"></i></a> </td>
                        <td> 
                            <?php if($user->acesso != 'admin'): ?>
                                <form action="/delete/user/<?= $user->id ?>" method="post">
                                <button type="submit">
                                <span class="danger" >
                                    <i class="fa fa-delete-left"></i>
                                </span>
                                </button>
                            </form>
                            <?php endif; ?>
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