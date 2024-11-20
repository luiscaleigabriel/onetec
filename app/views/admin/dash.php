<?php $this->layout('admin/dash_master') ?>

<?= $this->start('main'); ?>
    <h2 class="dash-title">Dashboard</h2>

    <div class="card-list">
        <div class="card">
        <div class="card-top">
            <h3 class="card-title">Vendas</h3>
            <div class="icon">
            <i class="fa fa-cart-shopping"></i>
            </div>
        </div>
        <div class="card-botton">
            <h3 class="card-value"><?= $orders ?></h3>
        </div>
        </div>
        <div class="card">
            <div class="card-top">
                <h3 class="card-title">Total Vendido</h3>
                <div class="icon">
                <i class="fa fa-dollar"></i>
                </div>
            </div>
            <div class="card-botton">
                <h3 class="card-value"><?= number_format($total, 2, ',', '.') ?> Kz</h3>
            </div>
        </div>
        <div class="card">
            <div class="card-top">
                <h3 class="card-title">Ganhos</h3>
                <div class="icon">
                <i class="fa fa-dollar"></i>
                </div>
            </div>
            <div class="card-botton">
                <h3 class="card-value"><?= number_format( $ganhos , 2, ',', '.') ?> Kz</h3>
            </div>
        </div>
        <div class="card">
        <div class="card-top">
            <h3 class="card-title">Usuários</h3>
            <div class="icon">
            <i class="fa fa-users"></i>
            </div>
        </div>
        <div class="card-botton">
            <h3 class="card-value"><?= $users ?></h3>
        </div>
        </div>
    </div>
<?= $this->stop(); ?>