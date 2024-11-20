<?php $this->layout('master') ?>
<?php $this->start('css_swip'); ?>
<link rel="stylesheet" href="assets/css/swiper.css" />
<?php $this->stop(); ?>

<?php $this->start('main'); ?>

<section class="news">
    <div class="news-content container">
        <div class="news-categoris">
            <ul class="list">
              <?php foreach($categories as $category): ?>
                  <li class="list-item">
                      <a href="/search?category=<?= $category->id ?>"><?= $category->nome ?></a>
                  </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="news-banner">
            <div class="swiper">
                <div class="mySwiper">
                    <div class="swiper-wrapper">
                        <!-- <div class="swiper-slide">
                            <img src="assets/images/header.png" alt="Sobre produtos" />
                            <div class="slide-tex">
                                <h2>Iphone 14 - 128GB</h2> 
                                <p>
                                Descubra o Iphone 14, um smartphone que combina design elegante e tecnologia de ponta para oferecer uma experiência incomparável
                                </p>
                                <a href="#">Comprar agora</a>
                            </div>
                        </div> -->
                        <a href="/search?category=3" class="swiper-slide">
                            <img src="assets/images/banner1.jpg" alt="Sobre produtos" />   
                        </a>
                        <a href="/search?category=5" class="swiper-slide">
                            <img src="assets/images/banner2.jpg" alt="Sobre produtos" />   
                        </a>
                        <a href="/search?category=1" class="swiper-slide">
                            <img src="assets/images/banner3.jpg" alt="Sobre produtos" />   
                        </a>
                        <a href="/search?category=23" class="swiper-slide">
                            <img src="assets/images/banner4.jpg" alt="Sobre produtos" />   
                        </a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                </div>
                <button id="btn-next" class="btn-next">></button>
            </div>
        </div>
    </div>
</section> <!-- news -->

<section class="about-it">
    <div class="about-it--content container">
      <h3 class="title-h3">Novo</h3>
      <h2 class="title-h2">Novos Produtos</h2>
    </div>
</section> <!-- about-it -->

<section class="products">
    <div class="products-content container">
      <div class="swiper">
        <div class="mySwiperProduct">
          <div class="swiper-wrapper slider-product">
            <?php foreach($newProduct as $product): ?>
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
            <button id="btn-prev1" class="btn-prev1"> < </button>
            <button id="btn-next1" class="btn-next1"> > </button>
          </div>
        </div>
      </div>
    </div>
</section> <!-- products -->

<div class="semore">
    <a href="/search?category=1" class="btn-primary">Ver Todos Produtos</a>
</div> <!-- semore -->

<section class="about-it">
    <div class="about-it--content container">
      <h3 class="title-h3">Categorias</h3>
      <h2 class="title-h2">Procure Pela Categoria</h2>
    </div>
</section> <!-- about-it -->

<section class="categories">
    <div class="categories-content container">
      <a href="/search?category=8" class="category">
        <img src="assets/images/icons/phone.png" alt="category" />
        <span>Smartphones</span>
      </a>
      <a href="/search?category=1" class="category">
        <img src="assets/images/icons/computer.png" alt="category" />
        <span>Computadores</span>
      </a>
      <a href="/search?category=27" class="category">
        <img src="assets/images/icons/watch.png" alt="category" />
        <span>Relógios</span>
      </a>
      <a href="/search?category=5" class="category">
        <img src="assets/images/icons/camera.png" alt="category" />
        <span>Câmera</span>
      </a>
      <a href="/search?category=5" class="category">
        <img src="assets/images/icons/headphone.png" alt="category" />
        <span>Escutadores</span>
      </a>
      <a href="/search?category=9" class="category">
        <img src="assets/images/icons/gaming.png" alt="category" />
        <span>Gaming</span>
      </a>
    </div>
</section> <!-- categories -->

<section class="about-it">
    <div class="about-it--content container">
      <h3 class="title-h3">Este Mês</h3>
      <h2 class="title-h2">Popular</h2>
    </div>
