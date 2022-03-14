<?php
    session_start();
    require "config.php";

    $action = $_GET['action'];
    
    if (empty($action)) {
        header("location: index.php");
        exit;
    } else if ((!isset($_SESSION["logged"]) || $_SESSION["logged"] != true) && $_GET['action'] != "login" && $_GET['action'] != "register") {
        header("location: login.php");
        exit;
    }

    if ($action == "register") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $string = "INSERT INTO users (username, password) VALUES ('".$username."', '".$password."')";
        $result = mysqli_query($sql, $string);

        $_SESSION['logged'] = true;
        $_SESSION['username'] = $username;

        if ($result) {
            header("location: index.php");
        }
    } else if ($action == "login") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $string = "SELECT * FROM users WHERE username='".$username."'";
        $result = mysqli_query($sql, $string);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $database_password = $row['password'];
            if ($database_password != $password) {
                header("location: login.php");
            } else {
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $username;

                header("location: index.php");
            }
        } else {
            header("location: login.php");
        }
    }
    
    mysqli_close($sql);
?>