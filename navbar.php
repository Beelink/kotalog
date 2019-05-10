<a class="header__logo" href="list.php">
    <img src="img/icons/cat.png" class="header__logo__image">
    <span class="header__logo__name">Catalog</span><br>
    <span class="header__logo__slogan">Електронный сервис сравнения цен</span>     
</a>
<input type="text" class="header__search" placeholder="Поиск">
<nav>
    <ul class="header__menu">                 
    <?php
        include('session.php');
        if(isset($_SESSION['login_user'])) {
            echo $_SESSION['login_user'];
            echo ' / <a href="profile.php">Личный кабинет</a>';
            echo ' / <a href="logout.php">Выйти</a>';
        } else {
            echo '<a class="login" href="auth.php"><label>Войти<br>Регистрация</label><img src="img/icons/login.png"></a>';
        }
    ?>
    </ul>
</nav>    