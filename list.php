<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOTalog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="normalize.css">
    <script src="jquery-3.3.1.min.js"></script>
</head>
<body>
    <header>
            <div class="header__logo">
                <a href="/">КОТалог</a>
                <span class="header__slogan">Електронный сервис сравнения цен</span>     
            </div>
            <input type="text" class="header__search" placeholder="Поиск">
            <nav>
                <ul class="header__menu">                 
                <?php
                    include('session.php');
                    if(isset($_SESSION['login_user'])) {
                        echo $_SESSION['login_user'];
                        echo ' / <a href="logout.php">Выйти</a>';
                    } else {
                        echo '<a href="auth.php">Войти / Регистрация</a>';
                    }
                ?>
                </ul>
            </nav>      
    </header>

    <main id="main">
        <div class="filters">
            <h2 class="filters__head">Фильтры</h2>
            <ul id="filters">
                <li class="filter"><button onclick="showFilters('n1')">Производитель</button>
                <ul id="n1">
                    <li class="filter__item">
                        <label for="">1</label>
                        <input type="checkbox" name="" id="">
                    </li>
                    <li class="filter__item">
                        <label for="">2</label>
                        <input type="checkbox" name="" id="">
                    </li>
                    <li class="filter__item">
                        <label for="">3</label>
                        <input type="checkbox" name="" id="">
                    </li>
                </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n2')">Цвет корпуса</button>
                    <ul id="n2">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id=""> 
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n3')">Дисплей</button>
                    <ul id="n3">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n4')">Память</button>
                    <ul id="n4">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n5')">Цена</button>
                    <ul id="n5">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n6')">Камера</button>
                    <ul id="n6">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n7')">Функции</button>
                    <ul id="n7">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n8')">Подключения</button>
                    <ul id="n8">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
                <li class="filter"><button onclick="showFilters('n9')">Год выпуска</button>
                    <ul id="n9">
                        <li class="filter__item">
                            <label for="">1</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">2</label>
                            <input type="checkbox" name="" id="">
                        </li>
                        <li class="filter__item">
                            <label for="">3</label>
                            <input type="checkbox" name="" id="">
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <section class="devices">
            <div class="topbar">
                <label for="topbar-select">Категория: </label>
                <select id="topbar-select" onchange="changeCategory(this.selectedIndex + 1)">
                    
                    <option value="1"> Телефоны </option>
                    <option value="2"> Ноутбуки </option>
                    <option value="3"> Мониторы </option>
                    <option value="4"> Консоли </option>
                    <option value="5"> Наушники </option>
                    
                </select>

                <label for="topbar-sort">Сортировка: </label>
                <select id="topbar-sort">
                    <option value="1"> По цене </option>
                    <option value="2"> По пополуярности </option>
                    <option value="3"> etc </option>
                </select>
            </div>

            <div class="devices__list">
                <ul id = "category">
                </ul>
                <button onclick="showMore()">Показать еще...</button>
            </div>
        </section>
    </main>

    <script src="main.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
</body>
</html>