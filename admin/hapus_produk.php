<?php
include '../koneksi.php';
$sql = mysqli_query($koneksi, "DELETE FROM produk WHERE idproduk='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='../admin/produk.php';</script>";
