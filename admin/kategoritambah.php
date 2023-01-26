<h1><b>DATA KATEGORI</b></h1>
<form method="post">
	<div class="form-grup">
		<label>Nama Kategori</label>
		<input type="text" class="form-control" name="kategori">
	</div>
	<button class="button teal" name="tambah">Simpan</button>
</form>
<?php
if (isset($_POST['tambah'])) {
	$kategori = $_POST["kategori"];

	$koneksi->query("INSERT INTO kategori(judulkategori)
		VALUES ('$kategori')");
	echo "<script>alert('Data Berhasil Di Simpan');</script>";
	echo "<script> location ='index.php?halaman=kategori';</script>";
}
?>