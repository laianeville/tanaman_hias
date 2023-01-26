<?php

session_start();
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
										<thead class="table-primary">
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Tanggal Transaksi</th>
												<th>Total Transaksi</th>
												<th>Status Belanja</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr style="white-space: nowrap;">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>
													<button class="btn btn-danger">
														<i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
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