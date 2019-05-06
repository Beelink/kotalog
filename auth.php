<?php

  session_start();
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
  <title>Auth</title>
  <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  #box
  {
   width:100%;
   max-width:500px;
   border:1px solid #ccc;
   border-radius:5px;
   margin:0 auto;
   padding:0 20px;
   box-sizing:border-box;
   height:270px;
  }

  .btn {
    
  }
  </style>
 </head>
 <body>
  <div class="container">
   <h2 align="center">Authorization form</h2><br /><br />
   <div id="box">
    <br />
        <form action="auth.php" method="post">
            <center>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control" />
                    </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" />
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Войти" name="login"/>
                    <input type="submit" class="btn btn-success" value="Зарегестрироваться" name="signup"/>
                </div>
            </center>
        </form>
    <br />
   </div>
  </div>
 </body>
</html>

<script type="text/javascript">

// function login() {
//     var username = document.getElementById('username').value;
//     var password = document.getElementById("password").value;
//     $.ajax({
//       url: 'test.php',
//       type: 'post',
//       data: {
//         username: username,
//         password: password,
//         login: 'login'
//       },
//       success: function(response) {
//         if(response == 'success') {
//           alert('login - success');
//           location.href = 'profile.php';
//         } else {
//           alert('login - fail');
//         }
//       } 
//     });
//   }
// function signup() {
//     var username = document.getElementById('username').value;
//     var password = document.getElementById("password").value;
//     $.ajax({
//       url: 'test.php',
//       type: 'post',
//       data: {
//         username: username,
//         password: password,
//         signup: 'signup'
//       },
//       success: function(response) {
//         if(response == 'success') {
//           alert('signup - success');
//         } else {
//           alert('signup - fail');
//         }
//       } 
//     });
//   }
</script>
