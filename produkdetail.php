<?php
ob_start();

include 'koneksi.php';
if (!isset($_SESSION)) {
	session_start();
}
?>
<?php
$idproduk = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
$detail = $ambil->fetch_assoc();
$kategori = $detail["idkategori"];

$title = $detail['namaproduk'];
$id_page = null;

?>
<?php include 'header.php'; ?><br>

<section class="container-fluid">
	<div class="container">
		<div class="row justify-content-center" style="position: relative; top: 6em;">
			<div class="col-xl-11 mb-5">
				<div class="card" style=" box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-xl-5 p-0 rounded" style="height: 80vh;">
								<img src="foto/<?= $detail["gambar"]; ?>" style="width: 100%; height: 100%;  object-fit: cover;" alt="">
							</div>

							<div class="col-xl-7 p-4">
								<div class="d-flex align-items-center">
									<h4 style="font-weight: bold;" class="mb-0">
										<?= $detail['namaproduk']; ?>
									</h4>
									<span class="ms-2 text-secondary">(Stok: <?= $detail['stok']; ?>)</span>
								</div>
								<p><?= $detail['deskripsi']; ?></p>

								<h4 class="text-success" style="font-weight: bold;">Rp. <?= number_format($detail['harga']); ?></h4>

								<div class="mt-4">
									<?php if (isset($_SESSION['id'])) : ?>
										<form action="" method="post">
											<label for="beli_produk" class="text-secondary">Beli Produk:</label>
											<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" min="0" required id="jumlah" style="height: 8vh;">

											<div class="mt-3">
												<button class="px-5 btn btn-success" type="submit" name="checkout" style="height: 7vh;">
													<i class="fa fa-shopping-bag" aria-hidden="true"></i> Checkout
												</button>
										</form>
									<?php else : ?>
										<a href="./login.php">
											<button class="btn btn-info" type="button" style="height: 7vh;">Login</button>
										</a>
									<?php endif; ?>
									<a href="<?= $detail['video']; ?>" target="_blank">
										<button class="btn btn-primary ms-2" type="button" style="height: 7vh;"><i class="fa fa-video-camera me-2" aria-hidden="true"></i>Lihat Video</button>
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>

<div class="container-fluid" style="position: relative; top: 6em;">
	<div class="container">
		<div class="row">
			<h2 class="text-center mt-3" style="font-weight: bold;">Produk Terkait</h2>
		</div>
		<div class="row" style="row-gap: 20px;">
			<?php $ambil = $koneksi->query("SELECT *FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori where produk.idkategori = '$detail[idkategori]' and produk.harga >= '$detail[harga]'  order by idproduk desc"); ?>
			<?php while ($hasilproduk = $ambil->fetch_assoc()) { ?>
				<div class="col-xl-4 mb-3 mt-xl-0">
					<div class="card" style="border-radius: 0;">
						<div class="card-body p-0">
							<a href="produkdetail.php?id=<?= $hasilproduk['idproduk']; ?>">
								<div class="col-xl-12" style="height: 50vh">
									<img src="foto/<?= $hasilproduk['gambar'] ?>" style="width: 100%; height: 100%; object-fit: cover" alt="">
								</div>
							</a>
						</div>

						<div class="card-footer" style="background: #fff;">
							<div class="mb-2">
								<p class="mb-0" style="font-weight: 600; font-size: 20px">
									<?= $hasilproduk['namaproduk'] ?>
								</p>
							</div>

							<span class="mb-1 d-inline-block text-primary" style="border-radius: 25px;">
								<?= $hasilproduk['judulkategori']; ?>
							</span>


							<div class="d-flex justify-content-between align-items-center">
								<h5 class="text-success mb-0">
									Rp. <?= number_format($hasilproduk['harga']) ?>
								</h5>
								<a href="produkdetail.php?id=<?= $hasilproduk['idproduk']; ?>" class="btn btn-success mb-2" style="font-size: 14px">
									Beli Sekarang
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php

if (isset($_POST['checkout'])) {
	if (isset($_SESSION['id'])) {
		$user_id = $_SESSION['id'];
	}
	$id_produk = $detail['idproduk'];
	$jumlah = $_POST['jumlah'];
	$voucher = 10000;
	$total1 = $detail['harga'] * $jumlah;
	$total2 = ($detail['harga'] * $jumlah) - $voucher;

	if ($total1 >= 100000) {
		mysqli_query($koneksi, "INSERT INTO transaksi(user_id, id_produk, jumlah, voucher, total) VALUES('$user_id', '$id_produk', '$jumlah', '$voucher', '$total2')");
		header('Location: ./keranjang.php');
	} elseif ($total1 < 100000) {
		mysqli_query($koneksi, "INSERT INTO transaksi(user_id, id_produk, jumlah, voucher, total) VALUES('$user_id', '$id_produk', '$jumlah', '$voucher', '$total1')");
		header('Location: ./keranjang.php');
	}
}
?>

<?php
include 'footer.php';
?>