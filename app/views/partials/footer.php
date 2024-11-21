<footer class="footer">
    <div class="footer-content container">
      <div class="div">
        <h2>Sobre-nós</h2>
        <p>
          Somos uma Lojá que tem como objectivo fornecer produtos de qualidade
        </p>
      </div>
      <div class="div">
        <h2>Suporte</h2>
        <ul class="list">
          <li class="list-item">onetec@gmail.com</li>
          <li class="list-item">(+224) 929-379-920</li>
        </ul>
      </div>
      <div class="div">
        <h2>Conta</h2>
        <ul class="list">
          <?php if(isset($_SESSION['auth'])): ?>
            <li class="list-item">
              <a href="/count">Minha Conta</a>
            </li>
          <?php endif; ?>
          <?php if(!isset($_SESSION['auth'])): ?>
            <li class="list-item">
              <a href="/register">Cadastro</a>
            </li>
            <li class="list-item">
              <a href="/login">Login</a>
            </li>
          <?php endif; ?>
          <li class="list-item">
            <a href="/cart">Carrinho de Compras</a>
          </li>
          <li class="list-item">
            <a href="/like">Lista de Favoritos</a>
          </li>
        </ul>
      </div>
      <div class="div">
        <h2>Links Importante</h2>
        <ul class="list">
          <li class="list-item">
            <a href="/about">Púlica & Privacidade</a>
          </li>
          <li class="list-item">
            <a href="/about">Termos de Uso</a>
          </li>
          <li class="list-item">
            <a href="/contact">Contactos</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>