<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["level"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
$id_page = null;
$title = 'Riwayat Transaksi';
?>
<?php include 'header.php'; ?>

<section class="container-fluid" style="position: relative; top: 7em;">
	<div class="container">
		<div class="row">
			<div class="col-xl-4">
				<h4 style="font-weight: bold;">Riwayat Transaksi</h4>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="dataTable">
					<thead class="table-info">
						<tr>
							<th>No.</th>
							<th>Email</th>
							<th>Produk</th>
							<th>Foto</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
					</thead>

					<tbody>
						<?php $no = 1; ?>
						<?php if (isset($_SESSION['id'])) {
							$id = $_SESSION['id'];
						} ?>
						<?php $data = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.id_produk=produk.idproduk INNER JOIN akun ON transaksi.user_id=akun.id WHERE user_id='$id' AND status='berhasil'"); ?>
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
									<span class="px-3 bg-success text-light" style="border-radius: 20px;">
										<?= ucfirst($fetch_data['status']); ?>
									</span>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<?php
include 'footer.php';
?>