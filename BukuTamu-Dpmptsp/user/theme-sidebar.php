        <!-- Main Sidebar Container -->
        <link rel="stylesheet" href="color.css">
        <aside class="main-sidebar sidebar-dark-primary elevation-4 andini">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <?php
                    $id = $_SESSION["id"];
                    $query_user = "SELECT * FROM tbl_user A
                INNER JOIN tbl_pengguna P ON A.kode_user = P.kode_pengguna
                WHERE P.id = '$id'";
                    $result_user = mysqli_query($conn, $query_user);

                    // Check if the query executed successfully
                    if (!$result_user) {
                        die('Query failed: ' . mysqli_error($conn));
                    }

                    $row_user = mysqli_fetch_assoc($result_user);
                    ?>
                    <div class="image">
                        <img src="img/<?= $row_user["foto"] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info ini-font">
                        <p class="text-black-719">Hallo! <br> Anda Login Sebagai:</p>
                        <a href="#" class="d-block text-uppercase" style="color: rgba(0, 0, 0, 0.719);"><?php echo $_SESSION["username"]; ?> </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2 ini-font">
                    <ul class="nav nav-pills nav-sidebar flex-column andinip" data-widget="treeview" role="menu" data-accordion="false" style="font-size: 19px;">

                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php
                        $id = $_SESSION["id"];
                        $query_user = "SELECT * FROM tbl_user A
                INNER JOIN tbl_pengguna P ON A.kode_user = P.kode_pengguna
                WHERE P.id = '$id'";
                        $result_user = mysqli_query($conn, $query_user);

                        // Check if the query executed successfully
                        if (!$result_user) {
                            die('Query failed: ' . mysqli_error($conn));
                        }

                        $row_user = mysqli_fetch_assoc($result_user);
                        ?>
                        <li class="nav-item">
                            <a href="profile-user.php?kode_user=<?php echo $row_user['kode_user']; ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwaltamu.php" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Cek Jadwal Kunjungan
                                </p>
                            </a>
                        </li>

                        <?php
                        $query = "SELECT * FROM tbl_pemohon A 
                        LEFT JOIN tbl_pendaftaran B ON A.id_daftar = B.id_daftar
                        LEFT JOIN tbl_pegawai C ON B.id_pegawai = C.id_pegawai
                        LEFT JOIN tbl_user D ON A.kode_user = D.kode_user
                        ";
                        $result = mysqli_query($conn, $query);
                        $data = mysqli_fetch_array($result);
                        ?>
                        <li class="nav-item">
                            <a href="status-pemohon.php?kode_user=<?php echo $data['kode_user']; ?>" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Status Permohonan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="informasi.php?kode_user=<?php echo $data['kode_user']; ?>" class="nav-link">
                                <i class="nav-icon fas fa-file-import"></i>
                                <p>Histori Kunjungan
                                </p>
                            </a>
                        </li>
                    </ul>
                    </li>
                    </ul>
                    </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>