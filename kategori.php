<?php
session_start();
include 'koneksi.php';

?>

<?php include 'header.php';
$kategori = $_GET["id"];


$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM produk WHERE idkategori = '$kategori'");
while ($datahasil = $ambil->fetch_assoc()) {
	$semuadata[] = $datahasil;
}
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<?php $am = $koneksi->query("SELECT * FROM kategori where idkategori='$kategori'");
$pe = $am->fetch_assoc()
?>

<section class="jaraksection">
	<div class="kontainer">
		<div class="row mb-3 pb-3">
			<div class="kolom-md-12 judulsection animasikontainer">
				<h3 class="mb-4">Kategori : <?php echo $pe["judulkategori"] ?></h3>
				<?php if (empty($semuadata)) : ?>
					<div class="alert alert-merah">Produk <strong><?php echo  $pe["judulkategori"] ?></strong> Kosong</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="kontainer">
		<div class="row">
			<?php foreach ($semuadata as $key => $hasilproduk) : ?>
				<div class="kolom-md-6 kolom-lg-4 animasikontainer">
					<div class="produk">
						<a href="produkdetail.php?id=<?php echo $hasilproduk['idproduk']; ?>"><img src="foto/<?php echo $hasilproduk['gambar'] ?>" style="height:300px;width:100%" alt="">
						</a>
						<div class="text py-3 pb-4 px-3 text-tengah">
							<center>
							<h3><a href="produkdetail.php?id=<?php echo $hasilproduk['idproduk']; ?>"><?php echo $hasilproduk['namaproduk'] ?></a></h3>
							<p class="text-merah text-tengah"><span>Rp <?php echo number_format($hasilproduk['harga']) ?></span></p>
							<a class="btn btn-hijau" href="produkdetail.php?id=<?php echo $hasilproduk['idproduk']; ?>">Beli</a>
							<center>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<?php
include 'footer.php';
?>