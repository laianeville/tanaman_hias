<?php
$ambil = $koneksi->query("SELECT * FROM transaksi JOIN akun
	ON transaksi.id=akun.id
	WHERE transaksi.idtransaksi='$_GET[id]'");
$detailtransaksi = $ambil->fetch_assoc();
?>
<h1><b>DETAIL TRANSAKSI</b></h1>
<div class="row">
	<div class="col-md-6">
		<strong>NO TRANSAKSI: <?php echo $detailtransaksi['notransaksi']; ?></strong><br>
		Tanggal : <?= tanggal(date('Y-m-d', strtotime($detailtransaksi['tanggalbeli']))) ?><br>
		Status Barang : <?php echo $detailtransaksi['statusbeli']; ?><br>
		Total Transaksi : Rp. <?php echo number_format($detailtransaksi['totalbeli']); ?><br>
		Ongkir : Rp. <?php echo number_format($detailtransaksi['ongkir']); ?><br>
		Total Bayar : Rp. <?php echo number_format($detailtransaksi['ongkir'] + $detailtransaksi['totalbeli']); ?>
	</div>
	<br>
	<div class="col-md-6">
		<strong>NAMA : <?php echo $detailtransaksi['nama']; ?></strong><br>
		Telepon : <?php echo $detailtransaksi['nohp']; ?><br>
		Email : <?php echo $detailtransaksi['email']; ?>
		Kota : <?php echo $detailtransaksi['kota']; ?><br>
		Alamat Pengiriman : <?php echo $detailtransaksi['alamatpengiriman']; ?><br>
	</div>
</div>
<br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Total Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM transaksidetail WHERE idtransaksi='$_GET[id]'"); ?>
		<?php while ($datahasil = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $datahasil['nama']; ?></td>
				<td>Rp. <?php echo number_format($datahasil['harga']); ?></td>
				<td><?php echo $datahasil['jumlah']; ?></td>
				<td>Rp. <?php echo number_format($datahasil['subharga']); ?></td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<br>
<a class="button teal" target="_blank" href="../notacetak.php?id=<?= $_GET['id'] ?>">Download Nota</a>
<?php
$idtransaksi = $_GET['id'];
$ambil = $koneksi->query("SELECT*FROM pembayaran WHERE idtransaksi='$idtransaksi'") or die(mysqli_error($koneksi));
$detail = $ambil->fetch_assoc();
$am = $koneksi->query("SELECT*FROM transaksi WHERE idtransaksi='$idtransaksi'") or die(mysqli_error($koneksi));
$det = $am->fetch_assoc();
?>
<br>
<br>
<?php if ($detailtransaksi['statusbeli'] != 'Belum Bayar') { ?>
	<div class="card bayangan mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<tr>
							<th>Nama</th>
							<th><?php echo $detail['nama'] ?></th>
						</tr>
						<tr>
							<th>Tanggal Transfer</th>
							<th><?= tanggal(date('Y-m-d', strtotime($detail['tanggaltransfer']))) ?></th>
						</tr>
						<tr>
							<th>Tanggal Upload Bukti Pembayaran</th>
							<th><?= tanggal(date('Y-m-d', strtotime($detail['tanggal']))) ?></th>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<br>
	<strong>BUKTI PEMBAYARAN</strong>
	<br>
	<img src="../foto/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive" width="300px">
	<br>
	<br>
	<form method="post">
		<div class="form-grup">
			<label>Masukkan No Resi Pengiriman</label>
			<input type="text" class="form-control" name="resi" value="<?php echo $det['resipengiriman'] ?>">
		</div>
		<div class="form-grup">
			<label>Status</label>
			<select class="form-control" name="statusbeli">
				<option value="Belum di Konfirmasi">Belum di Konfirmasi</option>
				<option value="Pesanan Di Tolak">Pesanan Di Tolak</option>
				<option value="Barang Di Kemas">Barang Di Kemas</option>
				<option value="Barang Di Kirim">Barang Di Kirim</option>
				<option value="Barang Telah Sampai ke Pemesan">Barang Telah Sampai ke Pemesan</option>
			</select>
		</div>
		<br>
		<button class="button teal" name="proses">Simpan</button>
		<br>
		<br>
	</form>
	</div>
<?php } ?>
<?php
if (isset($_POST["proses"])) {
	$resi = $_POST["resi"];
	$statusbeli = $_POST["statusbeli"];
	$koneksi->query("UPDATE transaksi SET resipengiriman='$resi', statusbeli='$statusbeli'
		WHERE idtransaksi='$idtransaksi'");
	echo "<script>alert('Data Berhasil Di Simpan');</script>";
	echo "<script>location='index.php?halaman=transaksi';</script>";
} ?>