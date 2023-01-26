<?php
include 'koneksi.php';
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
  $datakategori[] = $tiap;
}
function tanggal($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?> | Toko Tanaman Hias</title>
  <link rel="stylesheet" href="./css/font.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/public.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-xl position-fixed" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px; width: 100%; background: #fff; z-index: 10; border-top: 4px solid #008000;">
    <div class="container-fluid">
      <a href="./index.php" class="navbar-brand my-0">
        <img src="./foto/logo.png" height="45" alt="Tanaman Hias" class="me-1 ms-3 my-0 logo">
        <strong class="mb-0" style="color: #008000;">Tanaman Hias</strong>
      </a>

      <button type="button" class="navbar-toggler" style="border: 0;" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
          <a href="./index.php" class="nav-item nav-link text-center mx-4" <?php if ($id_page == 1) : ?> style="color: #008000; border-bottom: 2px solid #008000;" <?php endif; ?>>Home</a>
          <a href="./produk.php" class="nav-item nav-link text-center mx-4" <?php if ($id_page == 2) : ?> style="color: #008000; border-bottom: 2px solid #008000;" <?php endif; ?>>Produk</a>
          <li class="nav-item mx-4 dropdown">
            <a class="nav-link text-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kategori
            </a>
            <ul class="dropdown-menu w-10">
              <?php foreach ($datakategori as $key => $value) : ?>
                <li><a class="dropdown-item" href="list_kategori.php?id=<?= $value['idkategori']; ?>"><?= $value['judulkategori']; ?></a></li>
              <?php endforeach ?>
            </ul>
          </li>
        </div>

        <div class="navbar-nav ms-auto text-center">
          <?php if (isset($_SESSION['email'])) : ?>
            <?php if ($_SESSION['level'] != 'Admin') : ?>
              <a href="./keranjang.php" class="nav-item nav-link btn <?php if (isset($_SESSION['email'])) : ?> me-1 <?php else : ?> me-3 <?php endif; ?>" style="color: #008000;">
                <i class="fa fa-cart-plus text-center" aria-hidden="true" style="font-size: 18px; <?php if ($id_page == 4) : ?> border-bottom: 2px solid #008000; <?php endif; ?>"></i>
              </a>
            <?php endif; ?>
            <li class="nav-item mx-4 dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['email']; ?>
              </a>
              <ul class="dropdown-menu w-10">
                <li>
                  <a class="dropdown-item" href="./profil.php">
                    Profil
                  </a>
                </li>
                <?php if (isset($_SESSION['level'])) : ?>
                  <?php if ($_SESSION['level'] != 'Admin') : ?>
                    <li>
                      <a class="dropdown-item" href="./riwayat.php">
                        Riwayat Transaksi
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>
              </ul>
            </li>

            <form action="./logout.php" method="post">
              <button class="btn btn-danger" type="submit">Logout</button>
            </form>

          <?php else : ?>
            <?php if ($id_page != 'auth1') : ?>
              <a href="./login.php" class="nav-item nav-link btn text-light px-3 me-2 mb-3 mb-xl-0" style="background: #008000;">
                Login
              </a>
            <?php endif; ?>

            <?php if ($id_page != 'auth2') : ?>
              <a href="./register.php" class="nav-item nav-link btn px-3" style="background: transparent; border: 1px solid #008000; color: #008000;">
                Register
              </a>
            <?php endif; ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>