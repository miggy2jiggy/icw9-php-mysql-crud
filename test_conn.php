<?php

$host = "localhost";
$user = "msantiago15";
$pass = "msantiago15";
$db = "msantiago15";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Cool! Connected to the server";
echo " | Server: " . $conn->server_info;

$conn->close();

?>