<?php
ob_start();
session_start();
include 'koneksi.php';

$id = $_GET["id"];

$sql = mysqli_query($koneksi, "DELETE FROM checkout WHERE id=$id");

if ($sql) {
    header('location: ./keranjang.php');
}

echo "<script> alert('Berhasil Menghapus Data Produk di Keranjang');</script>";
echo "<script> location ='keranjang.php';</script>";
