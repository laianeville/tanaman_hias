<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE idkategori='$_GET[id]'");
$datahasil = $ambil->fetch_assoc();
?>
<h1><b>UBAH KATEGORI</b></h1>
<form method="post">
	<div class="form-grup">
		<label>Nama Kategori</label>
		<input type="text" class="form-control" name="kategori" value=" <?php echo $datahasil['judulkategori']; ?>">
	</div>
	<button class="button teal" name="ubah">Simpan</button>
</form>
<?php
if (isset($_POST['ubah'])) {
	$koneksi->query("UPDATE kategori SET judulkategori='$_POST[kategori]' WHERE idkategori='$_GET[id]'");
	echo "<script>alert('Data Berhasil Di Simpan');</script>";
	echo "<script> location ='index.php?halaman=kategori';</script>";
}
?>