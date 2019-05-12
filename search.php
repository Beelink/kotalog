<html>
 <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Catalog - Результаты поиска</title>
  <script src="jquery-3.3.1.min.js"></script>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="load.js"></script>
  <script src="search.js"></script>
 </head>
 <body>
 <header id="header"></header>
    <center>
        <?php
            $search_value = $_POST["search"];
            echo "<div id='search-value'>Результаты поиска по запросу: <label>".$search_value."</label></div><br>";
            $conn = mysqli_connect("localhost", "root", "", "kotalog");
            mysqli_set_charset($conn, "utf8");
            $query = "select devices.id, devices.category, brands.name, devices.model from devices left join brands on devices.brand = brands.id";
            $rows = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($rows)) {
                echo "<a href='more.php?id=".$row['id']."&category=".$row['category']."#device' class='search-result'><img src='img/".$row['category']."/".$row['name']." = ".$row['model'].".png'><br><label class='search-result-label'>".$row["name"]." ".$row["model"]."</label></a>";
            }
            echo"<script>search('".$search_value."')</script>";
        ?>
    </center>
    <script src="search.js"></script>
 </body>
</html>

