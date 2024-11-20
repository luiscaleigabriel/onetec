<div class="acount-menu">
      <h3>Gerir Minha Conta</h3>
      <ul class="list">
        <li class="list-item">
          <a href="/count">Meu Perfil</a>
        </li>
        <li class="list-item">
          <a href="/resetpass">Alterar Senha</a>
        </li>
      </ul>
      <h3>Compras</h3>
      <ul class="list">
        <li class="list-item">
          <a href="/myorders">Finalizadas</a>
        </li>
        <li class="list-item">
          <a href="/cart">Carrinho</a>
        </li>
        <?php

        use app\support\Auth;

       if(Auth::isAdmin() || Auth::isEnt()): ?>
          <li class="list-item">
          <a href="/dash">Painel Administrativo</a>
        </li>
        <?php endif; ?>
      </ul>
</div>