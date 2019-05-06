<?php
  session_start();

  
   if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $conn = mysqli_connect("localhost", "root", "", "kotalog");
      $query = "SELECT 'login', 'password' FROM users WHERE 'login'=? AND 'password'=? LIMIT 1";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $stmt->bind_result($username, $password);
      $stmt->store_result();
      if($stmt->fetch()) {
        $_SESSION['login_user'] = $username; 
        echo "success";
       }else
       echo "fail";
       mysqli_close($conn); 
    }
  if (isset($_POST['signup'])) {
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
        $query = "INSERT INTO users (login,password) VALUES ('$username',
          '$password')"; 
        if (mysqli_query($conn, $query)) {
          echo "success";
        } 
      }
      mysqli_close($conn); 
    
  }
?>