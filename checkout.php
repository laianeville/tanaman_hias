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
								<th>Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $totalberat = 0; ?>
							<?php $totalbelanja = 0; ?>
							<?php foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
								<?php
								$ambil = $koneksi->query("SELECT * FROM produk 
					WHERE idproduk='$idproduk'");
								$datahasil = $ambil->fetch_assoc();
								$totalharga = $datahasil["harga"] * $jumlah;
								$subberat = $datahasil["berat"] * $jumlah;
								$totalberat += $subberat;

								?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $datahasil['namaproduk']; ?></td>
									<td>Rp <?php echo number_format($datahasil['harga']); ?></td>
									<td><?php echo $jumlah; ?></td>
									<td>Rp <?php echo number_format($totalharga); ?></td>
								</tr>
								<?php $nomor++; ?>
								<?php $totalbelanja += $totalharga; ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="kontainer mt-4">
		<form method="post">
			<div class="row">
				<div class="kolom-md-6">
					<div class="form-grup">
						<label>Nama</label>
						<input type="text" readonly value="<?php echo $_SESSION["akun"]['nama'] ?>" class="form-gaya">
					</div>
					<div class="form-grup">
						<label>No. HP</label>
						<input type="text" readonly value="<?php echo $_SESSION["akun"]['nohp'] ?>" class="form-gaya">
					</div>
					<div class="form-grup">
						<label>Alamat</label>
						<input type="hidden" name="totalberatnya" value="<?php echo $totalberat ?>">
						<textarea class="form-gaya" name="alamatpengiriman" id="alamatpengiriman" placeholder="Masukkan Alamat"><?php echo $_SESSION["akun"]['alamat'] ?></textarea>
						<script>
							CKEDITOR.replace('alamatpengiriman');
						</script>
					</div>
					<div class="form-grup">
						<label>Kota</label>
						<select name="kota" class="form-gaya" required id="Sone" onchange="check()">
							<option value="">Pilih Kota</option>
							<option value="Jakarta Utara">Jakarta Utara</option>
							<option value="Jakarta Barat">Jakarta Barat</option>
							<option value="Jakarta Selatan">Jakarta Selatan</option>
							<option value="Jakarta Timur">Jakarta Timur</option>
							<option value="Bekasi">Bekasi</option>
							<option value="Depok">Depok</option>
							<option value="Bogor">Bogor</option>
							<option value="Bandung">Bandung</option>
						</select>
					</div>
				</div>
				<div class="kolom-md-6">
					<input type="hidden" id="dua" name="dua" value="<?php echo $totalbelanja ?>">
					<div class="form-grup">
						<label>Ongkos Kirim</label>
						<input class="form-gaya" name="ongkir" type="number" readonly required id="res">
					</div>
					<div class="form-grup">
						<label>Grand Total</label>
						<input class="form-gaya" id="result" required readonly type="number">
					</div>
					<button class="btn btn-biru pull-right btn-lg" name="checkout">Selesaikan Transaksi</button>
				</div>
			</div>
		</form>
	</div>
</section>
<?php
if (isset($_POST["checkout"])) {
	$notransaksi = '#TP' . date("Ymdhis");
	$id = $_SESSION["akun"]["id"];
	$tanggalbeli = date("Y-m-d");
	$waktu = date("Y-m-d H:i:s");
	$alamatpengiriman = $_POST["alamatpengiriman"];
	$totalbeli = $totalbelanja;
	$totalberatnya = $_POST["totalberatnya"];
	$ongkir = $_POST["ongkir"];
	$kota = $_POST["kota"];
	$koneksi->query(
		"INSERT INTO transaksi(notransaksi,
				id, tanggalbeli, totalbeli, alamatpengiriman, totalberat, kota, ongkir, statusbeli, waktu)
				VALUES('$notransaksi','$id', '$tanggalbeli', '$totalbeli', '$alamatpengiriman','$totalberat','$kota','$ongkir', 'Belum Bayar', '$waktu')"
	);
	$idtransaksi_barusan = $koneksi->insert_id;
	foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
		$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
		$hasilproduk = $ambil->fetch_assoc();
		$nama = $hasilproduk['namaproduk'];
		$harga = $hasilproduk['harga'];
		$berat = $hasilproduk['berat'];

		$subberat = $hasilproduk['berat'] * $jumlah;
		$subharga = $hasilproduk['harga'] * $jumlah;
		$koneksi->query("INSERT INTO transaksidetail (idtransaksi, idproduk, nama, harga, berat, subberat, subharga, jumlah)
					VALUES ('$idtransaksi_barusan','$idproduk', '$nama','$harga','$berat', '$subberat', '$subharga','$jumlah')");

		$koneksi->query("UPDATE produk SET stok=stok -$jumlah
					WHERE idproduk='$idproduk'");
	}
	unset($_SESSION["keranjang"]);
	echo "<script> alert('Transaksi Sukses');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>

<script>
	$(document).ready(function() {
		$.ajax({
			type: 'post',
			url: 'dataprovinsi.php',
			hijau: function(hasil_provinsi) {
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});
		$("select[name=nama_provinsi").on("change", function() {
			var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
			$.ajax({
				type: 'post',
				url: 'datadistrict.php',
				data: 'id_provinsi=' + id_provinsi_terpilih,
				hijau: function(hasil_distrik) {
					$("select[name=nama_distrik]").html(hasil_distrik);
				}
			});
		});
		$.ajax({
			type: 'post',
			url: 'dataekspedisi.php',
			hijau: function(hasil_ekspedisi) {
				$("select[name=ekspedisi]").html(hasil_ekspedisi);
			}
		});
		$("select[name=ekspedisi]").on("change", function() {
			var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
			// alert(ekspedisi_terpilih);

			var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
			// alert(distrik_terpilih)

			var total_berat = $("input[name=total_berat]").val();
			$.ajax({
				type: 'post',
				url: 'datapaket.php',
				data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
				hijau: function(hasil_paket) {
					// console.log(hasil_paket);
					$("select[name=nama_paket]").html(hasil_paket);

					$("input[name=namaekspedisi]").val(ekspedisi_terpilih);
				}
			})
		});
		$("select[name=nama_distrik]").on("change", function() {
			var prov = $("option:selected", this).attr("nama_provinsi");
			var dist = $("option:selected", this).attr("nama_distrik");
			var tipe = $("option:selected", this).attr("tipe_distrik");
			var kodepos = $("option:selected", this).attr("kodepos");
			// alert(prov);
			$("input[name=provinsi]").val(prov);
			$("input[name=distrik]").val(dist);
			$("input[name=tipe]").val(tipe);
			$("input[name=kodepos]").val(kodepos);


		});
		$("select[name=nama_paket]").on("change", function() {
			var paket = $("option:selected", this).attr("paket");
			var ongkir = $("option:selected", this).attr("ongkir");
			var etd = $("option:selected", this).attr("etd");
			$("input[name=paket]").val(paket);
			$("input[name=ongkir").val(ongkir);
			$("input[name=estimasi").val(etd);
		})


	});
</script>
<script>
	function check() {
		var val = document.getElementById('Sone').value;
		if (val == 'Lahat') {
			document.getElementById('res').value = "5000";
		} else if (val == 'Jakarta Utara') {
			document.getElementById('res').value = "7000";
		} else if (val == 'Jakata Barat') {
			document.getElementById('res').value = "7000";
		} else if (val == 'Jakarta Selatan') {
			document.getElementById('res').value = "7000";
		} else if (val == 'Jakarta Timur') {
			document.getElementById('res').value = "10000";
		} else if (val == 'Bekasi') {
			document.getElementById('res').value = "10000";
		} else if (val == 'Depok') {
			document.getElementById('res').value = "10000";
		} else if (val == 'Bogor') {
			document.getElementById('res').value = "10000";
		} else if (val == 'Bandung') {
			document.getElementById('Cimahi').value = "12000";
		}
		var num1 = document.getElementById("res").value;
		var num2 = document.getElementById("dua").value;
		result = parseInt(num1) + parseInt(num2);
		document.getElementById("result").value = result;

	}
</script>