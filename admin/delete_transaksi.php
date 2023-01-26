<?php

include '../koneksi.php';
session_start();
if (!isset($_SESSION['level'])) {
    if ($_SESSION["level"] != 'Admin') {
        echo "<script> alert('Anda belum login');</script>";
        echo "<script> location ='../login.php';</script>";
    }
}

$id = $_GET["id"];

$sql = mysqli_query($koneksi, "DELETE FROM transaksi WHERE idtransaksi='$id'");

if ($sql) {
    echo "<script>alert('Satu data transaksi telah dihapus');</script>";
    echo "<script> location ='../admin/transaksi.php';</script>";
}
