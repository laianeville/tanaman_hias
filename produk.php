<?php
session_start();
$id_page = 2;
$title = 'Semua Produk';
include 'koneksi.php';
include 'header.php';
if (!empty($_POST['keywordpencarian'])) {
    $keywordpencarian = $_POST['keywordpencarian'];
} else {
    $keywordpencarian = "";
}
error_reporting(0);
ini_set('display_errors', 0);
?>

<section class="container-fluid" style="position: relative; top: 7em;">
    <div class="row">
        <div class="col-xl-4">
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" name="search" id="search" placeholder="Cari produk..">
                <button class="ms-2 btn btn-success">Cari</button>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc"); ?>
        <?php while ($hasilproduk = $ambil->fetch_assoc()) { ?>
            <div class="col-xl-3 my-4 mt-xl-0">
                <div class="card" style="border-radius: 0;">
                    <div class="card-body p-0">
                        <a href="produkdetail.php?id=<?= $hasilproduk['idproduk']; ?>">
                            <div class="col-xl-12" style="height: 40vh">
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
</section>

<?php
include 'footer.php';
?>