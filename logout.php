<?php
    session_start();
    require "config.php";
    $username = $_SESSION['username'];
    $string = "UPDATE users SET logged=0 WHERE username='$username'";
    mysqli_query($sql, $string);
    session_reset();
    session_destroy();
    header("location: index.php");
    exit;
?>