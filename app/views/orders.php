<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home / Minha Conta / </span>Compras
    </p>
    <?php if (!isset($_SESSION['success'])): ?> 
      <br /> <br />
      <button onclick="enviarDados()" class="btn-primary">Baixar Recibo em PDF</button>
    <?php endif; ?>
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

<?php if(!isset($_SESSION['success'])): ?>
  <?php $this->start('js'); ?>
    <script>
      // Enviar dados do localStorage para o servidor PHP 
      function enviarDados() { 
        const produtosSalvos = JSON.parse(localStorage.getItem('cart')); 
        // Enviar os dados via POST para o servidor 
        fetch('/pdf', { 
          method: 'POST', headers: { 'Content-Type': 'application/json' }, 
          body: JSON.stringify(produtosSalvos) }) 
          .then(response => response.blob()) 
          .then(blob => { const url = window.URL.createObjectURL(blob); 
          
            const a = document.createElement('a'); 
            a.href = url; a.download = 'recibo.pdf'; 
            document.body.appendChild(a); 
            a.click(); 
            a.remove(); 
          });
      }
    </script>
  <?php $this->stop(); ?>


<?php endif; ?>