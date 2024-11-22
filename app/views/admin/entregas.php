<?php

use app\support\Auth;

 $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <div class="title-about">
        <h2 class="dash-title">Todas as Entregas</h2>
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
        <form class="form-s" action="/ships">
            <input type="search" placeholder="Buscar pela data da entrega" name="search" id="search" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Data da entrega</th>
                <th>Status</th>
                <th>Entregador</th>
                <?php if(Auth::isEnt()): ?>
                    <th>Ação</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if(\count($orders) > 0): ?>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->data_da_entrega	 ?></td>
                        <td>
                            <?php if($order->status == true): ?>
                                <span class="status">Finalizado</span>
                            <?php else: ?>
                                <span class="statusErr">Entrega em curso</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php foreach($users as $user): ?>
                                <?php if($order->identregador == $user->id): ?>
                                    <?= $user->nome ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <?php if(Auth::isEnt() && $order->status == false): ?>
                            <td>
                                <form action="/shiping" method="post">
                                    <input type="hidden" name="identrega" value="<?= $_SESSION['auth']->id ?>" />
                                    <button style="background-color: black;" type="submit" class="btn btn-primary-p">Finalizar Entrega</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <h2>Nenhuma entrega encontrada</h2>
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