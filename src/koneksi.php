<?php
$host = "db";
$user = "root";
$pass = "root";
$db   = "spk_cloud_vendor";

$selectdb = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
