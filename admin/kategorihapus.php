
<?php
$koneksi->query("DELETE FROM kategori WHERE idkategori='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";
?>