<?php
session_start();
include 'koneksi.php';
$id_page = 1;
$title = "Home";
?>

<?php include 'header.php'; ?>
<div class="container-fluid" style="height: 100vh;">
	<div class="container">
		<div class="row justify-content-between align-items-center mt-xl-0" style="height: 60vh; position: relative; top: 7em;">
			<div class="col-xl-5">
				<h2 style="font-weight: bold;">Hadirkan Beragam <span style="color: #008000;">Tanaman
						Berkualitas</span>
				</h2>
				<p>
					Jadikan lingkungan sekitar mu menjadi hijau dan bernafaslah bersih dengan sebebas mungkin tanpa
					adanya polusi udara.
				</p>
				<button class="btn text-light" style="background: #008000; height: 48px;">
					Belanja Sekarang
				</button>
				<button class="btn ms-2" style="height: 48px; color: #008000;">Hubungi
					kami
					></button>
			</div>

			<div class="col-xl-5 mt-3 mt-xl-0 p-0">
				<img src="./foto/ils.svg" style="width: 100%;">
			</div>
		</div>
	</div>
</div>

<div class="container-fluid mb-5">
	<div class="container">
		<!-- konsultasi section -->
		<div class="row px-xl-2 py-xl-5 p-3 rounded justify-content-center" style="background: #008000;">
			<div data-aos="zoom-in" class="col-12 col-xl-6 text-light d-flex flex-column justify-content-center">
				<h1 style="font-weight: bold;">Tentang Kami!</h1>
				<p>
					Toko Tanaman Hias merupakan toko yang berjual berbagai tanaman hias baik bunga dan tumbuhan lainnya dengan harga termurah.
				</p>
			</div>
			<div class="col-12 col-xl-5">
				<img src="./foto/depan.jpg" class="rounded mb-4 mt-xl-0" style="width: 100%;height:100%;" alt="nepil image">
			</div>
		</div>
	</div>
</div>

<div class="container-fluid mb-5">
	<div class="container">
		<div class="row">
			<h3 class="text-center mb-4" style="color: #008000; font-weight: bold;">
				Produk Terbaru
			</h3>
		</div>

		<div class="row" style="row-gap: 20px;">
			<?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc limit 3"); ?>
			<?php while ($hasilproduk = $ambil->fetch_assoc()) { ?>
				<div class="col-xl-4 mt-3 mt-xl-0">
					<div class="card" style="border-radius: 0;">
						<div class="card-body p-0">
							<a href="produkdetail.php?id=<?= $hasilproduk['idproduk']; ?>">
								<div class="col-xl-12" style="height: 50vh">
									<img src="foto/<?= $hasilproduk['gambar'] ?>" style="width: 100%; height: 100%; object-fit: cover" alt="">
								</div>
							</a>
						</div>

						<div class="card-footer" style="background: #fff;">
							<div class="mb-2">
								<p class="mb-0" style="font-weight: 600; font-size: 20px">
									<?= $hasilproduk['namaproduk'] ?>
								</p>
							</div>

							<span class="mb-1 d-inline-block text-primary" style="border-radius: 25px;">
								<?= $hasilproduk['judulkategori']; ?>
							</span>

							<div class="d-flex justify-content-between align-items-center">
								<h5 class="text-success mb-0">
									Rp. <?= number_format($hasilproduk['harga']) ?>
								</h5>
								<a href="produkdetail.php?id=<?= $hasilproduk['idproduk']; ?>" class="btn btn-success mb-2" style="font-size: 14px">
									Beli Sekarang
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>