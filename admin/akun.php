<?php

session_start();

if (!isset($_SESSION['level'])) {
	if ($_SESSION["level"] != 'Admin') {
		echo "<script> alert('Anda belum login');</script>";
		echo "<script> location ='../login.php';</script>";
	}
}

include '../koneksi.php';

$title = 'Akun Member';
$id_page = 'admin5';

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
				<div class="row">
					<div class="col-xl-12">
						<div class="card mt-4">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="dataTable">
										<thead class="table-dark">
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Email</th>
												<th>Jenis Kelamin</th>
												<th>Telepon</th>
												<th>Alamat</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php $users = mysqli_query($koneksi, "SELECT * FROM akun WHERE level='Pelanggan'"); ?>
											<?php while ($data = mysqli_fetch_assoc($users)) : ?>
												<tr style="white-space: nowrap;">
													<td><?= $no++; ?></td>
													<td><?= $data['nama']; ?></td>
													<td><?= $data['email']; ?></td>
													<td><?= $data['jeniskelamin']; ?></td>
													<td><?= $data['nohp']; ?></td>
													<td><?= $data['alamat']; ?></td>
													<td>
														<a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" href="delete_akun.php?id=<?= $data['id']; ?>" class="btn btn-danger">
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