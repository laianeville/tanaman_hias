<?php

session_start();
if (!isset($_SESSION['level'])) {
    if ($_SESSION["level"] != 'Admin') {
        echo "<script> alert('Anda belum login');</script>";
        echo "<script> location ='../login.php';</script>";
    }
}
include '../koneksi.php';

$title = 'Update Kategori';
$id_page = null;

$ambil = $koneksi->query("SELECT * FROM kategori WHERE idkategori='$_GET[id]'");
$datahasil = $ambil->fetch_assoc();

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

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-xl-12">
                            <a href="../admin/kategori.php">
                                <button class="btn btn-secondary">Kembali</button>
                            </a>
                            <div class="mt-4">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="judulkategori">Judul Kategori</label>
                                        <input type="text" class="form-control" value="<?= $datahasil['judulkategori']; ?>" required id="judulkategori" name="judulkategori" placeholder="Masukkan judul kategori">
                                    </div>
                                    <button class="btn btn-primary mb-5" name="ubah" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $id = $_GET['id'];
    $judulkategori = $_POST['judulkategori'];

    $sql = mysqli_query($koneksi, "UPDATE kategori SET judulkategori='$judulkategori' WHERE idkategori='$id'");

    if ($sql) {
        echo "<script>alert('Data Kategori Berhasil Di Update');</script>";
        echo "<script>location='../admin/kategori.php';</script>";
    }
}
?>

<?php include './layouts/footer.php'; ?>