<?php
    $host = "localhost";
    $dbname = "test_db1";
    $user = "secure_user";
    $password = "462nTxXb555MVnjD";
    $dsn = "mysql:host=". $host .";dbname=". $dbname;
	$pdo = new PDO($dsn, $user, $password);
?>