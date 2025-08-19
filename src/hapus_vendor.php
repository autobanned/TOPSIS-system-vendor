<?php
session_start();
include 'auth.php';
redirectIfNotLoggedIn();

if (isset($_GET['id'])) {
    include 'koneksi.php';
    $id = $_GET['id'];
    $query = "DELETE FROM data_vendor WHERE id = $id";

    if (mysqli_query($selectdb, $query)) {
        header("Location: daftar_vendor.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($selectdb);
    }
} else {
    header("Location: daftar_vendor.php");
    exit;
}
?>
