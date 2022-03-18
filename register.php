<?php
    session_start();

    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
        header("location: index.php");
        exit;
    }
    $register_err = "";
    if (!empty($_GET['register_err'])) {
        $register_err = $_GET['register_err'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe || Register</title>
</head>
<body>
    <div>
        <form action="actions.php?action=register" method="post">
            <h1>Register</h1>
            <div>
                <input type="text" name="username" required>
            </div>
            <div>
                <input type="password" name="password" required>
            </div>
            <p><?php echo $register_err; ?></p>
            <input type="submit" value="Register">
            <p>Please <a href="login.php">login</a></p>
        </form>
    </div>
</body>
</html>