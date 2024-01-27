        <!-- Main Sidebar Container -->
        <link rel="stylesheet" href="color.css">
        <?php
        $id = $_SESSION["id"];
        $query_admin = "SELECT *  FROM tbl_admin A
                            INNER JOIN tbl_pengguna P ON A.kode_admin = P.kode_pengguna
                            WHERE P.id = '$id'";
        $result_admin = mysqli_query($conn, $query_admin);
        $row_admin = mysqli_fetch_assoc($result_admin);
        ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <aside class="main-sidebar sidebar-dark-primary elevation-4 andini">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class=" mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="img/<?= $row_admin["foto"] ?>" class="img-circle elevation-2 mx-2" alt="User Image" width="50">
                    </div>
                    <div class="info ini-font">
                        <p class="text-black-719">Hallo! <br> Anda Login Sebagai:</p>
                        <a href="#" class="d-block text-uppercase" style="color: rgba(0, 0, 0, 0.719);"><?php echo $_SESSION["username"]; ?></a>
                    </div>
                    <div>
                        <h5 class="logo-text"></h5>
                        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2 ini-font">
                    <ul class="nav nav-pills nav-sidebar flex-column andinip" data-widget="treeview" role="menu" data-accordion="false" style="font-size: 18px;">

                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="approval.php" class="nav-link">
                                <i class="nav-icon fas fa-user-check"></i>
                                <p>
                                    Verifikasi Akun
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pegawai.php" class="nav-link">
                                <i class="nav-icon fas fa-users rectangle"></i>
                                <p>
                                    Data Pegawai
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pemohon.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Daftar Pemohon
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tamu.php" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Data Tamu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwaltamu.php" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Jadwal Kunjungan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="konsumsi.php" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Konsumsi
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Report Berdasarkan Status
                                </p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="laporan-menunggu.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Menunggu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="laporan-terima.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Terima</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="laporan-tolak.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tolak</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="laporan-konsumsi.php" target="_blank" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Konsumsi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="konsumsi-cetak.php" target="_blank" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Perbulan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-gear" style="font-size:24px"></i>
                                <p>
                                    Pengaturan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <?php
                            $id = $_SESSION["id"];
                            $query_admin = "SELECT *  FROM tbl_admin A
                            INNER JOIN tbl_pengguna P ON A.kode_admin = P.kode_pengguna
                            WHERE P.id = '$id'";
                            $result_admin = mysqli_query($conn, $query_admin);
                            $row_admin = mysqli_fetch_assoc($result_admin);
                            ?>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="profile-user.php?id_admin=<?= $row_admin["id_admin"] ?>" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="password.php" target="_blank" class="nav-link">
                                        <i class="nav-icon fas fa-lock"></i>
                                        <p>Password</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Example with CDN -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>