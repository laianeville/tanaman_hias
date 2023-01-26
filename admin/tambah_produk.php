<?php

session_start();
include '../koneksi.php';

$title = 'Tambah Produk';
$id_page = null;

$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
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

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-xl-12">
                            <a href="../admin/produk.php">
                                <button class="btn btn-secondary">Kembali</button>
                            </a>
                            <div class="mt-4">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nama">Nama Produk</label>
                                        <input type="text" class="form-control" required id="nama" name="nama" placeholder="Masukkan nama produk" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="keywordpencarian">Keyword Produk</label>
                                        <input type="text" class="form-control" required id="keywordpencarian" placeholder="Masukkan keyword" name="keywordpencarian">
                                    </div>

                                    <div class="form-group">
                                        <label for="idkategori">Kategori</label>
                                        <select class="form-control" required id="idkategori" name="idkategori">
                                            <option value="">Pilih kategori</option>
                                            <?php foreach ($datakategori as $key => $value) : ?>

                                                <option value="<?php echo $value["idkategori"] ?>"><?php echo $value["judulkategori"] ?></option>

                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Produk (RP)</label>
                                        <input type="number" name="harga" class="form-control" required id="harga" placeholder="Masukkan harga produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="berat">Berat Produk (KG)</label>
                                        <input type="number" name="berat" class="form-control" required id="berat" placeholder="Berat bersih produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" required id="deskripsi" name="deskripsi" placeholder="Deskripsi" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Upload Foto Produk</label>
                                        <input class="form-control" required name="foto" type="file" id="formFile">
                                    </div>
                                    <div class="form-group">
                                        <label for="video">Link Video</label>
                                        <input type="text" name="video" class="form-control" required id="video" placeholder="Masukkan link video produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Jumlah Stok Tersedia</label>
                                        <input type="number" name="stok" class="form-control" required id="stok" placeholder="Masukkan jumlah stok">
                                    </div>
                                    <button class="btn btn-info mb-5" name="save" type="submit">Simpan</button>
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
if (isset($_POST['save'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasifoto, "../foto/" . $namafoto);
    $keywordpencarian = strtolower($_POST['keywordpencarian']);
    $koneksi->query("INSERT INTO produk
		(namaproduk,keywordpencarian,idkategori,harga,berat,gambar,video,deskripsi,stok)
		VALUES('$_POST[nama]','$keywordpencarian','$_POST[idkategori]','$_POST[harga]','$_POST[berat]','$namafoto', '$_POST[video]', '$_POST[deskripsi]','$_POST[stok]')");
    $idproduk_barusan = $koneksi->insert_id;
    echo "<script>alert('Data Berhasil Di Simpan');</script>";
    echo "<script> location ='../admin/produk.php';</script>";
}
?>

<?php include './layouts/footer.php'; ?>