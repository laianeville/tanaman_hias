<?php
ob_start();
include '../koneksi.php';
session_start();

if (!isset($_SESSION['level'])) {
    if ($_SESSION["level"] != 'Admin') {
        echo "<script> alert('Anda belum login');</script>";
        echo "<script> location ='../login.php';</script>";
    }
}

$id = $_GET["id"];

$sql = mysqli_query($koneksi, "DELETE FROM laporan WHERE id='$id'");

if ($sql) {
    echo "<script>alert('Satu data laporan telah dihapus');</script>";
    echo "<script> location ='../admin/laporan.php';</script>";
}
