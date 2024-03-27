<?php
$host = 'localhost';
$username = 'root';
$password = 'MyNewPass';
$database = 'WebSys';

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>


