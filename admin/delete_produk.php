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

$sql = mysqli_query($koneksi, "DELETE FROM produk WHERE idproduk='$id'");

if ($sql) {
    echo "<script>alert('Satu data produk telah dihapus');</script>";
    echo "<script> location ='../admin/produk.php';</script>";
}
