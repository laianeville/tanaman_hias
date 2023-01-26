<?php
function formatrp($angka)
{
    $hasilformatrp = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilformatrp;
}
include('koneksi.php');
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = formatbulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function formatbulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM transaksi JOIN akun
ON transaksi.id=akun.id
WHERE transaksi.idtransaksi='$_GET[id]'");
$datahasil = $ambil->fetch_assoc();
?>
<html>

<head>
    <title>NOTA TRANSAKSI TOKO TANAMAN HIAS</title>
    <style>
        @page {
            margin: 3mm;
        }
    </style>
    <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;padding-top:50px'>
    <table style='width:660; font-size:16pt; font-family:calibri; border-collapse: collapspe;' border='0'>
        <tr>
            <td style="padding-left:80px"><img src="foto/logo.png" width="90" height="90"></td>
            <td>
                <center>
                    <font size="6"><b>TOKO BRALINK TANAMAN HIAS</b></font><br>
                    <font size="3"><b>JL. R.A Kartini, RT.9/RW.10 Jakarta Selatan<br>Telp : 0896 9426 9814, tanamanhias@gmail.com</b>
                    </font><br>
                </center>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <hr style="border-top: 1px solid black;width:660">
    <br>
    <center>
        <table style='width:660; font-size:16pt; font-family:calibri; border-collapse: turunbawah;' border='0'>
            <tr>
                <td width="50px">
                    <span style="font-size:11pt">No. Nota</span>
                </td>
                <td width="10px"> :</td>
                <td width="600px">
                    <span style="font-size:11pt"><?= $datahasil['notransaksi'] ?></span>
                </td>
            </tr>
            <tr>
                <td width="50px">
                    <span style="font-size:11pt">Tanggal</span>
                </td>
                <td width="10px"> :</td>
                <td width="600px">
                    <span style="font-size:11pt"><?= tanggal(date('Y-m-d', strtotime($datahasil['tanggalbeli']))) ?></span>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <span style="font-size:11pt">Nama</span>
                </td>
                <td width="10px"> :</td>
                <td width="600px">
                    <span style="font-size:11pt"><?= $datahasil['nama'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size:11pt">Alamat</span>
                <td width="10px"> :</td>
                <td width="600px" style="font-size:11pt">
                    <?= $datahasil['alamat'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size:11pt">No. HP</span>
                </td>
                <td width="10px"> :</td>
                <td width="600px">
                    <span style="font-size:11pt"><?= $datahasil['nohp'] ?></span>
                </td>
            </tr>
        </table>
        <br><br>
        <table cellspacing='0' cellpadding='0' style='width:660; font-size:12pt; font-family:calibri; border-collapse: turunbawah;' border='1'>
            <thead>
                <tr>
                    <th style="padding:5px;margin:5px">No</th>
                    <th width="40%">Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php $ambildetail = $koneksi->query("SELECT * FROM transaksidetail WHERE idtransaksi='$_GET[id]'"); ?>
                <?php while ($detail = $ambildetail->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $detail['nama']; ?></td>
                        <td align="left">Rp. <?php echo formatrp($detail['harga']); ?></td>
                        <td align="center"><?php echo $detail['jumlah']; ?></td>
                        <td style="padding:5px;margin:5px">Rp. <?php echo formatrp($detail['subharga']); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
                <tr>
                    <td colspan="4" style="text-align:right">Total Harga : &nbsp;</b></em></td>
                    <td class="text-hijau" style="padding:5px;margin:5px"><?php echo formatrp($datahasil['totalbeli']) ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right">Ongkir : &nbsp;</b></em></td>
                    <td class="text-hijau" style="padding:5px;margin:5px"><?php echo formatrp($datahasil['ongkir']) ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right">Grand Total : &nbsp;</b></em></td>
                    <td class="text-hijau" style="padding:5px;margin:5px"><?php echo formatrp($datahasil['totalbeli'] + $datahasil['ongkir']) ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table cellspacing='0' cellpadding='0' style='width:550px; font-size:11pt; font-family:calibri; border-collapse: turunbawah;'>
            <tr>
                <td width="60"><br><br><br><br></td>
                <?php
                $now = date("Y-m-d");

                ?>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Penerima <br><br><br><br><br>(.....................)</td>
                <td width="130"><br><br><br><br></td>
                <?php
                $now = date("Y-m-d");

                ?>
                <td>Hormat Kami, <br><br><br><br><br>(.....................)</td>
            </tr>
        </table>
    </center>
</body>

</html>
<script>
    window.print();
</script>