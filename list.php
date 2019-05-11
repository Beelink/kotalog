<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalog - Список устройств</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="normalize.css">
    <script src="jquery-3.3.1.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <script type="text/javascript" src="load.js"></script>
</head>
<body>
    <header id="header"></header>

    <main id="main">
        <div class="filters">
            <div class="filters__head"><img src="img/icons/filter.png"><label>Фильтры</label></div>
            <hr>
            <ul id="filters"></ul>
            <hr>
            <div onclick="applyFilters()" class="apply-button"><img src="img/icons/apply.png"><label>Применить</label></div>
            <div onclick="clearFilters()" class="clear-button">Очистить фильтры</div>
           
        </div>

        <section class="devices">
            <div class="topbar">
                <label for="topbar-select">Категория: </label>
                <select id="topbar-select" onchange="changeCategory()">
                    
                    <option value="1"> Телефоны </option>
                    <option value="2"> Ноутбуки </option>
                    <option value="3"> Мониторы </option>
                    <option value="4"> Консоли </option>
                    <option value="5"> Наушники </option>
                    
                </select>

                <label for="topbar-sort">Сортировка: </label>
                <select id="topbar-sort" onchange="changeCategory()">
                    <option value="1"> По пополуярности </option>
                    <option value="2"> По возрастанию цены </option>
                    <option value="3"> По убыванию цены </option>
                </select>
            </div>

            <div class="devices__list">
                <ul id = "category">
                </ul>
            </div>
            <!-- <div class="botbar">
                <button onclick="showMore()">Показать еще...</button>
            </div> -->
        </section>
    </main>

    <script src="main.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
</body>
</html>