<?php
    include_once('session.php');
    
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    $deviceId = $_POST['deviceId'];
    $text = $_POST['text'];
    $mark = $_POST['mark'];
    $userId = $_SESSION['uniqueId'];
    $header = $_POST['header'];
    date_default_timezone_set('Europe/Kiev');
    $date = date('Y-m-d H:i:s');;

    $query = "INSERT into reviews (device, text, user, mark, header, date) values
     ('$deviceId', '$text', '$userId', '$mark', '$header', '$date')";
    $result = mysqli_query($conn, $query);

    mysqli_close($conn);

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>