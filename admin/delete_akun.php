<?php
ob_start();
session_start();
if (!isset($_SESSION['level'])) {
    if ($_SESSION["level"] != 'Admin') {
        echo "<script> alert('Anda belum login');</script>";
        echo "<script> location ='../login.php';</script>";
    }
}
include '../koneksi.php';

$id = $_GET["id"];

$sql = mysqli_query($koneksi, "DELETE FROM akun WHERE id='$id'");

if ($sql) {
    echo "<script>alert('Satu data akun telah dihapus');</script>";
    echo "<script> location ='../admin/akun.php';</script>";
}
