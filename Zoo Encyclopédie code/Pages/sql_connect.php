<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "Zoo_Encyclopedia";


$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    echo "Connecting Failed";
}


$sql = "SELECT * FROM Animals";
$result = $connection->query($sql);
?>