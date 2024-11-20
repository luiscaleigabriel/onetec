<?php $this->layout('master') ?>


<?php $this->start('main'); ?>

<main class="shop-main container">
    <div class="shop-options">
      <div class="shop-categories">
        <h2>Categorias</h2>
        <ul class="list">
            <?php foreach($categories as $category): ?>
                <li class="list-item">
                    <a href="/search?category=<?= $category->id ?>"><?= $category->nome ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <h2>SubCategorias</h2>
        <ul class="list">
            <?php foreach($subCategories as $subcategory): ?>
                <li class="list-item">
                    <a href="/search?subcategory=<?= $subcategory->id ?>"><?= $subcategory->nome ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
      </div> 
    </div>
    <div class="shop-products">
    <?php if(count($products) > 0): ?>
        <?php foreach($products as $product): ?>
            <div class="product">
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
    <?php else: ?>
        <h2>Nenhum Produto Encontrado</h2>
    <?php endif; ?>
    </div>
</main>

<?php $this->stop(); ?>