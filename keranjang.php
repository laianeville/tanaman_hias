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
						<tr>
							<td>1.</td>
							<td>Apa saja</td>
							<td>ma</td>
							<td>ma</td>
							<td>ma</td>
							<td>ma</td>
							<td>ma</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="mt-3">
			<a href="./produk.php">
				<button class="btn btn-success">+ Tambah Produk</button>
			</a>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>