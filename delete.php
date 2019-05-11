<?php
    include ('session.php');
    
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $favId = $_POST['id'];
  

    $query = "DELETE FROM favorites WHERE favorites.id = '$favId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "success";
    } else 
    {
        echo "error";
    }





    mysqli_close($conn);
?>