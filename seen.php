<?php
    include ('session.php');
    
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $user = $_SESSION['uniqueId'];
    $link = $_POST['link'];
    $deviceId = $_POST['deviceId'];

    $query = "INSERT into favorites (link, user, device) values ('$link', '$user', '$deviceId')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "success";
    } else 
    {
        echo "error";
    }





    mysqli_close($conn);
?>