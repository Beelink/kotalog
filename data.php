<?php
  $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $count = $_POST['count'] - 1;
    $category_id = $_POST['categoryId'];
    $sort_id = $_POST['sortId'];

    $query = "";

    if($sort_id == 1) {
      $query = "SELECT min(summary.price) as min_price, max(summary.price) as max_price, devices.id as id , brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' 
              FROM devices LEFT JOIN brands ON devices.brand = brands.id LEFT JOIN summary ON devices.id = summary.device WHERE devices.category = '$category_id' GROUP BY devices.id ORDER BY devices.popularity DESC";
    } else if ($sort_id == 2) {
      $query = "SELECT min(summary.price) as min_price, max(summary.price) as max_price, devices.id as id , brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' 
              FROM devices LEFT JOIN brands ON devices.brand = brands.id LEFT JOIN summary ON devices.id = summary.device WHERE devices.category = '$category_id' GROUP BY devices.id ORDER BY summary.price";
    } else if ($sort_id == 3) {
      $query = "SELECT min(summary.price) as min_price, max(summary.price) as max_price, devices.id as id , brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.popularity as 'popularity' 
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
           <h3 class="item-name">'.$row['name'].' '.$row['model'].' | '.$txt.'</h3>
           <p class="item-desc">'.$row['description'].'</p>
           <a href="more.php?id='.$row['id'].'&category='.$category_id.'#device" class="item-more">Подробнее</a>
           Сравнить <input type="checkbox" name="compare" class="item-compare">
           <a href="more.php?id='.$row['id'].'&category='.$category_id.'#review" class="item-reviews">Отзывы</a>
                </div>
            </li>';
      if($i >= $count) {
        break;
      } else {
        $i++;
      }
    }

    echo mysqli_error($conn);
?>
