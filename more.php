<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOTalog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="normalize.css">
    <script src="stores.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <script type="text/javascript" src="load.js"></script>
</head>
<body>
    <header id="header"></header>

    <main id="main">
        <section class="device">
            <div id = "device">
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "kotalog");
                    mysqli_set_charset($conn, "utf8");
                    $category_id = $_GET['category'];
                    $device_id = $_GET['id'];
                    $query = "SELECT devices.id as id ,brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' FROM devices LEFT JOIN brands ON devices.brand = brands.id where devices.category = '$category_id' and devices.id = '$device_id'";
                    $rows = mysqli_query($conn, $query);



                    while($row = mysqli_fetch_assoc($rows)) {
                    $id = $row['id'];
                    $query2 = "SELECT min(price) as mi, max(price) as ma FROM summary WHERE device = '$id'";
                    $a = mysqli_query($conn, $query2);
                    $b = "";
                    $c = "";
                    while($row2 = mysqli_fetch_assoc($a)) {
                        $b = $row2['mi'];
                        $c = $row2['ma'];
                    }
                    $txt = "";
                    if($b == $c) {
                        $txt = $c." грн.";
                    } else {
                        $txt = 'от '.$b.' до '.$c.' грн.';
                    }
                                echo '<img class="item-img" src="img/'.$category_id.'/'.$row['name'].' = '.$row['model'].'.png" alt="phone image">
                                <h3 class="item-name">'.$row['name'].' '.$row['model'].' | '.$txt.'</h3>
                                <p class="item-desc">'.$row['description'].'</p>';
                    }
                ?>
            </div>
            <div id="review">
            <?php
                $conn = mysqli_connect("localhost", "root", "", "kotalog");
                mysqli_set_charset($conn, "utf8");
                $category_id = $_GET['category'];
                $device_id = $_GET['id'];
                $query = "SELECT reviews.header as header, reviews.text as text, reviews.date as date, users.login as 'login', reviews.mark as mark FROM reviews LEFT JOIN users ON reviews.user = users.id where reviews.device = '$device_id'";
                $rows = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($rows)) {
                    echo '<div class ="comment">
                        <h3>'.$row['header'].'</h3>
                        <span class = "comment__login">'.$row['login'].'</span>
                        <p>'.$row['text'].'</p>
                        <span class = "comment_date">'.$row['date'].'</span>
                        <img class="comment__img" src="img/smiles/'.$row['mark'].'.png" alt="mark image" title = "'.$row['mark'].'" style="width:24px; height:24px;>
                    </div>';
                }
                ?>
            </div>

            <div id="stores">
                <table id="table"> 
                    <caption>Цена по магазинам</caption>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "kotalog");
                        mysqli_set_charset($conn, "utf8");
                        $device_id = $_GET['id'];
                        $query = "SELECT stores.name as store, stores.link as link, brand, model, summary.price, summary.warranty as warranty, 
                            summary.promotion as promotion from summary left join stores on summary.store = stores.id left join 
                            (SELECT devices.id as id, brands.name as brand, devices.model as model from devices left join brands on 
                            devices.brand = brands.id where devices.id = '$device_id') as d on summary.device = d.id where  summary.device = '$device_id'";
                        $rows = mysqli_query($conn, $query);

                        $i = 0;
                        while($row = mysqli_fetch_assoc($rows)) {
                        echo '
                        <tr>
                            <td>
                                <img class="stores__img" src="img/stores/'.$row['store'].'.jpg" alt="store image" title = "'.$row['store'].'">
                            </td>
                            <td>
                                <span class="stores__promotion">'.$row['store'].'</span>
                            </td>
                            <td>
                                <span class="stores__promotion">'.$row['promotion'].'</span>
                                <span class="stores__warranty">'.$row['warranty'].'</span>
                            </td>
                            <td>
                                <span class="stores__price">'.$row['price'].' грн.</span>
                                <a class="stores__graphic" href="/">Динамика цен</a>
                                <a class="stores__link" href="http://www.'.$row['link'].'">Перейти в магазин</a>
                            </td>
                        </tr>';
                        // if($i >= $count) {
                        //     break;
                        //   } else {
                        //     $i++;
                        //   }
                    }
                    ?>
                    <!-- <button onclick="showMore()">Показать еще...</button>-->
                </table>
            <div>
        </section>
    </main>
    <script src="jquery-3.3.1.min.js"></script>
</body>
</html>