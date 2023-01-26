-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tanamanhias
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jeniskelamin` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nohp` text NOT NULL,
  `alamat` text NOT NULL,
  `level` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun`
--

LOCK TABLES `akun` WRITE;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` VALUES (1,'Administrator','','admin@gmail.com','admin123','081234','Jakarta','Admin'),(9,'Vony Oktavia','Perempuan','vonyokta@gmail.com','vony123','087786','Jl H.abu','Pelanggan');
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL AUTO_INCREMENT,
  `judulkategori` varchar(255) NOT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (10,'Tanaman'),(11,' Pupuk'),(12,'Peralatan');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laporan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(225) NOT NULL,
  `status` varchar(70) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan`
--

LOCK TABLES `laporan` WRITE;
/*!40000 ALTER TABLE `laporan` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL AUTO_INCREMENT,
  `idkategori` int(11) NOT NULL,
  `namaproduk` text NOT NULL,
  `keywordpencarian` text NOT NULL,
  `harga` varchar(255) NOT NULL,
  `berat` varchar(15) NOT NULL,
  `stok` varchar(15) NOT NULL,
  `gambar` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  PRIMARY KEY (`idproduk`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES (3,10,'Chalathea','cala, merah, calathea, romantis, duri','15000','1','10','Calathea_1.jpg','https://youtu.be/AKbelTywKhs','Calathea ornata (Pinstripe Calathea) adalah tanaman tahunan yang berasal dari Amerika Selatan (terutama Kolombia dan Venezuela). Tanaman asal daerah tropis Amerika ini digunakan di banyak negara sebagai tanaman hias. Tanaman ini memiliki rimpang pada bawah tanah. \r\n'),(4,10,'Ceriman','ceri, ceriman, wangi','150000','1','14','Ceriman_2.jpg','-','<p>Ceriman atau Philodendron monstera (Monstera deliciosa), merupakan <strong>philodendron dengan daun khas terbelah ketika sudah besar</strong>. Tanaman hias philodendron juga punya buah yang rasanya enak dimakan, sering dijadikan salad sehingga tanaman ini juga dikenal dengan nama fruid salad atau tanaman ceriman di indonesia.</p>\r\n'),(5,10,'Daun Bahagia','daun, bahagia, daun bahagia','15000','1','20','Daun_Bahagia_3.jpg','-','<p><strong>Dieffenbachia</strong>&nbsp;merupakan tanaman hias populer yang biasa ditanam di pekarangan. Keindahannya berasal dari bentuk tajuk dan juga warna daunnya yang bervariasi: hijau dengan bercak-bercak hijau muda atau kuning. Di kalangan penjual tanaman hias, Dieffenbachia dikenal pula sebagai daun bahagia atau bunga bahagia.</p>\r\n'),(8,10,'Dolar','dol, dolar, kuning, lebah, tanaman hias','15000','1','23','Dolar_4.jpg','-','<p>Tanaman dolar adalah salah satu&nbsp;jenis tanaman hias merambat yang berasal dari Afrika. Tanaman yang terdiri atas daun hijau ini memiliki permukaan yang mengkilap dan mampu menciptakan suasana asri. Habitat aslinya merupakan tempat beriklim tropis yang sama seperti Indonesia sehingga tidak heran kalau tanaman dolar juga populer dan mudah ditemukan di sejumlah hunian di tanah air.</p>\r\n'),(9,10,'Glombang Cinta','glombang, cinta, gelombang cinta','80000','1','20','Glombang_Cinta_5.jpg','-','<p>Anthurium, salah satunya adalah gelombang cinta, jenis yang cukup terkenal. Bentuk daunnya besar, bergelombang, sehingga akhirnya tanaman ini dinamakan gelombang cinta. Sebenarnya, bentuk tanaman ini tidak terlalu istimewa karena memang tidak berbunga.</p>\r\n'),(13,10,'Janda Bolong','janda, bolong, janda bolong','35000','1','13','Janda_Bolong_6.jpg','-','<p>Monstera&nbsp;alias janda bolong merupakan jenis tanaman hias tropis yang sering digunakan sebagai hiasan interior rumah bergaya Skandinavia atau minimalis. Keunikan tanaman ini adalah memiliki daun mengilap lebar berwarna hijau pekat berpola seperti bentuk hati.</p>\r\n'),(16,10,'Keladi Merah','keladi, merah, keladi merah','30000','1','5','Keladi_Merah_7.jpg','-','<p>Keladi adalah salah satu jenis tanaman yang memiliki banyak peminat. Setelah aglonema dan monstera (janda bolong), kini pesona tanaman hias yang diprediksi akan populer adalah tanaman keladi. Coraknya yang cantik dan beragam membuat tanaman ini cocok untuk menjadi penghias rumah Anda.</p>\r\n'),(17,10,'Keladi Tengkorak','keladi, tengkorak, keladi tengkorak','45000','1','8','Keladi_Tengkorak_8.jpg','-','<p>Tanaman Keladi Tengkorak (Alocasia cuprea) adalah&nbsp;tanaman hias keladi yang memiliki bentuk daun yang menarik.</p>\r\n'),(18,10,'Keladi Hitam','keladi, hitam, keladi hitam','30000','1','18','Kladi_Hitam_9.jpg','-','<p>Keladi adalah salah satu jenis tanaman yang memiliki banyak peminat. Setelah aglonema dan monstera (janda bolong), kini pesona tanaman hias yang diprediksi akan populer adalah tanaman keladi. Coraknya yang cantik dan beragam membuat tanaman ini cocok untuk menjadi penghias rumah Anda.</p>\r\n'),(20,11,'Pupuk Gandasil','gandasil, pupuk, pupuk gandasil','10000','1','2','Pupuk_Gandasil_D_100gram_4.jpg','-','<p><strong>Pupuk Gandasil D adalah&nbsp;pupuk NPK majemuk dan sebagai pupuk daun Foliar. Pupuk ini berfungsi untuk menyokong pertumbuhan tanaman, sehingga dapat tumbuh lebih cepat dan terbilang ekonomis.</strong></p>\r\n'),(21,11,'Pupuk Urea','pupu, urea, pupuk urea','15000','1','7','Pupuk_Urea_Repack_1kg_5.jpg','-','<p><strong>Urea adalah adalah&nbsp;senyawa organik tunggal yang tersusun dari unsur karbon, hidrogen, oksigen dan nitrogen dengan rumus CON2H4 atau (NH2)2CO.&nbsp;</strong></p>\r\n'),(22,11,'Liquinox','pupuk liquinox','8000','1','3','Liquinox_100m_2.jpg','-','<p>Liquinox Start atau yang sering disebut sebagai Vitamin B1 merupakan&nbsp;pupuk cair yang dibuat untuk menghasilkan Produksi yang maksimal ketika pencangkokan atau memindahkan, menanam tanaman baru dan untuk menyehatkan semua jenis tanaman.</p>\r\n'),(23,10,'Lidah Mertua','lidah, mertua, lidah mertua','20000','1','14','Lidah_Mertua_10.jpg','-','<p>Sansevieria atau lidah mertua adalah marga tanaman hias yang cukup populer sebagai penghias bagian dalam rumah karena tanaman ini dapat tumbuh dalam kondisi yang sedikit air dan cahaya matahari.</p>\r\n'),(24,12,'Pot Bunga Putih Sedang','pot, putih, kotak','6000','1','13','Pot_Bunga_Putih_5.jpg','-','<p>Pot bunga putik kotak, untuk mempercantik tanaman</p>\r\n'),(25,12,'Pot Bunga Putih Bulat','pot bunga, putih, bulat','6000','1','9','Pot_Bunga_Putih_Bulat_6.jpg','-','<p>Pot bunga putih bulat, untuk memperindah tanaman.</p>\r\n'),(26,12,'Bak Kotak','bak, kotak, bak kotak','35000','1','12','Bak_Kotak_1.jpg','-','<p>Bak kotak banyak kegunaan</p>\r\n'),(27,12,'Pot Bunga Hitam Kecil','pot bunga hitam, hitam, pot, bunga','5000','1','5','Pot_Bunga_17Cm_3.jpg','-','<p>Pot bunga hitam kecil, untuk memperindah tanaman.</p>\r\n'),(28,12,'Pot Bunga Hitam Besar','pot, bunga, hitam, pot bunga hitam ','20000','1','12','Pot_Bunga_25Cm_4.jpg','-','<p>Pot bunga hitam besar, untuk memperindah tanaman.</p>\r\n'),(29,11,'Pupuk Super','pupuk, super, pupuk super','10000','1','3','Kompos_Super_1.jpg','-','<p>Pupuk super untuk membentukan tanaman menjadi sehat</p>\r\n');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `notransaksi` varchar(225) DEFAULT NULL,
  `resipengiriman` varchar(225) DEFAULT NULL,
  `alamatpengiriman` varchar(225) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `voucher` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `tanggalbeli` date DEFAULT NULL,
  `status` enum('pending','berhasil') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`idtransaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-27  4:54:47
