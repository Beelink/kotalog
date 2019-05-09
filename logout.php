<?php
    include('session.php');
    if(session_destroy())
        header("Location: list.php"); 
?>