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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#send_challenge', function() {
                $.post("actions.php?action=challenge_user", $(this).serialize()).done(function(data) {
                    alert("Challenge sended!");
                });
                return false;
            });
            
            function load_challenges() {
                $("#challenges").load("actions.php?action=load_challenges");
                setTimeout(load_challenges, 500);
            }
            load_challenges();
        });
        
        </script>
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
        $session_id = $_SESSION['id'];
        $string = "SELECT * FROM users WHERE logged=1 AND id_user!=$session_id";
        $result = mysqli_query($sql, $string);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = $row['username'];
                $user_id = $row['id_user'];

                echo "<form id='send_challenge'>
                    <input type='text' value='$user_id' id='user_id' name='user_id' style='display: none' />
                    <div>
                        $user <input type='submit' value='challenge'>
                    </div>
                </form>";
            }
        } else {
            echo "<p>There are no online users.</p>";
        }
    ?>
    <h1>Challenges</h1>
    <div id="challenges"></div>
    <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>
