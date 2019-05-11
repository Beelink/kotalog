<?php
    include ('session.php');
    
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $user = $_SESSION['uniqueId'];
    $link = $_POST['link'];
    $deviceId = $_POST['deviceId'];

    $sel = "SELECT * FROM favorites WHERE favorites.device = '$deviceId'";
    $res = mysqli_query($conn, $sel); 
    $num = mysqli_num_rows($res);
    
    if($num == 0) {
        $query = "INSERT into favorites (link, user, device) values ('$link', '$user', '$deviceId')";
        $result = mysqli_query($conn, $query);
    }


    mysqli_close($conn);
?>