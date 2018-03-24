<?php
$servername = "166.62.10.139";
$username = "ben";
$password = "Resty!Joeven241";
$dbname = "brainee2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

$conn->close();
?>
