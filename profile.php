<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Catalog - Личный кабинет</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="normalize.css">
        <script src="jquery-3.3.1.min.js"></script>
        <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
        <script type="text/javascript" src="load.js"></script>
        <script type="text/javascript" src="profile.js"></script>
    </head>
    <body>
        <header id="header"></header>

        <main id="main">
            <div id="seen">
            <label>Просмотренные товары</label>
            <hr>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "kotalog");
            mysqli_set_charset($conn, "utf8");

            $query = "SELECT * from (SELECT favorites.id as fid, favorites.device as device, favorites.link as link from 
                favorites left join users on favorites.user = users.id group by favorites.id) as q1 left join 
                (SELECT devices.id as lol, categories.id as category, brands.name as brand, devices.model as model, min(summary.price) as price from 
                devices left join brands on devices.brand = brands.id left join summary on devices.id = summary.device left join categories on devices.category = categories.id group by
                devices.id) as q2 on q1.device = q2.lol";
            
             $rows = mysqli_query($conn, $query);
             
             while($row = mysqli_fetch_assoc($rows)) {
                 echo '<div class="seen-item">
                    <a class = seen__ref href='.$row['link'].'> 
                    <img class="seen__img" src="img/'.$row['category'].'/'.$row['brand'].' = '.$row['model'].'.png" alt="phone image">
                    <h4 class ="seen__sign">'.$row['brand'].' '.$row['model'].'</h4>
                    <span class="seen__price">'.$row['price'].' грн.</span></a><br>
                    <button class="seen__button" onclick="deleteSeen('.$row['fid'].')"><img src="img/icons/delete.png"><label>Удалить</label></button>
                 </div>';
             }
            ?>
            </div>
            <div id="comments">
                <label>Оставленные комментарии</label>
                <hr>
                <?php
                include('session.php');
                $conn = mysqli_connect("localhost", "root", "", "kotalog");
                mysqli_set_charset($conn, "utf8");
                $uniqueId = $_SESSION['uniqueId'];
                $query = "SELECT reviews.header as header, reviews.text as text, reviews.date as date, users.login as login, reviews.mark as mark FROM reviews LEFT JOIN users ON reviews.user = users.id where reviews.user = '$uniqueId'";
                $rows = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($rows)) {
                    echo '<div class ="comment">
                        <img class="comment__img" src="img/smiles/'.$row['mark'].'.png" alt="mark image" title = "'.$row['mark'].'" style="width:24px; height:24px;">
                        <h3>'.$row['header'].'</h3>
                        <span class = "comment__login">'.$row['login'].'</span>
                        <p>'.$row['text'].'</p><br>
                        <span class = "comment_date">'.$row['date'].'</span>
                    </div>';
                }
                ?>
            </div>
        </main>
        <script src="jquery-3.3.1.min.js"></script>
    </body>
</html>