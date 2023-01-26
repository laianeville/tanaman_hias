<section id="kategori">
    <div class="kontainer">
        <div class="row mb-3 pb-3">
            <div class="kolom-md-12 judulsection animasikontainer">
                <h3 class="mb-4">Tentang Kami</h3>
                <p class="text-justify">Toko Tanaman Hias merupakan toko yang berjual berbagai tanaman hias baik bunga dan tumbuhan lainnya dengan harga termurah.</p>
                <p> <img src="foto/depan.jpg" width="100%" height="70%" style="border-radius: 30px"></p>
                <p><img src="foto/bralink.jpeg" width="100%" height="10%" style="border-radius: 30px"></p>
            </div>
        </div>
        <div class="row mb-3 pb-3">
            <div class="kolom-md-12 judulsection animasikontainer">
                <h3 class="text-tengah">Produk Terbaru</h3>
            </div>
        </div>
        <div class="row">
            <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc limit 3"); ?>
            <?php while ($hasilproduk = $ambil->fetch_assoc()) { ?>
                <div class="kolom-md-6 kolom-lg-4 animasikontainer">
                    <div class="produk">
                        <a href="produkdetail.php?id=<?php echo $hasilproduk['idproduk']; ?>"><img src="foto/<?php echo $hasilproduk['gambar'] ?>" style="height:300px;width:100%" alt="">
                        </a>
                        <div class="text py-3 pb-4 px-3 text-tengah">
                            <h3><a href="produkdetail.php?id=<?php echo $hasilproduk['idproduk']; ?>"><?php echo $hasilproduk['namaproduk'] ?></a></h3>
                            <p class="text-merah text-tengah"><span>Rp <?php echo number_format($hasilproduk['harga']) ?></span></p>
                            <a class="btn btn-hijau" href="produkdetail.php?id=<?php echo $hasilproduk['idproduk']; ?>">Beli</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>