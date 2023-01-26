<?php
session_start();
include 'koneksi.php';
$id_page = 'auth2';
$title = 'Register';
?>
<?php include 'header.php'; ?>

<section class="container-fluid" style="height: 140vh;">
	<div class="container">
		<div class="row justify-content-center align-items-center" style="position: relative; top: 8em;">
			<div class="col-xl-5">
				<img src="./foto/ils3.svg" alt="">
			</div>
			<div class="col-xl-5 p-0">
				<form action="" method="POST">
					<div class="card" style="border-top: 4px solid #008000;">
						<div class="card-body">
							<h5><span class="text-success" style="font-weight: bold;">Register</span></h5>
							<div class="mt-3">
								<label id="nama">Nama</label>
								<input type="text" name="nama" class="form-control" id="nama" required style="height: 50px;" placeholder="Masukkan Nama">
							</div>

							<div class="mt-3">
								<label class="jeniskelamin">Jenis Kelamin</label>
								<select name="jeniskelamin" id="jeniskelamin" class="form-control" required style="height: 50px;">
									<option value="">-Pilih Jenis Kelamin-</option>
									<option value="Laki - Laki">Laki - Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>

							<div class="mt-3">
								<label for="nohp">Telepon</label>
								<input type="number" required class="form-control" name="nohp" id="nohp" placeholder="example@gmail.com" style="height: 50px;">
							</div>

							<div class="mt-3">
								<label for="email">Email</label>
								<input type="email" required class="form-control" name="email" id="email" placeholder="example@gmail.com" style="height: 50px;">
							</div>

							<div class="mt-3">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" style="height: 50px;">
							</div>

							<button class="btn btn-success mt-4 px-5" name="register" style="height: 50px;">Daftar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
if (isset($_POST["register"])) {
	$nama = $_POST['nama'];
	$jeniskelamin = $_POST['jeniskelamin'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$nohp = $_POST['nohp'];
	$ambil = $koneksi->query("SELECT*FROM akun 
							WHERE email='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Penregisteran Gagal, email sudah ada')</script>";
		echo "<script>location='register.php';</script>";
	} else {
		$koneksi->query("INSERT INTO akun(nama,jeniskelamin,email,password,alamat,nohp,level)
								VALUES('$nama','$jeniskelamin','$email','$password','$alamat','$nohp','Pelanggan')");
		echo "<script>alert('Penregisteran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>