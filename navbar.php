<a class="header__logo" href="list.php">
    <img src="img/icons/cat.png">
    <div>
        <label>Catalog</label><br>
        <span class="header__logo__slogan">Електронный сервис сравнения цен</span>   
    </div>
</a>
<form action="search.php" method="POST">
    <input type="text" class="header__search" name="search" placeholder="Поиск">
    <button id="search-btn"><img src="img/icons/search.png"></button>
</form>
<nav>
    <ul class="header__menu">                 
    <?php
        include('session.php');
        if(isset($_SESSION['login_user'])) {
            echo '<a class="profile" href="logout.php" title="Выйти с аккаунта">'.$_SESSION['login_user'].'<br>Выйти</a>';
            echo '<a href="profile.php"><img title="Кабинет пользователя" src="img/icons/profile.png"></a>';
        } else {
            echo '<a class="login" href="auth.php"><label>Войти<br>Регистрация</label><img src="img/icons/login.png"></a>';
        }
    ?>
    </ul>
</nav>    