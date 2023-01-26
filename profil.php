<?php

ob_start();
session_start();

if (!isset($_SESSION["level"])) {
    echo "<script> alert('Anda belum login');</script>";
    echo "<script> location ='login.php';</script>";
}

include 'koneksi.php';

$id_page = null;
$title = $_SESSION['nama'];

include 'header.php';

?>

<section class="container-fluid" style="position: relative; top: 7em;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <h4 style="font-weight: bold;">Update Profil</h4>

                        <form action="" method="POST">
                            <div class="mt-3">
                                <label for="nama">Nama</label>
                                <input type="text" value="<?= $_SESSION['nama']; ?>" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required style="height: 50px;">
                            </div>

                            <div class="mt-3">
                                <label for="jeniskelamin">Jenis Kelamin</label>
                                <select name="jeniskelamin" id="jeniskelamin" class="form-control" style="height: 50px;">
                                    <option value="<?= $_SESSION['jeniskelamin']; ?>"><?= $_SESSION['jeniskelamin']; ?></option>
                                    <option value="Laki - laki">Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="mt-3">
                                <label for="nohp">Telepon</label>
                                <input type="text" name="nohp" class="form-control" placeholder="Masukkan No HP" required id="nohp" value="<?= $_SESSION['nohp']; ?>" style="height: 50px;">
                            </div>

                            <div class="mt-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat" required id="alamat"><?= $_SESSION['alamat']; ?></textarea>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit" name="update">Update Profil</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php

if (isset($_POST['update'])) {
    $id = $_SESSION['id'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    $sql = mysqli_query($koneksi, "UPDATE akun SET nama='$nama', jeniskelamin='$jeniskelamin', nohp='$nohp', alamat='$alamat' WHERE id='$id'");

    if ($sql) {
        header('location: ./logout.php');
    }
}
?>

<?php

include 'footer.php';

?>