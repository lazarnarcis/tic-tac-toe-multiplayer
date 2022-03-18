<?php
    $whitelist = array(
		'127.0.0.1',
		'::1'
	);
	if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
		$username = getenv('USERNAME');
		$password = getenv('PASSWORD');
		$database = getenv('DATABASE');
		$server = getenv('SERVER');
	} else {
		$username = "root";
		$password = "";
		$database = "tic-tac-toe-live";
		$server = "localhost";
	}

    $sql = mysqli_connect($server, $username, $password, $database);
    if (!$sql) {
        echo "Database error";
    }
?>