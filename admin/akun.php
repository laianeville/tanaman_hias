<?php

session_start();
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
												<th>Telepon</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr style="white-space: nowrap;">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>
													<button class="btn btn-info">
														<i class="fa fa-cog"></i>
													</button>
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