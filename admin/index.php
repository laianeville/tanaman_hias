<?php

session_start();
include '../koneksi.php';

$title = 'Dashboard';
$id_page = 'admin1';

include './layouts/header.php';

// jumlah produk
$jumlah_produk = mysqli_query($koneksi, "SELECT COUNT(*) AS `count_produk` FROM `produk`");
$res_cproduk = mysqli_fetch_assoc($jumlah_produk);

// jumlah transaksi
$jumlah_transaksi = mysqli_query($koneksi, "SELECT COUNT(*) AS `count_transaksi` FROM `transaksi`");
$res_ctransaksi = mysqli_fetch_assoc($jumlah_transaksi);

// jumlah users
$jumlah_users = mysqli_query($koneksi, "SELECT COUNT(*) AS `count_users` FROM `akun`");
$res_cusers = mysqli_fetch_assoc($jumlah_users);

// jumlah laporan
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
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $res_cproduk['count_produk']; ?></h3>
                                <p>Jumlah Produk</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $res_ctransaksi['count_transaksi']; ?></h3>
                                <p>Jumlah Transaksi</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $res_cusers['count_users']; ?></h3>
                                <p>Jumlah Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Laporan Penjualan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">List Produk</p>
                                    <a href="../admin/produk.php">
                                        <button class="btn btn btn-info">Manage Produk</button>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="dataTable">
                                        <thead class="table-success">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Keyword</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Foto</th>
                                                <th>Video</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $nomor = 1; ?>
                                            <?php $ambil = $koneksi->query("SELECT*FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori"); ?>
                                            <?php while ($datahasil = $ambil->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo $nomor; ?></td>
                                                    <td><?php echo $datahasil['namaproduk'] ?></td>
                                                    <td><?php echo $datahasil['keywordpencarian'] ?></td>
                                                    <td><?php echo $datahasil['judulkategori'] ?></td>
                                                    <td>Rp. <?php echo number_format($datahasil['harga']) ?></td>
                                                    <td>
                                                        <img src="../foto/<?php echo $datahasil['gambar'] ?>" width="100px" style="border-radius:10px">
                                                    </td>
                                                    <td style="white-space: nowrap;">
                                                        <a href="<?= $datahasil['video']; ?>" target="_blank">Lihat Video</a>
                                                    </td>
                                                    <td><?php echo $datahasil['stok'] ?></td>
                                                </tr>
                                                <?php $nomor++; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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