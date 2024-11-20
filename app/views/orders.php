<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home / Minha Conta / </span>Compras
    </p>
</div>

<?php
    if (isset($_SESSION['error'])) {
      echo flash('error', 'error');
    }
    if (isset($_SESSION['success'])) {
      echo flash('success', 'success');
    }
?>

<section class="acount container">
    <?php $this->insert('partials/userpaine') ?>
    <div class="acout-form">
      <table>
        <thead>
          <tr>
            <th>Código</th>
            <th>Data</th>
            <th>Estado</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($orders) > 0): ?>

            <?php foreach($orders as $order): ?>
                <tr>
                    <td><?= $order->codigo ?></td>
                    <td><?= $order->data_da_compra ?></td>
                    <td><span class="status">Comprado</span></td>
                    <td><?= $order->total ?> Kz</td>
                </tr>
            <?php endforeach; ?>

          <?php else: ?>
            <h3>Nenhuma compra Realizada</h3>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
</section>

<?php $this->stop(); ?>