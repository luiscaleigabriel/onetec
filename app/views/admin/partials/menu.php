<div class="menu">
    <span id="toggle"><i class="fa-solid fa-bars"></i></span>
    <div onclick="showMenu()" id="menu-data--user" class="menu-data--user">
        <div class="user-data">
            <span class="user-image"><img src="<?= $_SESSION['auth']->image ? '' : 'assets/images/user/user.png' ?>" alt="user" /></span>
            <span class="user-name"><?= $_SESSION['auth']->name ?></span>
        </div>
    </div>
    <ul id="nav-drop">
        <li>
            <a href="/edituser?id=<?= $_SESSION['auth']->id ?>">Perfil <i class="fa fa-user"></i></a> 
        </li>
        <li>
            <a href="/resetpassword">Alterar Senha <i class="fa fa-key"></i></a> 
        </li>
        <li>
            <a href="/logout">Sair <i class="fa fa-door-open"></i></a>
        </li>
    </ul>
</div>