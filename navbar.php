<div class="header__logo">
    <a href="list.php">КОТалог</a>
    <span class="header__slogan">Електронный сервис сравнения цен</span>     
</div>
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
            echo '<a href="auth.php">Войти / Регистрация</a>';
        }
    ?>
    </ul>
</nav>    