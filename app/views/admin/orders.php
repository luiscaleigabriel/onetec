<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <div class="title-about">
        <h2 class="dash-title">Todas as Compras</h2>
    </div>
    <div class="table-container">
        <div class="table-header">
        <form class="form-s" action="/orders">
            <input type="search" placeholder="Buscar pelo código da compra" name="search" id="search" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Data</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\count($orders) > 0): ?>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order->codigo ?></td>
                        <td>
                            <?php foreach($users as $user): ?>
                                <?php if($order->idusuario == $user->id): ?>
                                    <?= $user->nome ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td><?= number_format($order->total, 2, ',', '.') ?> Kz</td>
                        <td><?= $order->data_da_compra ?></td>
                        <td><span class="status">Comprado</span></td>
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