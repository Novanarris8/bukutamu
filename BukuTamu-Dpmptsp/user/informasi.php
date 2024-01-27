<?php
session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

$id_pengguna = $_SESSION["id"];
$kd_user = $_GET["kode_user"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Tamu | DPMPTSP KOTA BANJARMASIN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "theme-header.php"; ?>

        <?php include "theme-sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Tamu</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="daftartamu.php">Daftar Tamu</a></li>
                                <li class="breadcrumb-item active">Edit Data</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <!-- <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="class-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-hover table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Nama Tamu</th>
                                                <th>Asal Instansi</th>
                                                <th>Nama Rekan</th>
                                                <th>Jumlah Tamu</th>
                                                <!-- <th>Nomor Handphone</th> -->
                                                <th>Perihal Kunjungan</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Surat Permohonan</th>
                                                <th>Status</th>
                                                <th>Alasan Di tolak</th>
                                                <!-- <th>Oleh</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query_admin = "SELECT * FROM tbl_pemohon A 
                                            LEFT JOIN tbl_pendaftaran B ON A.id_daftar = B.id_daftar
                                            LEFT JOIN tbl_pegawai C ON B.id_pegawai = C.id_pegawai
                                            LEFT JOIN tbl_user D ON A.kode_user = D.kode_user 
                                            WHERE A.kode_user = '$kd_user' AND status_pemohon IN ('Di Verifikasi', 'Tolak')";

                                            $result_admin = mysqli_query($conn, $query_admin);

                                            while ($row_admin = mysqli_fetch_assoc($result_admin)) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $row_admin["nama_pegawai"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["asal_pemohon"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["namarekan_pemohon"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["jumlahtamu_pemohon"] ?>
                                                    </td>
                                                    <!-- <td>
                                                        <?= $row_admin["no_telp"] ?>
                                                    </td> -->
                                                    <td>
                                                        <?= $row_admin["perihal_pemohon"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["tanggal_daftar"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["jam_daftar"] ?>
                                                    </td>
                                                    <td>
                                                        <a href="../assets/files/<?= $row_admin["surat_pemohon"] ?>" target="_blank"><?= $row_admin["surat_pemohon"] ?></a>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["status_pemohon"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_admin["alasan"] ?>
                                                    </td>
                                                    <!-- <td>
                                                    <?= $row_admin["oleh"] ?>
                                                </td> -->
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include "theme-footer.php"; ?>
    </div>

    <!-- ./wrapper -->

    <!-- JQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTablles & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>