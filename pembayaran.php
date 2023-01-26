<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["akun"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
	exit();
}
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM transaksi WHERE idtransaksi='$idpem'");
$detpem = $ambil->fetch_assoc();

$id_beli = $detpem["id"];
$id_login = $_SESSION["akun"]["id"];
if ($id_login !== $id_beli) {
	echo "<script> alert('Gagal');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
$deadline = date('Y-m-d H:i', strtotime($detpem['waktu'] . ' +1 day'));
$harideadline = date('Y-m-d', strtotime($detpem['waktu'] . ' +1 day'));
$jamdeadline = date('H:i', strtotime($detpem['waktu'] . ' +1 day'));
if (date('Y-m-d H:i') >= $deadline) {
	echo "<script> alert('Waktu pembayaran telah habis');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<?php include 'header.php'; ?>
<section id="jarakbadan" class="jaraksection">
	<div class="kontainer mt-4">
		<div class="row konten-baris-tengah">
			<div class="kolom-md-5">
				<img width="100%" src="foto/Bayar2.webp">
			</div>
			<div class="kolom-md-7">
				<h5 class="text-merah">Upload Bukti Pembayaran Sebelum<br><?= tanggal($harideadline) . ' - Jam ' . $jamdeadline ?></h5>
				<p>Kirim Bukti Pembayaran</p>
				<p>No Rek : 123456789 </p>
				<b>(Bank BCA, Atas Nama : Toko Tanaman Hias)</b>
				<br>
				<br>
				<div class="alert alert-info">Total Tagihan Anda : <strong>Rp. <?php echo number_format($detpem["totalbeli"] + $detpem["ongkir"]) ?></strong></div>

				<form method="post" enctype="multipart/form-data">
					<div class="form-grup">
						<label>Nama Rekening</label>
						<input type="text" name="nama" class="form-gaya" required>

					</div>
					<div class="form-grup">
						<label>Tanggal Transfer</label>
						<input type="date" name="tanggaltransfer" class="form-gaya" required>

					</div>
					<div class="form-grup">
						<label>Foto Bukti</label>
						<input type="file" name="bukti" class="form-gaya" required>
					</div>
					<button class="btn btn-biru float-right" name="kirim">Simpan</button>
				</form>
			</div>
		</div>
		<br>
		<br>
		<?php
		$ambil = $koneksi->query("SELECT*FROM transaksi JOIN akun
	ON transaksi.id=akun.id
	WHERE transaksi.idtransaksi='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>

		<div class="row">
			<div class="kolom-md-6">
				<strong>NO TRANSAKSI: <?php echo $detail['notransaksi']; ?></strong><br>
				Tanggal : <?= tanggal(date('Y-m-d', strtotime($detail['tanggalbeli']))) ?><br>
				Status Barang : <?php echo $detail['statusbeli']; ?><br>
				Total Transaksi : Rp. <?php echo number_format($detail['totalbeli']); ?><br>
				Ongkir : Rp. <?php echo number_format($detail['ongkir']); ?><br>
				Total Bayar : Rp. <?php echo number_format($detail['ongkir'] + $detail['totalbeli']); ?>
			</div>
			<div class="kolom-md-6">
				<strong>NAMA : <?php echo $detail['nama']; ?></strong><br>
				Telepon : <?php echo $detail['nohp']; ?><br>
				Email : <?php echo $detail['email']; ?>
				Kota : <?php echo $detail['kota']; ?><br>
				Alamat Pengiriman : <?php echo $detail['alamatpengiriman']; ?><br>
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
</section>
<br><br>
<?php
if (isset($_POST["kirim"])) {
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis") . $namabukti;
	move_uploaded_file($lokasibukti, "foto/$namafix");

	$nama = $_POST["nama"];
	$tanggaltransfer = $_POST["tanggaltransfer"];
	$tanggal = date("Y-m-d");


	$koneksi->query("INSERT INTO pembayaran(idtransaksi, nama, tanggaltransfer,tanggal, bukti)
		VALUES ('$idpem','$nama','$tanggaltransfer','$tanggal','$namafix')");

	$koneksi->query("UPDATE transaksi SET statusbeli='Sudah Upload Bukti Pembayaran'
		WHERE idtransaksi='$idpem'");
	echo "<script> alert('Terima kasih');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>