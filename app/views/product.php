<?php $this->layout('master') ?>
<?php $this->start('css_swip'); ?>
<link rel="stylesheet" href="assets/css/swiper.css" />
<?php $this->stop(); ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home / Categoria / </span><?= $product->nome ?>
    </p>
</div>

<div class="main-product container">
    <div class="main-product--image">
      <img src="<?= $product->image ?>" alt="product" />
    </div>
    <div class="main-product--details">
      <h2 class="product-name"><?= $product->nome ?></h2>
      <div class="prices">
        <span class="price"><?= number_format($product->preco, 2, ',', '.') ?> AKz</span>
        <span class="price-prev"><?= number_format($product->preco_anterior, 2, ',', '.') ?> AKz</span>
      </div>
      <div class="description">
        <p>
            <?= $product->descricao ?>
        </p>
      </div>
      <hr />
      <div class="div-btn">
        <button data-id="<?= $product->id ?>" data-image="<?= $product->image ?>" data-name="<?= $product->nome ?>" data-price="<?= $product->preco ?>" class="btn-primary addToCart">Adicionar ao Carrinho</button> 
        <button data-id="<?= $product->id ?>" data-name="<?= $product->nome ?>" 
                            data-image="<?= $product->image ?>" data-price="<?= $product->preco ?>"  class="btn-f like" ><i class="fa fa-heart"></i></button>
      </div>
    </div>
</div>

<section class="about-it">
    <div class="about-it--content container">
      <h3 class="title-h3">Produtos Relecionados</h3>
    </div>
</section> <!-- about-it -->

<section class="products"> 
    <div class="products-content container">
      <div class="swiper">
        <div class="mySwiperProduct">
          <div class="swiper-wrapper slider-product">
            <?php foreach($products as $product): ?>
                <div class="product swiper-slide">
                    <div class="product-image">
                        <img src="<?= $product->image ?>" alt="product" />
                        <button data-id="<?= $product->id ?>" data-name="<?= $product->nome ?>" 
                        data-image="<?= $product->image ?>" data-price="<?= $product->preco ?>" class="btn-add addToCart" ><i class="fa fa-cart-shopping"></i> Adicionar ao Carrinho</button>
                    </div>
                    <div class="product-about">
                        <h2 class="product-name"><?= $product->nome ?></h2>
                        <div class="prices">
                        <span class="price"><?= number_format($product->preco, 2, ',', '.') ?> AKz</span>
                        <span class="price-prev"><?= number_format($product->preco_anterior, 2, ',', '.') ?> AKz</span>
                        </div>
                        <hr />
                        <div class="product-links">
                            <button data-id="<?= $product->id ?>" data-name="<?= $product->nome ?>" 
                            data-image="<?= $product->image ?>" data-price="<?= $product->preco ?>"  class="btn-f like" ><i class="fa fa-heart"></i></button>
                            <a href="/productdetails?product=<?= $product->id ?>    "><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
          </div>
          <div class="btns">
            <button id="btn-prev2" class="btn-prev1"> < </button>
            <button id="btn-next2" class="btn-next1"> > </button>
          </div>
        </div>
      </div>
    </div>
</section> <!-- products -->

<?php $this->stop(); ?>


<?php $this->start('js'); ?>
<script src="assets/js/swiper.js"></script>
<script src="assets/js/carrocel.js"></script>
<?php $this->stop(); ?>