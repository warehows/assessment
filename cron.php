<?php
$servername = "166.62.10.139";
$username = "ben";
$password = "Resty!Joeven241";
$dbname = "brainee2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


date_default_timezone_set("Asia/Manila");
$day_minus = date("d")-1;
$date_minus = date("Y-m-").$day_minus;
$date_now = date("Y-m-d");
$sql = "SELECT * FROM `lesson_contents` WHERE date_updated LIKE '%$date_minus%' OR date_updated LIKE '%$date_now%'";

$result = $conn->query($sql);

$result_array = array();
echo "<pre>";
foreach($result as $result_key=>$result_value){

}

$conn->close();
?>
