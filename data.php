<?php
$conn = mysqli_connect("localhost", "root", "", "kotalog");
mysqli_set_charset($conn, "utf8");
    $count = $_POST['count'] - 1;
    $category_id = $_POST['categoryId'];

    $query = "SELECT devices.id as id ,brands.name as 'name', devices.description as 'description', devices.model as 'model', devices.image as 'image', devices.popularity as 'popularity' FROM devices LEFT JOIN brands ON devices.brand = brands.id where devices.category = '$category_id'";
    $rows = mysqli_query($conn, $query);

    $i = 0;
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
        $txt = "от '.$b.' до '.$c.' грн.";
      }
       echo '<li class="devices__item">
       <div>
           <img class="item-img" src="img/'.$category_id.'/'.$row['name'].' = '.$row['model'].'.png" alt="phone image">
           <h3 class="item-name">'.$row['name'].' '.$row['model'].' | '.$txt.'</h3>
           <p class="item-desc">'.$row['description'].'</p>
           <a href="" class="item-more">Подробнее</a>
           <input type="checkbox" name="compare" class="item-compare">
           <a href="" class="item-reviews">Отзывы</a>
       </div>
   </li>';
      if($i >= $count) {
        break;
      } else {
        $i++;
      }
    }


?>