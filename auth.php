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
    if($stmt->fetch()) {
      $_SESSION['login_user'] = $username; 
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
        echo "success";
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
              <label>Логин</label>
              <input type="text" name="username" id="username" class="auth-input" />
              </div>
          <div>
              <label>Пароль</label>
              <input type="password" name="password" id="password" class="auth-input" />
          </div>
          
          <div>
              <input type="submit" class="auth-button" value="Войти" name="login"/>
              <input type="submit" class="auth-button" value="Зарегестрироваться" name="signup"/>
          </div>
      
  </form>
  </center>
 </body>
</html>

