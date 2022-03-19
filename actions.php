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

        $string = "INSERT INTO users (username, password, logged) VALUES ('".$username."', '".$password."', 1)";
        $result = mysqli_query($sql, $string);

        $_SESSION['logged'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['id'] = mysqli_insert_id($sql);

        if ($result) {
            header("location: index.php");
        }
    } else if ($action == "challenge_user") {
        $first_user = $_SESSION['id'];
        $second_user = $_POST['user_id'];

        $string_1 = "INSERT INTO challenges (first_user, second_user, accepted) VALUES ('$first_user', '$second_user', 0)";
        mysqli_query($sql, $string_1);
    } else if ($action == "load_challenges") { 
        $second_id = $_SESSION['id'];
        $string = "SELECT * FROM challenges WHERE second_user=$second_id AND accepted=0";
        $result = mysqli_query($sql, $string);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $by = $row['first_user'];
                $string_1 = "SELECT * FROM users WHERE id_user=$by";
                $result_1 = mysqli_query($sql, $string_1);
                $row_1 = mysqli_fetch_assoc($result_1);
                $by_user = $row_1['username'];

                echo '
                    <div>
                        <span>challenged by '.$by_user.'</span>
                        <form id="challenge_accepted">
                            <input type="text" style="display: none" name="first_id" value="'.$by.'" />
                            <input type="text" style="display: none" name="second_id" value="'.$second_id.'" />
                            <input type="submit" value="Accept '.$by_user.'\'s challenge" />
                        </form>
                    </div>
                ';
            }
        } else {
            echo "<div>No challenges!</div>";
        }
    } else if ($action == "challenge_accepted") {
        $first_user = $_POST['first_id'];
        $second_user = $_POST['second_id'];
        
        $string_1 = "UPDATE challenges SET accepted=1 WHERE first_user=$first_user AND second_user=$second_user";
        mysqli_query($sql, $string_1);
    } else if ($action == "login") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $string = "SELECT * FROM users WHERE username='".$username."'";
        $result = mysqli_query($sql, $string);
        $acces = 1;

        if (!mysqli_num_rows($result)) {
            $message = "Unknown username!";
            header("location: login.php?login_err=$message");
            $acces = 0;
        }
        
        $row = mysqli_fetch_assoc($result);

        $database_password = $row['password'];
        if ($database_password != $password) {
            $message = "Password incorrect!";
            header("location: login.php?login_err=$message");
            $acces = 0;
        } 
        if ($acces == 1) {
            $_SESSION['logged'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id_user'];

            $string_1 = "UPDATE users SET logged=1 WHERE username='$username'";
            $result_1 = mysqli_query($sql, $string_1);

            if ($result_1) {
                header("location: index.php");
            }
        }
    }
    
    mysqli_close($sql);
?>