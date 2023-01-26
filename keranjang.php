<?php
ob_start();
session_start();
if (!isset($_SESSION["level"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
$id_page = 4;
$title = 'Keranjang';
include 'koneksi.php';
?>
<?php include 'header.php'; ?>

<section class="container-fluid" style="position: relative; top: 7em;">
	<div class="container">
		<div class="row">
			<div class="col-xl-4">
				<h4 style="font-weight: bold;">Keranjang</h4>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="dataTable">
					<thead class="table-success">
						<tr>
							<th>No.</th>
							<th>Email</th>
							<th>Produk</th>
							<th>Foto</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total</th>
							<th>Aksi</th>
						</tr>
					</thead>

					<tbody>
						<?php $no = 1; ?>
						<?php if (isset($_SESSION['id'])) {
							$id = $_SESSION['id'];
						} ?>
						<?php $data = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.id_produk=produk.idproduk INNER JOIN akun ON transaksi.user_id=akun.id WHERE user_id='$id' AND status='pending'"); ?>
						<?php while ($fetch_data = mysqli_fetch_assoc($data)) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $fetch_data['email']; ?></td>
								<td><?= $fetch_data['namaproduk']; ?></td>
								<td>
									<img src="foto/<?= $fetch_data['gambar']; ?>" class="rounded" width="50px" alt="">
								</td>
								<td>Rp. <?= number_format($fetch_data['harga']); ?></td>
								<td><?= $fetch_data['jumlah']; ?></td>
								<td>Rp. <?= number_format($fetch_data['total']); ?></td>
								<td>
									<a href="keranjanghapus.php?id=<?= $fetch_data['idtransaksi']; ?>" class="btn btn-danger">
										<i class="fa fa-ban"></i>
									</a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="my-3">
			<a href="./produk.php">
				<button class="btn btn-success">+ Tambah Produk</button>
			</a>
		</div>
		<?php $data = mysqli_query($koneksi, "SELECT COUNT(*) AS count_transaksi FROM transaksi INNER JOIN produk ON transaksi.id_produk=produk.idproduk WHERE user_id='$id' AND status='pending'"); ?>
		<?php $transaksi = mysqli_fetch_assoc($data); ?>
		<?php if ($transaksi['count_transaksi'] > 0) : ?>
			<div class="accordion mt-4" id="accordionExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingOne">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<strong>Checkout Details</strong>
						</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<form action="" method="POST">
								<div class="mt-2">
									<label for="resipengiriman">Resi Pengiriman</label>
									<input type="text" required name="resipengiriman" id="resipengiriman" style="height: 50px;" class="form-control" placeholder="Masukkan nama penerima">
								</div>

								<div class="mt-4">
									<label for="alamatpengiriman">Alamat Pengiriman</label>
									<textarea type="text" required name="alamatpengiriman" id="alamatpengiriman" class="form-control" placeholder="Masukkan alamat penerima"></textarea>
								</div>

								<button class="btn btn-primary mt-4" name="take" type="submit">Take it</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php

if (isset($_POST['take'])) {
	date_default_timezone_set('Asia/Jakarta');
	$notransaksi = time();
	$resipengiriman = $_POST['resipengiriman'];
	$alamatpengiriman = $_POST['alamatpengiriman'];
	$tanggalbeli = date('Y-m-d', strtotime('now'));

	if (isset($_SESSION['id'])) {
		$id = $_SESSION['id'];
	}

	$sql = mysqli_query($koneksi, "UPDATE transaksi SET notransaksi='$notransaksi', resipengiriman='$resipengiriman', alamatpengiriman='$alamatpengiriman', tanggalbeli='$tanggalbeli', status='berhasil' WHERE user_id='$id' AND status='pending'");

	if ($sql) {
		header('location: ./riwayat.php');
	}
}

?>

<?php include 'footer.php'; ?>