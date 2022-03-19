<?php
    session_start();
    require "config.php";
    if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- <table>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>a</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table> -->
    <h1>Utilizatori online:</h1>
    <?php
        $string = "SELECT * FROM users WHERE logged=1";
        $result = mysqli_query($sql, $string);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = $row['username'];

                echo "<div>$user <button>challenge</button></div>";
            }
        } else {
            echo "<p>There are no online users.</p>";
        }
    ?>
    <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>
