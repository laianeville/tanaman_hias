<?php
session_start();
include 'koneksi.php';
$id_page = 'auth1';
$title = 'Login';
?>
<?php include 'header.php'; ?>

<section class="container-fluid" style="height: 110vh;">
	<div class="container">
		<div class="row justify-content-center align-items-center" style="position: relative; top: 8em;">
			<div class="col-xl-5">
				<img src="./foto/ils2.svg" alt="">
			</div>
			<div class="col-xl-5 p-0">
				<form action="" method="POST">
					<div class="card" style="border-top: 4px solid #008000;">
						<div class="card-body">
							<h5>Silakan <span class="text-success" style="font-weight: bold;">Login</span></h5>
							<div class="mt-3">
								<label for="email">Email</label>
								<input type="email" required class="form-control" name="email" id="email" placeholder="example@gmail.com" style="height: 50px;">
							</div>

							<div class="mt-3">
								<label for="password">Password</label>
								<input type="password" required class="form-control" name="password" id="password" placeholder="Masukkan Password" style="height: 50px;">
							</div>

							<button class="btn btn-success mt-4 px-5" name="login" style="height: 50px;">Masuk</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<?php
if (isset($_POST["login"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM akun
		WHERE email='$email' AND password='$password' limit 1");
	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok == 1) {
		$akun = $ambil->fetch_assoc();
		if ($akun['level'] == "Pelanggan") {
			$_SESSION["level"] = "Pelanggan";
			echo "<script> location ='index.php';</script>";
		} elseif ($akun['level'] == "Admin") {
			$_SESSION["level"] = "Admin";
			echo "<script> location ='admin/index.php';</script>";
		}
	} else {
		echo "<script> alert('Email atau password anda salah');</script>";
		echo "<script> location ='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>