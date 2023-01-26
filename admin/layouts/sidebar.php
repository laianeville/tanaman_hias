<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="../admin/index.php" class="brand-link">
        <img src="../dist/img/logo.jpeg" alt="Tanaman Hias Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-success">Tanaman Hias</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/users'.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block">Admin</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="../admin/index.php" class="nav-link <?php if ($id_page == 'admin1') : ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">MENU</li>

                <li class="nav-item">
                    <a href="../admin/produk.php" class="nav-link <?php if ($id_page == 'admin2') : ?> active <?php endif; ?>">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../admin/kategori.php" class="nav-link <?php if ($id_page == 'admin3') : ?> active <?php endif; ?>">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../admin/transaksi.php" class="nav-link <?php if ($id_page == 'admin4') : ?> active <?php endif; ?>">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../admin/akun.php" class="nav-link <?php if ($id_page == 'admin5') : ?> active <?php endif; ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Akun Member
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="./laporan.html" class="nav-link <?php if ($id_page == 'admin6') : ?> active <?php endif; ?>">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            Laporan Bulanan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>