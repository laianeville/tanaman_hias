<nav class="navbar navbar-expand-lg" id="ftco-navbar" style="background-color: green;color:white">
    <div class="kontainer">
        <a class="navbar-brand" href="index.php"><img width="75px" src="foto/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="turunbawah" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="turunbawah navbar-turunbawah" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="menuatas-item active"><a href="index.php" class="menuatas-link">Home</a></li>
                <li class="menuatas-item active"><a href="produk.php" class="menuatas-link">Produk</a></li>
                <li class="menuatas-item active dropdown">
                    <a class="menuatas-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <?php foreach ($datakategori as $key => $value) : ?>
                            <a href="kategori.php?id=<?php echo $value["idkategori"] ?>" class="dropdown-item"><?php echo $value["judulkategori"] ?></a>
                        <?php endforeach ?>
                    </div>
                </li>
                <?php
                include 'koneksi.php';
                if (isset($_SESSION["akun"])) : ?>
                    <?php
                    $id = $_SESSION["akun"]['id'];
                    $ambil = $koneksi->query("SELECT *FROM akun WHERE id='$id'");
                    $datahasil = $ambil->fetch_assoc(); ?>
                    <li class="menuatas-item active dropdown">
                        <a class="menuatas-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Akun </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="akun.php">Akun Profil</a>
                            <a class="dropdown-item" href="riwayat.php">Riwayat Transaksi</a>
                            <a class="dropdown-item" href="keranjang.php">Keranjang</a>
                            <a class="dropdown-item" href="keluar.php">Logout</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="menuatas-item active"><a href="keranjang.php" class="menuatas-link">Keranjang</a></li>
                    <li class="menuatas-item active"><a href="login.php" class="menuatas-link">Login</a></li>
                    <li class="menuatas-item active"><a href="register.php" class="menuatas-link">Register</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>