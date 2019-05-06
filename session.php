<?php
	$conn = mysqli_connect("localhost", "root", "", "kotalog");

	session_start();
	if(isset($_SESSION['login_user'])) {
	$user_check = $_SESSION['login_user'];

	$query = "SELECT 'login' FROM users WHERE 'login' = '$user_check'";
	$ses_sql = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($ses_sql);
	$login_session = $row['login'];
	}
?>