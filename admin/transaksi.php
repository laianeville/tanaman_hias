<?php

session_start();
if (!isset($_SESSION['level'])) {
	if ($_SESSION["level"] != 'Admin') {
		echo "<script> alert('Anda belum login');</script>";
		echo "<script> location ='../login.php';</script>";
	}
}
include '../koneksi.php';

$title = 'Transaksi';
$id_page = 'admin4';

include './layouts/header.php';

?>


<div class="wrapper">

	<?php include './layouts/navbar.php'; ?>

	<?php include './layouts/sidebar.php'; ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 font-weight-bold"><?= $title; ?></h1>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container-fluid">
				<!-- Small boxes (Stat box) -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mt-4">

							<div class="card-body">
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
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>

										<tbody>
											<?php $no = 1; ?>
											<?php if (isset($_SESSION['id'])) {
												$id = $_SESSION['id'];
											} ?>
											<?php $data = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.id_produk=produk.idproduk INNER JOIN akun ON transaksi.user_id=akun.id"); ?>
											<?php while ($fetch_data = mysqli_fetch_assoc($data)) : ?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $fetch_data['email']; ?></td>
													<td><?= $fetch_data['namaproduk']; ?></td>
													<td>
														<img src="../foto/<?= $fetch_data['gambar']; ?>" class="rounded" width="50px" alt="">
													</td>
													<td>Rp. <?= number_format($fetch_data['harga']); ?></td>
													<td><?= $fetch_data['jumlah']; ?></td>
													<td>Rp. <?= number_format($fetch_data['total']); ?></td>
													<td>
														<?php if ($fetch_data['status'] == 'pending') : ?>
															<span class="px-3 bg-warning" style="border-radius: 20px;"><?= $fetch_data['status']; ?></span>
														<?php else : ?>
															<span class="px-3 bg-success text-light" style="border-radius: 20px;"><?= $fetch_data['status']; ?></span>
														<?php endif; ?>
													</td>
													<td>
														<a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" href="delete_transaksi.php?id=<?= $fetch_data['idtransaksi']; ?>" class="btn btn-danger">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
											<?php endwhile; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.row (main row) -->
			</div><!-- /.container-fluid -->
		</section>
	</div>
</div>

<?php include './layouts/footer.php'; ?>