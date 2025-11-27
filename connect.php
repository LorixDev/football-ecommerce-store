<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_shop";

// Creating a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checking the connection
if (!$conn) {
    die("Připojení selhalo: " . mysqli_connect_error());
}
?>