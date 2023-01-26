<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["akun"])) {
    echo "<script> alert('Anda belum login');</script>";
    echo "<script> location ='login.php';</script>";
}
?>

<?php include 'header.php'; ?><br><br><br>
<section id="jarakbadan" class="hero">
    <div class="kontainer mt-4">
        <div class="row">
            <div class="kolom-md-12 animasikontainer">
                <div class="cart-list">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Ulasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM transaksidetail WHERE idtransaksi='$_GET[id]'"); ?>
                            <?php while ($datahasil = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $datahasil['nama']; ?></td>
                                    <td>Rp. <?php echo number_format($datahasil['harga']); ?></td>
                                    <td><?php echo $datahasil['jumlah']; ?></td>
                                    <td>Rp. <?php echo number_format($datahasil['subharga']); ?></td>
                                    <td>
                                        <?php if ($datahasil['statusulasan'] == "Sudah") { ?>
                                            <a data-toggle="modal" data-target="#editulasan<?= $nomor ?>" class="btn btn-hijau text-putih">Edit Ulasan</a>
                                        <?php } else { ?>
                                            <a data-toggle="modal" data-target="#exampleModal<?= $nomor ?>" class="btn btn-hijau text-putih">Berikan Ulasan Produk Ini</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $no = 1;
$id = $_SESSION["akun"]['id'];
$ambil = $koneksi->query("SELECT * FROM transaksidetail WHERE idtransaksi='$_GET[id]'");
while ($datahasil = $ambil->fetch_assoc()) { ?>
    <div class="modal fade" id="exampleModal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $no ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?= $no ?>">Berikan Ulasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-grup">
                            <input type="hidden" name="idproduk" value="<?= $datahasil['idproduk'] ?>">
                            <input type="hidden" name="idpelanggan" value="<?= $id ?>">
                            <input type="hidden" name="idtransaksi" value="<?= $datahasil['idtransaksi'] ?>">
                            <label for="kritik">Rating</label> <br>
                            <div class="bintang" id="bintang1<?= $no ?>">
                                <input type="radio" id="star5<?= $no ?>" name="bintang" value="5" required />
                                <label for="star5<?= $no ?>" title="text">5 Bintang</label>
                                <input type="radio" id="star4<?= $no ?>" name="bintang" value="4" required />
                                <label for="star4<?= $no ?>" title="text">4 Bintang</label>
                                <input type="radio" id="star3<?= $no ?>" name="bintang" value="3" required />
                                <label for="star3<?= $no ?>" title="text">3 Bintang</label>
                                <input type="radio" id="star2<?= $no ?>" name="bintang" value="2" required />
                                <label for="star2<?= $no ?>" title="text">2 Bintang</label>
                                <input type="radio" id="star1<?= $no ?>" name="bintang" value="1" required />
                                <label for="star1<?= $no ?>" title="text">1 Bintang</label>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-grup">
                            <label for="ulasan">Ulasan</label>
                            <textarea class="form-gaya" name="ulasan" rows="3" required></textarea>
                        </div>
                        <div class="form-grup">
                            <label>Tampilkan Nama Ulasan</label>
                            <select name="tampilannama" class="form-gaya" required>
                                <option value="Tampilkan Nama">Tampilkan Nama</option>
                                <option value="Anonim">Anonim</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" value="simpan" class="btn btn-biru">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($datahasil['statusulasan'] == "Sudah") { ?>
        <div class="modal fade" id="editulasan<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="editulasanLabel<?= $no ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editulasanLabel<?= $no ?>">Edit Ulasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $ambilulasan = $koneksi->query("SELECT * FROM ulasan WHERE idtransaksi='$datahasil[idtransaksi]'");
                    $ulasan = $ambilulasan->fetch_assoc();
                    ?>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-grup">
                                <input type="hidden" name="idulasan" value="<?= $ulasan['idulasan'] ?>">
                                <input type="hidden" name="idproduk" value="<?= $datahasil['idproduk'] ?>">
                                <input type="hidden" name="idpelanggan" value="<?= $id ?>">
                                <input type="hidden" name="idtransaksi" value="<?= $datahasil['idtransaksi'] ?>">
                                <label for="kritik">Rating</label><br>
                                <div class="rate" id="bintang2<?= $no ?>">
                                    <input <?php if ($ulasan['bintang'] == '5') echo 'checked'; ?> type="radio" id="stara<?= $no ?>" name="rate" value="5" required />
                                    <label for="stara<?= $no ?>" title="text">5 Bintang</label>
                                    <input <?php if ($ulasan['bintang'] == '4') echo 'checked'; ?> type="radio" id="starb<?= $no ?>" name="rate" value="4" required />
                                    <label for="starb<?= $no ?>" title="text">4 Bintang</label>
                                    <input <?php if ($ulasan['bintang'] == '3') echo 'checked'; ?> type="radio" id="starc<?= $no ?>" name="rate" value="3" required />
                                    <label for="starc<?= $no ?>" title="text">3 Bintang</label>
                                    <input <?php if ($ulasan['bintang'] == '2') echo 'checked'; ?> type="radio" id="stard<?= $no ?>" name="rate" value="2" required />
                                    <label for="stard<?= $no ?>" title="text">2 Bintang</label>
                                    <input <?php if ($ulasan['bintang'] == '1') echo 'checked'; ?>type="radio" id="stare<?= $no ?>" name="rate" value="1" required />
                                    <label for="stare<?= $no ?>" title="text">1 Bintang</label>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-grup">
                                <label for="ulasan">Ulasan</label>
                                <textarea class="form-gaya" name="ulasan" rows="3" required value="<?= $ulasan['ulasan'] ?>"><?= $ulasan['ulasan'] ?></textarea>
                            </div>
                            <div class="form-grup">
                                <label>Tampilkan Nama Ulasan</label>
                                <select name="tampilannama" class="form-gaya" required>
                                    <option <?php if ($ulasan['tampilannama'] == 'Tampilkan Nama') echo 'selected'; ?>value="Tampilkan Nama">Tampilkan Nama</option>
                                    <option <?php if ($ulasan['tampilannama'] == 'Anonim') echo 'selected'; ?> value="Anonim">Anonim</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="ubah" value="ubah" class="btn btn-biru">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $no++; ?>
<?php  } ?>
<?php
if (isset($_POST["simpan"])) {
    $idproduk = $_POST['idproduk'];
    $idpelanggan = $_POST['idpelanggan'];
    $bintang = $_POST['bintang'];
    $ulasan = $_POST['ulasan'];
    $tampilannama = $_POST['tampilannama'];
    $idtransaksi = $_POST['idtransaksi'];
    $koneksi->query("INSERT INTO ulasan	(idproduk, idtransaksi, idpelanggan,  bintang, ulasan, tampilannama)
								VALUES('$idproduk','$idtransaksi','$idpelanggan','$bintang','$ulasan', '$tampilannama')") or die(mysqli_error($koneksi));
    $koneksi->query("UPDATE transaksidetail SET statusulasan='Sudah' WHERE idtransaksi='$idtransaksi'") or die(mysqli_error($koneksi));
    echo "<script>alert('Ulasan Berhasil Di Kirim')</script>";
    echo "<script>location='ulasan.php?id=$_GET[id]';</script>";
}
if (isset($_POST["ubah"])) {
    $idulasan = $_POST['idulasan'];
    $idproduk = $_POST['idproduk'];
    $idpelanggan = $_POST['idpelanggan'];
    $rate = $_POST['rate'];
    $ulasan = $_POST['ulasan'];
    $tampilannama = $_POST['tampilannama'];
    $idtransaksi = $_POST['idtransaksi'];
    $koneksi->query("UPDATE ulasan SET bintang='$rate', ulasan='$ulasan', tampilannama='$tampilannama' WHERE idulasan='$idulasan'") or die(mysqli_error($koneksi));
    echo "<script>alert('Ulasan Berhasil Di Diubah')</script>";
    echo "<script>location='ulasan.php?id=$_GET[id]';</script>";
}
?>
<?php
include 'footer.php';
?>