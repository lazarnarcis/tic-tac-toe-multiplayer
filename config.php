<?php
    $username = "root";
    $database = "tic-tac-toe-live";
    $server = "localhost";
    $password = "";

    $sql = mysqli_connect($server, $username, $password, $database);
    if (!$sql) {
        echo "Database error";
    }
?>