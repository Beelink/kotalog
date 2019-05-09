<?php
  $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $category_id = $_POST['categoryId'];

    $query = "SELECT filters FROM categories WHERE id = '$category_id'";
    
    $rows = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($rows)) {
      $data = json_encode($row, JSON_UNESCAPED_UNICODE);
      print_r($data);
    }
?>
