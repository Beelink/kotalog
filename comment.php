<?php
    include_once('session.php');
    
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $deviceId = $_POST['deviceId'];
    $text = $_POST['text'];
    $mark = $_POST['mark'];
    $userId = $_SESSION['uniqueId'];
    $userName = $_SESSION['login_user'];
    date_default_timezone_set('Europe/Kiev');
    $date = date('m-d-Y h:i:s a', time());

    $query = "INSERT into reviews (device, text, user, mark, header, date) values
     ('$deviceId', '$text', '$userId', '$mark', '$userName', '$date')";
    $result = mysqli_query($conn, $query);

    mysqli_close($conn);
?>