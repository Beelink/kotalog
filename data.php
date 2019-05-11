<?php
  $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $count = $_POST['count'] - 1;
    $category_id = $_POST['categoryId'];
    $sort_id = $_POST['sortId'];

    $query = "";

    if($sort_id == 1) {
      $query = "SELECT fvalues, min(summary.price) as min_price, max(summary.price) as max_price, devices.id as id , brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' 
              FROM devices LEFT JOIN brands ON devices.brand = brands.id LEFT JOIN summary ON devices.id = summary.device WHERE devices.category = '$category_id' GROUP BY devices.id ORDER BY devices.popularity DESC";
    } else if ($sort_id == 2) {
      $query = "SELECT fvalues, min(summary.price) as min_price, max(summary.price) as max_price, devices.id as id , brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' 
              FROM devices LEFT JOIN brands ON devices.brand = brands.id LEFT JOIN summary ON devices.id = summary.device WHERE devices.category = '$category_id' GROUP BY devices.id ORDER BY summary.price";
    } else if ($sort_id == 3) {
      $query = "SELECT fvalues, min(summary.price) as min_price, max(summary.price) as max_price, devices.id as id , brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' 
              FROM devices LEFT JOIN brands ON devices.brand = brands.id LEFT JOIN summary ON devices.id = summary.device WHERE devices.category = '$category_id' GROUP BY devices.id ORDER BY summary.price DESC";
    }
    
    $rows = mysqli_query($conn, $query);

    $i = 0;
    while($row = mysqli_fetch_assoc($rows)) {
      $id = $row['id'];
      $query2 = "SELECT min(price) AS mi, max(price) AS ma FROM summary WHERE device = '$id'";
      $a = mysqli_query($conn, $query2);
      $b = "";
      $c = "";
      while($row2 = mysqli_fetch_assoc($a)) {
        $b = $row2['mi'];
        $c = $row2['ma'];
      }
      $txt = "";
      if($b == $c) {
        if(empty($b) || empty($c)) {
          $txt = "Нет в продаже";
        } else {
          $txt = $c." грн.";
        }
      } else {
        $txt = 'от '.$b.' до '.$c.' грн.';
      }
       echo '<li class="devices__item">
                <div>
                    <img class="item-img" src="img/'.$category_id.'/'.$row['name'].' = '.$row['model'].'.png" alt="phone image">
                    <h3 class="item-name">'.$row['name'].' '.$row['model'].'</h3>
                    <label class="item-price">'.$txt.'</label>
                    <p class="item-desc">'.$row['description'].'</p><br><br><br><br><br><br>
                    <p class="item-fvalues">'.substr($row['fvalues'], 1, -1).'</p><br>
                    <a onclick = addFav("'.$row['id'].'","more.php?id='.$row['id'].'&category='.$category_id.'") href="more.php?id='.$row['id'].'&category='.$category_id.'#device" class="item-more"><img src="img/icons/details.png"><label>Подробнее</label></a>
                    <a onclick = addFav("'.$row['id'].'","more.php?id='.$row['id'].'&category='.$category_id.'") href="more.php?id='.$row['id'].'&category='.$category_id.'#review" class="item-reviews"><img src="img/icons/reviews.png"><label>Отзывы</label></a>
                    <a onclick = addFav("'.$row['id'].'","more.php?id='.$row['id'].'&category='.$category_id.'") href="more.php?id='.$row['id'].'&category='.$category_id.'#stores" class="item-prices"><img src="img/icons/prices.png"><label>Сравнить цены</label></a>
                </div>
            </li>';
            //  <a href="/" class="item-more"><img src="img/icons/checkbox.png"><label>Сравнить</label></a>
      // if($i >= $count) {
      //   break;
      // } else {
      //   $i++;
      // }
    }

    echo mysqli_error($conn);
?>
