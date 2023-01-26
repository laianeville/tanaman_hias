<?php

session_start();
include '../koneksi.php';

if (!isset($_SESSION['level'])) {
  if ($_SESSION["level"] != 'Admin') {
    echo "<script> alert('Anda belum login');</script>";
    echo "<script> location ='../login.php';</script>";
  }
}

$title = 'Kategori';
$id_page = 'admin3';

if (isset($_POST['tambah'])) {
  $judulkategori = $_POST['judulkategori'];

  $sql = mysqli_query($koneksi, "INSERT INTO kategori(judulkategori) VALUES('$judulkategori')");
  if ($sql) {
    echo "<script>alert('Satu data kategori berhasil ditambahkan');</script>";
    echo "<script> location ='../admin/kategori.php';</script>";
  }
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
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-xl-12">
            <!-- Large modal -->
            <button type="button" class="btn btn-success create" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Kategori</button>

            <!-- modal tambah -->
            <div class="modal fade bd-example-modal-lg create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Tambah Kategori</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="POST">
                    <div class="modal-body">
                      <label for="judulkategori">Kategori</label>
                      <input type="text" class="form-control" name="judulkategori" id="judulkategori" placeholder="Masukkan Judul Kategori" style="height: 50px;">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="card mt-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="dataTable">
                    <thead class="table-warning">
                      <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php $kategori = mysqli_query($koneksi, "SELECT * FROM kategori"); ?>
                      <?php while ($data = mysqli_fetch_assoc($kategori)) : ?>
                        <tr style="white-space: nowrap;">
                          <td><?= $no++ . '.'; ?></td>
                          <td><?= $data['judulkategori']; ?></td>
                          <td>
                            <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" href="delete_kategori.php?id=<?= $data['idkategori']; ?>" class="btn btn-danger">
                              <i class="fa fa-ban"></i>
                            </a>
                            <a href="edit_kategori.php?id=<?= $data['idkategori']; ?>" class="btn btn-info">
                              <i class="fa fa-cog"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>

<?php include './layouts/footer.php'; ?>