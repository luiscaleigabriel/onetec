<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home /  </span>Favoritos 
    </p>
</div>

<main class="card-main container">
    <table class="table">
      <thead>
        <tr>
          <th>Produto</th>
          <th>Preço</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody id="product-list--main">
      </tbody>
    </table>
</main>

<?php $this->stop(); ?>

<?php $this->start('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      showProductsLike();
    });
</script>
<?php $this->stop(); ?>