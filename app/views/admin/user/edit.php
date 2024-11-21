<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    
    <div class="title-about">
        <h2 class="dash-title">Editar Usuário (<?= $user->id ?>)</h2>
        <a href="/users" class="btn btn-primary">Voltar</a>
    </div>
    <?php
        if (isset($_SESSION['error'])) {
            echo flash('error', 'error');
        }

        if (isset($_SESSION['success'])) {
            echo flash('success', 'success');
        }
    ?>
    <form class="form-master" action="/update/user/<?= $user->id ?>" method="post" enctype="multipart/form-data" >
        <div class="form-group-group">
            <?= getToken() ?>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input value="<?= $user->nome ?>" class="<?= (isset($_SESSION['nome'])) ? 'validation-error' : '';  ?>" type="text" name="nome" id="nome" placeholder="Nome da categoria" />
                <?= (isset($_SESSION['nome'])) ? "<span class='validation-error'>{$_SESSION['nome']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?= $user->email ?>" class="<?= (isset($_SESSION['email'])) ? 'validation-error' : '';  ?>" type="email" name="email" id="email" placeholder="Email" />
                <?= (isset($_SESSION['email'])) ? "<span class='validation-error'>{$_SESSION['email']}</span>" : '';  ?>
            </div>
        </div>
        <br />
        <div class="form-group-group">
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input value="<?= $user->telefone ?>" class="<?= (isset($_SESSION['telefone'])) ? 'validation-error' : '';  ?>" type="text" name="telefone" id="telefone" placeholder="Nº de Telefone" />
                <?= (isset($_SESSION['telefone'])) ? "<span class='validation-error'>{$_SESSION['telefone']}</span>" : '';  ?>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input value="<?= $user->endereco ?>" class="<?= (isset($_SESSION['endereco'])) ? 'validation-error' : '';  ?>" type="text" name="endereco" id="endereco" placeholder="Endereço" />
                <?= (isset($_SESSION['endereco'])) ? "<span class='validation-error'>{$_SESSION['endereco']}</span>" : '';  ?>
            </div>
        </div>
        <br />
        <div class="form-group">
                <label for="acesso">Tipo de Usuário</label>
                <select name="acesso" id="acesso" >
                    <option <?= $user->acesso == 'cliente'? 'selected' : '' ?> value="cliente">Cliente</option>
                    <option <?= $user->acesso == 'entregador'? 'selected' : '' ?> value="entregador">Entregador</option>
                    <option <?= $user->acesso == 'admin'? 'selected' : '' ?> value="admin">Admin</option>
                </select>
                <?= (isset($_SESSION['categoria'])) ? "<span class='validation-error'>{$_SESSION['categoria']}</span>" : '';  ?>
            </div>
        <br />
        <br />
        <div class="form-group-image">
            <label id="label" class="file-input" for="image">
                <div id="drop-zone" class="drop-zone">
                    <p>
                        <b>Selecione a imagem do usuário</b> ou solte aqui.
                    </p>
                    <img id="cover" src="<?= $user->imagem ?>" alt="produc" />
                </div>
                <input type="file" name="image" id="image" />
            </label>
            <?= (isset($_SESSION['image'])) ? "<span class='validation-error'>{$_SESSION['image']}</span>" : '';  ?>
        </div>
        <div class="form-group">
            <button class="btn-submit" type="submit">Atualizar</button>
        </div>
    </form>
<?php
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['telefone']);
    unset($_SESSION['acesso']);
    unset($_SESSION['endereco']);
    unset($_SESSION['image']);
?>
<?= $this->stop(); ?>

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