<?php

session_start();
include '../koneksi.php';

$title = 'Kategori';
$id_page = 'admin3';

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
						<!-- Large modal -->
<button type="button" class="btn btn-success create" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Kategori</button>

<div class="modal fade bd-example-modal-lg create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Tambah Kategori</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Kategori</span>
  </div>
  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Masukkan nama kategori">
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Tambah</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
						<div class="card mt-4">

							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="dataTable">
										<thead class="table-warning">
											<tr>
												<th>No</th>
												<th>Kategori</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr style="white-space: nowrap;">
												<td></td>
												<td></td>
												<td>
												<button type="button" class="btn btn-info" data-toggle="modal" data-target=".modalupdate"><i class="fa fa-cog"></i></button>

<div class="modal fade modalupdate" tabindex="-1" role="dialog" aria-labelledby="myLargeModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Ubah Kategori</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Kategori</span>
  </div>
  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Ubah nama kategori">
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info">Ubah</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".modaldelete"><i class="fa fa-trash"></i></button>

<div class="modal fade modaldelete" tabindex="-1" role="dialog" aria-labelledby="myLargeModal" aria-hidden="true">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Hapus Kategori</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <p>Hapus Kategori ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>

	</div>
</div>

<?php include './layouts/footer.php'; ?>