<?php if ($id_page != 2 && $id_page != 4 && $id_page != null) : ?>
    <footer class="container-fluid position-relative">
        <div class="row py-5 text-light d-flex justify-content-evenly" style="background: #008000;">
            <div class="col-xl-4 col-md-12 col-sm-12">
                <a href="#home" class="d-flex align-items-center text-dark text-decoration-none">
                    <!-- sehatin punya -->
                    <img src="./foto/logo.png" height="50" alt="tanaman hias" class="mb-3">
                    <h5 class="ms-2 text-light">Tanaman Hias</h5>
                </a>

                <div class="d-block mb-1">
                    <i class="fa fa-envelope me-1" aria-hidden="true"></i>
                    <span>tanamanhias@gmail.com</span>
                </div>

                <div class="d-block mb-3 mb-xl-0">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        JL. R.A Kartini, RT.9/RW.10 Jakarta Selatan
                    </span>
                </div>
            </div>

            <div class="col-xl-3 col-sm-12 col-md-12 my-2 mb-4">
                <h3>Navigasi</h3>
                <a class="text-decoration-none" href="index.html">
                    <p class="mb-0 text-light">Home</p>
                </a>
                <a class="text-decoration-none" href="./page/sehatin.html">
                    <p class="mb-0 text-light">Produk</p>
                </a>
                <a class="text-decoration-none" href="./page/konsultasi.html">
                    <p class="mb-0 text-light">Kategori</p>
                </a>
            </div>

            <div class="col-xl-3 col-sm-12 col-md-12 my-2 mb-4">
                <h3>Social Media</h3>
                <a class="d-block text-decoration-none text-light" href="#">
                    <i class="fa fa-instagram me-1" aria-hidden="true"></i>
                    <span>Instagram</span>
                </a>

                <a class="d-block text-decoration-none text-light" href="#">
                    <i class="fa me-1 fa-linkedin" aria-hidden="true"></i>
                    <span>LinkedIn</span>
                </a>

                <a class="d-block text-decoration-none text-light" href="">
                    <i class="fa me-1 fa-twitter" aria-hidden="true"></i>
                    <span>Twitter</span>
                </a>

                <a class="d-block text-decoration-none text-light" href="">
                    <i class="fa me-2 fa-facebook" aria-hidden="true"></i>
                    <span>Facebook</span>
                </a>
            </div>
        </div>

        <div class="row text-light" style="background: #008000;">
            <hr class="mb-0">
            <?php date_default_timezone_set('Asia/Jakarta');
            $date = date('Y', strtotime('now')); ?>
            <div class="col-12 d-flex justify-content-center align-items-center" style="height: 10vh">
                <p class="pt-3" style="font-size: 15px;">Copyright &copy; <?= $date; ?>. <strong>Tanaman Hias</strong></p>
            </div>
        </div>
    </footer>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a0f5cf7da9.js" crossorigin="anonymous"></script>


<?php if ($id_page == 4 || $title == 'Riwayat Transaksi') : ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
<?php endif; ?>
</body>

</html>