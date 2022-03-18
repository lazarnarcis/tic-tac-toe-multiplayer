<?php
    session_start();

    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
        header("location: index.php");
        exit;
    }

    $login_err = "";
    if (!empty($_GET['login_err'])) {
        $login_err = $_GET['login_err'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe || Login</title>
</head>
<body>
    <div>
        <form action="actions.php?action=login" method="post">
            <h1>Login</h1>
            <div>
                <input type="text" name="username" required>
            </div>
            <div>
                <input type="password" name="password" required>
            </div>
            <p><?php echo $login_err; ?></p>
            <input type="submit" value="Login">
            <p>Please <a href="register.php">register</a></p>
        </form>
    </div>
</body>
</html>