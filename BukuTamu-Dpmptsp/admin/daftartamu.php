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

if (isset($_POST['filter'])) {
    $query = "SELECT * FROM daftartamu WHERE tanggal='$_POST[bulan]'";
} else {
    $query = "SELECT * FROM daftartamu";
}
$result = mysqli_query($conn, $query);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Daftar Tamu | DPMPTSP KOTA BANJARMASIN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                            <h1>Data Daftar Tamu</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Daftar Tamu</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="daftartamu-tambah.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="bulan">Bulan:</label><br>
                                            <input class="form-control" type="date" name="bulan" id="bulan" style="width: 250px;">
                                        </div>
                                        <div class="">
                                            <button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
                                            <a href="daftartamu.php" class="btn btn-info"><i class="fa fa-sync"></i> Refresh</a>
                                        </div>
                                    </form>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Instansi</th>
                                                <th>Nama Tamu</th>
                                                <th>Jumlah Tamu</th>
                                                <th>Nomor Handphone</th>
                                                <th>Perihal Kunjungan</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Surat Permohonan</th>
                                                <th>Status</th>
                                                <th>Alasan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row["nama_instansi"]; ?></td>
                                                    <td><?php echo $row["nama_tamu"]; ?></td>
                                                    <td><?php echo $row["jumlah"]; ?> Orang </td>
                                                    <td><?php echo $row["no_telepon"]; ?></td>
                                                    <td><?php echo $row["perihal_kunjungan"]; ?></td>
                                                    <td><?php echo $row["tanggal"]; ?></td>
                                                    <td><?php echo $row["jam"]; ?></td>
                                                    <td><a href="../assets/files/<?= $row["surat_permohonan"] ?>" target="_blank"><?= $row["surat_permohonan"] ?> <i class="lni lni-link"></i></a></td>
                                                    <td>
                                                        <?php
                                                        if ($row["status"] == "Menunggu") { ?>
                                                            <span class="badge badge-dark">
                                                                Menunggu
                                                            </span>
                                                        <?php } else if ($row["status"] == "Terima") { ?>
                                                            <span class="badge badge-primary">
                                                                Terima
                                                            </span>
                                                        <?php } else if ($row["status"] == "Tolak") { ?>
                                                            <span class="badge badge-danger">
                                                                Tolak
                                                            </span>
                                                        <?php } ?>

                                                    </td>
                                                    <td><?php echo $row["alasan"]; ?></td>
                                                    <td>

                                                        <?php
                                                        if ($row["edited"] == 0) { ?>
                                                            <div class="d-flex order-actions">
                                                                <a href="daftartamu-verifikasi.php?id=<?= $row["id"] ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit">Konfirmasi</i></a>
                                                                <a href="daftartamu-hapus.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-xs text-light" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class="fa fa-trash"></i>Hapus</a>
                                                            </div>
                                                        <?php } else if ($row["edited"] == 1) { ?>
                                                            <div class="d-flex order-actions">
                                                                <a class="btn btn-dark btn-xs mr-1"><i class="fa fa-edit" title="Data sudah di Edit boss">Konfirmasi</i></a>
                                                                <a class="btn btn-dark btn-xs mr-1"><i class="fa fa-trash" title="Data sudah di Edit boss">Hapus</i></a>
                                                                <a href="../phpqrcode/images/image<?php echo $row["edited"] ?>.png" class="ms-4 text-light bg-info border-0" title="Barcode" target="_blank"><i class='bx bx-barcode'></i></a>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
                "pagingType": "simple_numbers",
                "pageLength": 5,
                // "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pagingType": "simple_numbers",
                "pageLength": 5,
            });
        });
    </script>
</body>

</html>