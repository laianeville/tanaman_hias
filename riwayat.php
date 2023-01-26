<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["akun"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
?>
<?php include 'header.php'; ?><br><br><br>
<section id="jarakbadan" class="hero">
	<div class="kontainer mt-4">
		<div class="row">
			<div class="kolom-md-12 animasikontainer">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-white">
							<tr class="text-tengah">
								<th>No</th>
								<th>Daftar</th>
								<th>Tanggal</th>
								<th>Berat</th>
								<th>Total</th>
								<th>Bukti Pembayaran</th>
								<th>Nota</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1;
							$id = $_SESSION["akun"]['id'];
							$ambil = $koneksi->query("SELECT *, transaksi.idtransaksi as idtransaksireal FROM transaksi left join pembayaran on transaksi.idtransaksi = pembayaran.idtransaksi WHERE transaksi.id='$id' order by transaksi.tanggalbeli desc, transaksi.idtransaksi desc");
							while ($datahasil = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td>
										<?php $ambildetail = $koneksi->query("SELECT * FROM transaksidetail WHERE idtransaksi='$datahasil[idtransaksireal]'") or die(mysqli_error($koneksi)); ?>
										<?php while ($detail = $ambildetail->fetch_assoc()) {
										?>
											<?= $detail['nama'] . ' x ' . $detail['jumlah'] ?>
										<?php } ?>
									</td>
									<td><?php echo tanggal($datahasil['tanggalbeli']) ?></td>
									<td><?php echo $datahasil["totalberat"] ?> KG</td>
									<td>Rp. <?php echo number_format($datahasil["totalbeli"] + $datahasil["ongkir"]); ?></td>
									<td>
										<?php if ($datahasil['bukti'] != "") { ?>
											<img width="150px" src="foto/<?= $datahasil['bukti'] ?>" alt="">
										<?php } else { ?>
											<b>Belum mengupload bukti pembayaran</b>
										<?php } ?>
									</td>
									<td>
										<?php if ($datahasil['statusbeli'] == "Belum Bayar") {
											$deadline = date('Y-m-d H:i', strtotime($datahasil['waktu'] . ' +1 day'));
											$harideadline = date('Y-m-d', strtotime($datahasil['waktu'] . ' +1 day'));
											$jamdeadline = date('H:i', strtotime($datahasil['waktu'] . ' +1 day'));
											if (date('Y-m-d H:i') >= $deadline) {
												echo 'Waktu pembayaran<br>telah habis';
											} else { ?>
												<a href="pembayaran.php?id=<?php echo $datahasil["idtransaksireal"] ?>" class="btn btn-merah">Silahkan Upload<br>Pembayaran Sebelum<br><?= tanggal($harideadline) . ' - Pukul ' . $jamdeadline ?></a>
											<?php }
										} elseif ($datahasil['statusbeli'] == "Sudah Upload Bukti Pembayaran") { ?>
											<a class="btn btn-merah text-putih">Menunggu Konfirmasi Admin</a>
										<?php } elseif ($datahasil['statusbeli'] == "Barang Di Kirim") { ?>
											<a class="btn btn-merah text-putih">Barang Anda Sedang Di Kirim, Mohon Di Tungggu</a>
											<br><br>
											<p><a target="_blank" href="https://cekresi.com">No Resi : <?= $datahasil['resipengiriman'] ?></a></p>
										<?php } elseif ($datahasil['statusbeli'] == "Barang Telah Sampai ke Pemesan") { ?>
											<a data-toggle="modal" data-target="#selesai<?= $nomor ?>" class="btn btn-hijau text-putih">Konfirmasi Selesai</a>
										<?php } elseif ($datahasil['statusbeli'] == "Selesai") { ?>
											<a href="ulasan.php?id=<?= $datahasil["idtransaksi"] ?>" class="btn btn-hijau text-putih">Berikan Ulasan</a>
										<?php } elseif ($datahasil['statusbeli'] == "Pesanan Di Tolak") { ?>
											<a class="btn btn-merah text-putih">Pesanan Anda Di Tolak</a>
										<?php } ?>
										<br>
										<br>
										<a class="btn btn-hijau" target="_blank" href="notacetak.php?id=<?= $datahasil['idtransaksireal'] ?>">Download Nota <i class="fa fa-download"></i></a>
									</td>
								</tr>
								<?php $nomor++; ?>
							<?php  } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$no = 1;
$id = $_SESSION["akun"]['id'];
$ambil = $koneksi->query("SELECT *, transaksi.idtransaksi as idtransaksireal FROM transaksi left join pembayaran on transaksi.idtransaksi = pembayaran.idtransaksi WHERE transaksi.id='$id' order by transaksi.tanggalbeli desc, transaksi.idtransaksi desc");
while ($datahasil = $ambil->fetch_assoc()) { ?>
	<div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post">
					<div class="modal-body">
						<h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
					</div>
					<div class="modal-footer">
						<input type="hidden" class="form-contol" value="<?= $datahasil['idtransaksi'] ?>" name="idtransaksi">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="selesai" value="selesai" class="btn btn-biru">Konfirmasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	$no++;
} ?>
<?php
if (isset($_POST["selesai"])) {
	$koneksi->query("UPDATE transaksi SET statusbeli='Selesai'
		WHERE idtransaksi='$_POST[idtransaksi]'");
	echo "<script>alert('Pesanan berhasil di konfirmasi selesai')</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>