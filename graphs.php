<?php
  $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $device_id = $_POST['deviceId'];

    // $query = "SELECT min(price) as min1, max(price) as max1 FROM summary WHERE device = '$device_id'";
    $query = "SELECT stores.name as store, stores.link as link, brand, model, price_now, price_month, price_3month,
        summary.promotion as promotion from summary left join prices on summary.price = prices.id left join stores on summary.store = stores.id left join 
        (SELECT devices.id as id, brands.name as brand, devices.model as model from devices left join brands on 
        devices.brand = brands.id where devices.id = '$device_id') as d on summary.device = d.id where  summary.device = '$device_id'";
    
    $rows = mysqli_query($conn, $query);
    echo "[";

    $i = 0;
    while($row = mysqli_fetch_assoc($rows)) {
      echo '{ 
        "store": "'.$row['store'].'",
        "price": "'.$row['price_now'].'",
        "price_month": "'.$row['price_month'].'",
        "price_3month": "'.$row['price_3month'].'"
      }';
      $i++;
      if($i == mysqli_num_rows($rows)) {

      } else {
        echo ",";
      }
    }

    echo "]";

    echo mysqli_error($conn);
?>
