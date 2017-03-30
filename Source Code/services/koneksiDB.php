<?php
$server = "localhost";
$username = "root";
$password = "halodunia23";
$database = "tokobuku_online";

// config dan memilih database

$koneksi = mysql_connect($server,$username,$password) or die("koneksi gagal euy");
mysql_select_db($database,$koneksi) or die ("database ga bisa euy");
?>
