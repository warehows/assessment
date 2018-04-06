<?php
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$host = $_SERVER['HTTP_HOST'];
if($host=="localhost"){
    $base_url='http://localhost/brainee/';
    $dbase='brainee3';
}if($host=="192.168.2.17"){
    $base_url='http://192.168.2.17/brainee/';
    $dbase='brainee2';
}else{
    $base_url='http://warehows.net/develop/brainee/';
    $dbase='brainee3';
}
$sq_base_url=$base_url;
$sq_hostname='166.62.10.139';
$sq_dbname=$dbase;
$sq_dbusername='ben';
$sq_dbpassword='Resty!Joeven241';

?>