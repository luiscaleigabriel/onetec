<header id="header" class="header">
    <div class="header-content container">
      <div class="logo">
        <a href="/">
          <h1>OneTec</h1>
        </a>
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li>
            <a href="/">Home</a>
          </li>
          <li>
            <a href="/contact">Contacto</a>
          </li>
          <li>
            <a href="/about">Sobre</a>
          </li>
          <?php

use app\support\Auth;

 if(!isset($_SESSION['auth'])): ?>
            <li>
              <a href="/login">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      <div class="search">
        <form action="/search">
          <input type="search" name="name" id="search" placeholder="Busque por produtos..." />
          <button type="submit"> <i class="fa fa-search"></i> </button>
        </form>
        <div class="list-icon">
          <a href="/like" class="heart-icon">
            <img src="assets/images/heart.png" alt="heart" />
            <span id="totaLike">0</span>
          </a>
          <a href="/cart" class="cart-icon">
            <img src="assets/images/cart.png" alt="cart" />
            <span id="totalInCart">0</span>
          </a>
          <button id="toggle" class="toggle" onclick="navBar()">
            <i class="fa-solid fa-bars"></i>
          </button>
          <?php if(isset($_SESSION['auth'])): ?>
            <button onclick="showMenu()" id="user-login">
              <img src="assets/images/user/cliente.png" alt="cart" />
            </button>
            <div id="user-paine" class="user-paine">
              <ul>
                <li>
                  <a href="/count">Perfil <i class="fa fa-user"></i></a>
                </li>
                <li>
                  <a href="/myorders">Compras <i class="fa fa-cart-shopping"></i></a>
                </li>
                <li>
                  <a href="/resetpass">Alterar Senha <i class="fa fa-key"></i></a>
                </li>
                <?php

                  if(Auth::isAdmin() || Auth::isEnt()): ?>
                      <li class="list-item">
                      <a href="/dash">Painel ADM</a>
                    </li>
                    <?php endif; ?>
                <li>
                  <a href="/logout">Sair <i class="fa fa-door-open"></i></a>
                </li>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header> <!-- header -->

  