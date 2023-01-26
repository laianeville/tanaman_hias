<?php

session_start();
if (!isset($_SESSION['level'])) {
    if ($_SESSION["level"] != 'Admin') {
        echo "<script> alert('Anda belum login');</script>";
        echo "<script> location ='../login.php';</script>";
    }
}
include '../koneksi.php';

$title = 'Laporan';
$id_page = 'admin6';

if (isset($_POST['tambah'])) {
    $keterangan = $_POST['keterangan'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    $sql = mysqli_query($koneksi, "INSERT INTO laporan(keterangan, amount, status) VALUES('$keterangan', '$amount', '$status')");
    if ($sql) {
        echo "<script>alert('Satu data laporan berhasil ditambahkan');</script>";
        echo "<script> location ='../admin/laporan.php';</script>";
    }
}

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
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Large modal -->
                        <button type="button" class="btn btn-success create" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Kategori</button>

                        <!-- modal tambah -->
                        <div class="modal fade bd-example-modal-lg create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Tambah Laporan</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" required class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan keterangan laporan" style="height: 50px;">
                                        </div>
                                        <div class="modal-body">
                                            <label for="amount">Biaya</label>
                                            <input type="number" required min="0" class="form-control" name="amount" id="amount" placeholder="Masukkan keterangan laporan" style="height: 50px;">
                                        </div>
                                        <div class="modal-body">
                                            <label for="status">Status</label>
                                            <select name="status" required id="status" class="form-control" style="height: 50px;">
                                                <option value="">-Pilih Status-</option>
                                                <option class="text-success" value="Pemasukan">Pemasukan</option>
                                                <option class="text-danger" value="Pengeluaran">Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link text-success active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pemasukan</a>
                                            <a class="nav-item nav-link text-danger" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pengeluaran</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <table class="table table-striped table-bordered" id="dataTable2">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Keterangan</th>
                                                        <th>Status</th>
                                                        <th>Amount</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php $laporan = mysqli_query($koneksi, "SELECT * FROM laporan WHERE status='Pemasukan'"); ?>
                                                    <?php while ($data = mysqli_fetch_assoc($laporan)) : ?>
                                                        <tr style="white-space: nowrap;">
                                                            <td><?= $no++ . '.'; ?></td>
                                                            <td><?= $data['keterangan']; ?></td>
                                                            <td><?= $data['status']; ?></td>
                                                            <td>Rp. <?= number_format($data['amount']); ?></td>
                                                            <td>
                                                                <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" href="delete_laporan.php?id=<?= $data['id']; ?>" class="btn btn-danger">
                                                                    <i class="fa fa-ban"></i>
                                                                </a>

                                                                <a href="edit_laporan.php?id=<?= $data['id']; ?>" class="btn btn-info">
                                                                    <i class="fa fa-cog"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <table class="table table-striped table-bordered" id="dataTable">
                                                <thead class="table-danger">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Keterangan</th>
                                                        <th>Status</th>
                                                        <th>Amount</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php $laporan = mysqli_query($koneksi, "SELECT * FROM laporan WHERE status='Pengeluaran'"); ?>
                                                    <?php while ($data = mysqli_fetch_assoc($laporan)) : ?>
                                                        <tr style="white-space: nowrap;">
                                                            <td><?= $no++ . '.'; ?></td>
                                                            <td><?= $data['keterangan']; ?></td>
                                                            <td><?= $data['status']; ?></td>
                                                            <td>Rp. <?= number_format($data['amount']); ?></td>
                                                            <td>
                                                                <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" href="delete_laporan.php?id=<?= $data['id']; ?>" class="btn btn-danger">
                                                                    <i class="fa fa-ban"></i>
                                                                </a>

                                                                <a href="edit_laporan.php?id=<?= $data['id']; ?>" class="btn btn-info">
                                                                    <i class="fa fa-cog"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<?php include './layouts/footer.php'; ?>