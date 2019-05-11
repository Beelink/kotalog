<?php
  include('session.php');
  if(isset($_SESSION['login_user'])) {
    header("location: list.php"); 
  }

  if(isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    $query = "SELECT login, password FROM users WHERE login=? AND password=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($username, $password);
    $stmt->store_result();
    $query2 = "SELECT users.id as id FROM users where login = '$username' and password = '$password' limit 1";
    $uniqueId = null;
    $rows = mysqli_query($conn, $query2);
    while($row = mysqli_fetch_assoc($rows)) {
      $uniqueId = $row['id'];
    }
    if($stmt->fetch()) {
      $_SESSION['login_user'] = $username;
      $_SESSION['uniqueId'] = $uniqueId;
      echo "success";
      header("location: list.php"); 
     }else
     echo "fail";
     mysqli_close($conn); 
  }

  if(isset($_POST["signup"])) {
    $exist = FALSE;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = 'user';
    $conn = mysqli_connect("localhost", "root", "", "kotalog");
    $user_check_query = "SELECT * FROM users WHERE 'login'='$username' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { 
      if ($user['username'] == $username) {
        $exist = TRUE;
        echo "fail";
      }
    } 
    if($exist == FALSE) {
      $query = "INSERT INTO users (login,password,role) VALUES ('$username',
        '$password', 'user')"; 
      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Пользователь с логином ".$username." зарегистрирован!');</script>";
      } 
    }
    mysqli_close($conn); 
  }
?> 

<html>
 <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Catalog - Вход / Регистрация</title>
  <script src="jquery-3.3.1.min.js"></script>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="load.js"></script>
 </head>
 <body>
 <header id="header"></header>

 <center>
 <form action="auth.php" method="post" class="auth-form">
      
      <h2 class="auth-head">Вход / Регистрация</h2>
          <div>
              <label>Логин</label><br>
              <input type="text" name="username" id="username" class="auth-input" />
              </div>
          <div>
              <label>Пароль</label><br>
              <input type="password" name="password" id="password" class="auth-input" />
          </div>
          
          <div>
              <!-- <input type="submit" class="auth-button" value="Войти" name="login"/> -->
              <button type="submit" class="auth-button"name="login" ><img src="img/icons/login.png" ><label>Войти</label></button>
              <button type="submit" class="auth-button"name="signup" ><img src="img/icons/register.png" ><label>Создать</label></button>
              <!-- <input type="submit" class="auth-button" value="Зарегестрироваться" name="signup"/> -->
          </div>
      
  </form>
  </center>
 </body>
</html>

