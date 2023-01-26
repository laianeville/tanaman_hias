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

$ambil = $koneksi->query("SELECT * FROM laporan WHERE id='$_GET[id]'");
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
                            <a href="../admin/laporan.php">
                                <button class="btn btn-secondary">Kembali</button>
                            </a>
                            <div class="mt-4">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" required class="form-control" name="keterangan" id="keterangan" value="<?= $datahasil['keterangan']; ?>" placeholder="Masukkan keterangan laporan" style="height: 50px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Biaya</label>
                                        <input type="number" required min="0" va class="form-control" name="amount" value="<?= $datahasil['amount']; ?>" id="amount" placeholder="Masukkan keterangan laporan" style="height: 50px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" required id="status" class="form-control" style="height: 50px;">
                                            <option value="<?= $datahasil['status']; ?>"><?= $datahasil['status']; ?></option>
                                            <option class="text-success" value="Pemasukan">Pemasukan</option>
                                            <option class="text-danger" value="Pengeluaran">Pengeluaran</option>
                                        </select>
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
    $keterangan = $_POST['keterangan'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    $sql = mysqli_query($koneksi, "UPDATE laporan SET keterangan='$keterangan', amount='$amount', status='$status' WHERE id='$id'");

    if ($sql) {
        echo "<script>alert('Data Laporan Berhasil Di Update');</script>";
        echo "<script>location='../admin/laporan.php';</script>";
    }
}
?>

<?php include './layouts/footer.php'; ?>