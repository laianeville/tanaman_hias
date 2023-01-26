<?php

ob_start();
session_start();

if (!isset($_SESSION['level'])) {
	if ($_SESSION["level"] != 'Admin') {
		echo "<script> alert('Anda belum login');</script>";
		echo "<script> location ='../login.php';</script>";
	}
}

include '../koneksi.php';

$title = 'Produk';
$id_page = 'admin2';

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
						<a href="../admin/tambah_produk.php">
							<button class="btn btn-success">Tambah Produk</button>
						</a>
						<div class="card mt-4">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="dataTable">
										<thead class="table-success">
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Keyword</th>
												<th>Kategori</th>
												<th>Harga</th>
												<th>Foto</th>
												<th style="white-space: nowrap;">Link Video</th>
												<th>Stok</th>
												<th>Aksi</th>
											</tr>
										</thead>

										<tbody>
											<?php $nomor = 1; ?>
											<?php $ambil = $koneksi->query("SELECT*FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori"); ?>
											<?php while ($datahasil = $ambil->fetch_assoc()) { ?>
												<tr>
													<td><?php echo $nomor; ?></td>
													<td><?php echo $datahasil['namaproduk'] ?></td>
													<td><?php echo $datahasil['keywordpencarian'] ?></td>
													<td><?php echo $datahasil['judulkategori'] ?></td>
													<td style="white-space: nowrap;">Rp. <?php echo number_format($datahasil['harga']) ?></td>
													<td>
														<img src="../foto/<?php echo $datahasil['gambar'] ?>" width="100px" style="border-radius:10px">
													</td>
													<td style="white-space: nowrap;">
														<a href="<?= $datahasil['video']; ?>" target="_blank">Lihat Video</a>
													</td>
													<td><?php echo $datahasil['stok'] ?></td>
													<td style="white-space: nowrap;">
														<a href="./update_produk.php?id=<?= $datahasil['idproduk']; ?>" class="btn btn-info">
															<i class="fa fa-cog"></i>
														</a>
														<a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" href="delete_produk.php?id=<?= $datahasil['idproduk']; ?>" class="btn btn-danger">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
												<?php $nomor++; ?>
											<?php } ?>
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