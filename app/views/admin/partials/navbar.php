<div id="dashboard-l" class="dashboard-l">
      <h1 class="logo"><a href="/">OneTec</a></h1>
      <nav class="navegation">
        <ul class="list">
          <li class="list-item">
            <a href="/dash"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <?php if(isset($_SESSION['admin'])): ?>
            <li class="list-item">
              <a href="/categories"><i class="fa fa-file-alt"></i> Categorias</a>
            </li>
            <li class="list-item">
              <a href="/subcategories"><i class="fa fa-file-alt"></i> SubCategorias</a>
            </li>
            <li class="list-item">
              <a href="/products"><i class="fas fa-tag"></i> Produtos</a>
            </li>
            <li class="list-item">
              <a href="/orders"><i class="fas fa-shopping-bag"></i> Compras</a>
            </li>
          <?php endif; ?>
          <li class="list-item">
            <a href="/ships"><i class="fas fa-truck"></i> Entregas</a>
          </li>
          <?php if(isset($_SESSION['admin'])): ?>
            <li class="list-item">
              <a href="/users"><i class="fa fa-users"></i> Usuários</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>