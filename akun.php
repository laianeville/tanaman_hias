<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["akun"])) {
    echo "<script> alert('Harap login terlebih dahulu');</script>";
    echo "<script> location ='login.php';</script>";
}
$id = $_SESSION["akun"]["id"];
?>
<?php
$id = $_SESSION["akun"]['id'];
$ambil = $koneksi->query("SELECT *FROM akun WHERE id='$id'");
$datahasil = $ambil->fetch_assoc(); ?>
<?php include 'header.php'; ?><br><br><br>
<section id="jarakbadan" class="hero">
    <div class="kontainer mt-4">
        <div class="row">
            <div class="kolom-md-12 animasikontainer">
                <form method="post">
                    <div class="form-grup">
                        <label>Nama</label>
                        <input value="<?php echo $datahasil['nama']; ?>" type="text" value="" class="form-gaya" name="nama">
                    </div>
                    <div class="form-grup">
                        <label class="control-label">Jenis Kelamin</label>
                        <select name="jeniskelamin" class="form-gaya" required>
                            <option <?php if ($datahasil['jeniskelamin'] == 'Laki - Laki') echo 'selected'; ?> value="Laki - Laki">Laki - Laki</option>
                            <option <?php if ($datahasil['jeniskelamin'] == 'Perempuan') echo 'selected'; ?> value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-grup">
                        <label>No. HP</label>
                        <input value="<?php echo $datahasil['nohp']; ?>" type="number" class="form-gaya" name="nohp">
                    </div>
                    <div class="form-grup">
                        <label>Alamat</label>
                        <textarea value="<?php echo $datahasil['alamat']; ?>" class="form-gaya" name="alamat" id="alamat" rows="10">
        <?php echo $datahasil['alamat']; ?>
        </textarea>
                        <script>
                            CKEDITOR.replace('alamat');
                        </script>
                    </div>
                    <div class="form-grup">
                        <label>Email</label>
                        <input value="<?php echo $datahasil['email']; ?>" type="email" class="form-gaya" name="email">
                    </div>
                    <div class="form-grup">
                        <label>Password</label>
                        <input type="text" class="form-gaya" name="password">
                        <input type="hidden" class="form-gaya" name="passwordlama" value="<?php echo $datahasil['password']; ?>">
                        <span class="text-danger">Kosongkan Password jika tidak ingin mengganti</span>
                    </div>
                    <button class="btn btn-biru btn-block" name="ubah">Simpan</a></button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_POST['ubah'])) {
    if ($_POST['password'] == "") {
        $password = $_POST['passwordlama'];
    } else {
        $password = $_POST['password'];
    }

    $koneksi->query("UPDATE akun SET password='$password',nama='$_POST[nama]', email='$_POST[email]',jeniskelamin='$_POST[jeniskelamin]',nohp='$_POST[nohp]', alamat='$_POST[alamat]' WHERE id='$id'") or die(mysqli_error($koneksi));
    echo "<script>alert('Profil Berhasil Di Ubah');</script>";
    echo "<script>location='akun.php';</script>";
}
include 'footer.php';
?>