<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home /  </span>Carrinho 
    </p>
</div>

<main class="card-main container">
    <table class="table">
      <thead>
        <tr>
          <th>Produto</th>
          <th>Preço</th>
          <th>Quantidade</th>
          <th>Subtotal</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody id="product-list--main">
      </tbody>
    </table>
    <div class="tfoot">
      <h2 id="total">Total: 0 Kz</h2>
    </div>
    <div class="next-pay">
      <a href="/checkout" class="btn-primary">Comprar</a>
    </div>
</main>

<?php $this->stop(); ?>

<?php $this->start('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      showProducts();
    });
</script>
<?php $this->stop(); ?>