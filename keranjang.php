<?php
session_start();
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
						<?php $data = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.id_produk=produk.idproduk WHERE user_id='$id'"); ?>
						<?php while ($fetch_data = mysqli_fetch_assoc($data)) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $fetch_data['namaproduk']; ?></td>
								<td>
									<img src="foto/<?= $fetch_data['gambar']; ?>" class="rounded" width="50px" alt="">
								</td>
								<td>Rp. <?= number_format($fetch_data['harga']); ?></td>
								<td><?= $fetch_data['jumlah']; ?></td>
								<td>Rp. <?= number_format($fetch_data['total']); ?></td>
								<td>
									<a href="keranjanghapus.php?id=<?= $fetch_data['id']; ?>" class="btn btn-danger">
										<i class="fa fa-ban"></i>
									</a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="mt-3">
			<a href="./produk.php">
				<button class="btn btn-success">+ Tambah Produk</button>
			</a>
		</div>
		<?php $data = mysqli_query($koneksi, "SELECT COUNT(*) AS count_transaksi FROM transaksi INNER JOIN produk ON transaksi.id_produk=produk.idproduk WHERE user_id='$id'"); ?>
		<?php $transaksi = mysqli_fetch_assoc($data); ?>
		<?php if ($transaksi['count_transaksi'] > 0) : ?>
			<div class="accordion mt-5" id="accordionExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingOne">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<strong>Checkout Details</strong>
						</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<form action="" method="POST">
								<label for="resipengiriman">Resi Pengiriman</label>
								<input type="text" name="resipengiriman" id="resipengiriman" style="height: 50px;" class="form-control" placeholder="Masukkan nama penerima">
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php include 'footer.php'; ?>