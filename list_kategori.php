<?php
session_start();
include 'koneksi.php';

$id_page = null;
$title = 'Kategori';

?>

<?php include 'header.php';
$kategori = $_GET["id"];

$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM produk WHERE idkategori = '$kategori'");
while ($datahasil = $ambil->fetch_assoc()) {
    $semuadata[] = $datahasil;
}
?>

<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}
?>
<?php $am = $koneksi->query("SELECT * FROM kategori where idkategori='$kategori'");
$pe = $am->fetch_assoc()
?>

<section class="container-fluid" style="position: relative; top: 7em;">
    <div class="row">
        <div class="col-xl-12">
            <h4 class="mb-4" style="font-weight: bold;">Kategori: <?php echo $pe["judulkategori"] ?></h4>
            <?php if (empty($semuadata)) : ?>
                <div class="alert alert-danger">Produk <strong><?php echo  $pe["judulkategori"] ?></strong> Kosong</div>
            <?php endif ?>
        </div>
    </div>

    <div class="row mt-4">
        <?php foreach ($semuadata as $key => $hasilproduk) : ?>
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
        <?php endforeach; ?>
    </div>
</section>

<?php
include 'footer.php';
?>