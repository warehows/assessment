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
$day_minus = date("d") - 1;
$date_minus = date("Y-m-") . $day_minus;
$date_now = date("Y-m-d");

$sql = "SELECT * FROM `lesson_contents` WHERE date_updated LIKE '%$date_minus%' OR date_updated LIKE '%$date_now%'";

$result = $conn->query($sql);

$result_array = array();
$server_url = 'http://warehows.net/develop/brainee/upload/lessons/';
$local_url = 'http://192.168.2.17/brainee/';
$output_dir = $_SERVER['DOCUMENT_ROOT'] . "/brainee/upload/lessons/";

foreach ($result as $result_key => $result_value) {

    $directory = $output_dir . $result_value['lesson_id'].'_'.$result_value['folder_name'];
    $server_directory = $server_url . $result_value['lesson_id'].'_'.$result_value['folder_name'];
    $copy = $directory."/".$result_value['content_name'];
    $server_copy = $server_directory."/".$result_value['content_name'];
    $ch = curl_init($server_copy);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);

    $data = curl_exec($ch);
    $server_size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);



    if (!is_dir($directory)) {
        mkdir($directory,0777, true);
        copy($server_copy,$copy);

    } else {
        if (!file_exists($copy)) {
            copy($server_copy,$copy);
        } else {
            $local_size = filesize($copy);
            if ($local_size != $server_size) {
                copy($server_copy,$copy);
            }
        }

    }
    curl_close($ch);
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(location.reload(), 5000);
    });
</script>

