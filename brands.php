<?php
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    mysqli_set_charset($conn, "utf8");

    // $query = "SELECT min(price) as min1, max(price) as max1 FROM summary WHERE device = '$device_id'";
    $query = "SELECT * FROM brands";

    $rows = mysqli_query($conn, $query);
    echo "[";

    $i = 0;
    while($row = mysqli_fetch_assoc($rows)) {
        echo '{ 
            "brand": "'.$row['name'].'",
            "rating": "'.$row['rating'].'"
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