</section> <!-- about-it -->

<section class="products"> 
    <div class="products-content container">
      <div class="swiper">
        <div class="mySwiperProduct">
          <div class="swiper-wrapper slider-product">
            <?php foreach($populares as $product): ?>
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

<section class="banner-main">
    <div class="banner-content container">
      <div class="banner-c">
        <div class="banner-about">
          <h2>Melhore a sua</h2>
          <h2>Esperiência Musical</h2>
          <a href="/search?subcategory=32" class="btn-secundary">Ver Mais</a>
        </div>
        <div class="banner-ima">
          <img src="assets/images/speaker.png" alt="product" />
        </div>
      </div>
    </div>
</section> <!-- banner-main -->  

<section class="about-it">
    <div class="about-it--content container">
      <h3 class="title-h3">Nossos Produtos</h3>
      <h2 class="title-h2">Esplore Nossos Produtos</h2>
    </div>
</section> <!-- about-it -->

<section class="destaque">
    <div class="destaque-conten container">
        <?php foreach($nProducts as $product): ?>
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
    </div>
</section> <!-- destaque -->

<div class="semore">
    <a href="/search?category=1" class="btn-primary">Ver Todos Produtos</a>
</div> <!-- semore -->

<section class="about-it">
    <div class="about-it--content container">
      <h3 class="title-h3">Em destaque</h3>
      <h2 class="title-h2">Nova chegada</h2>
    </div>
</section> <!-- about-it -->

<section class="gallery">
    <div class="gallery-content container">
      <div class="gallery-left">
        <img src="assets/images/gallery/gallery-1.png" alt="product" />
        <div class="gallery-left--text">
          <h2>PlayStation 5</h2>
          <p>
            Versão preto e branco da PS5 <br />
            compre e desfrute.
          </p>

          <a href="/search?category=9">Compre Agora</a>
        </div>
      </div>
      <div class="gallery-rigth">
        <div class="gallery-top">
          <img src="assets/images/gallery/gallery-2.png" alt="product" />
          <div class="gallery-left--text">
            <h2>Iphone 14</h2>
            <p>
              Desfrute do melhor.
            </p>
  
            <a href="/search?subcategory=33">Compre Agora</a>
          </div>
        </div>
        <div class="gallery-bottom">
          <div class="gallery-image">
            <img src="assets/images/gallery/gallery-4.jpg" alt="product" />
            <div class="gallery-left--text">
              <h2>SmartPhone</h2>
              <p>
                O melhor para si.
              </p>
    
              <a href="/search?category=8">Compre Agora</a>
            </div>
          </div>
          <div class="gallery-image">
            <img src="assets/images/gallery/gallery-3.png" alt="product" />
            <div class="gallery-left--text">
              <h2>Speakers</h2>
              <p>
                Coluna sem fio incrivel.
              </p>
    
              <a href="/search?subcategory=32">Compre Agora</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</section> <!-- gallery -->

<section class="support">
    <div class="support-content container">
      <div class="support-data">
        <div class="support-image">
          <img src="assets/images/icons/service-1.png" alt="service" />
        </div>
        <h2>ENTREGA GRÁTIS E RÁPIDA</h2>
        <p>Entrega grátis para todas as compras superior a 80.000Kz</p>
      </div>
      <div class="support-data">
        <div class="support-image">
          <img src="assets/images/icons/service-2.png" alt="service" />
        </div>
        <h2>ASSISTÊNCIA TÉCNICA 24/24</h2>
        <p>Estamos abertos 24/24</p>
      </div>
      <div class="support-data">
        <div class="support-image">
          <img src="assets/images/icons/service-3.png" alt="service" />
        </div>
        <h2>SEGURANÇA GARANTIDA</h2>
        <p>Devolução em até 30 dias</p>
      </div>
    </div>
</section> <!-- support -->

<?php $this->stop(); ?>


<?php $this->start('js'); ?>
<script src="assets/js/swiper.js"></script>
<script src="assets/js/carrocel.js"></script>
<?php $this->stop(); ?>