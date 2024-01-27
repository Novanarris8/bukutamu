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

//query tampilan data jadwaltamu
if (isset($_POST["submit"])) {
    $id_pegawai = htmlspecialchars($_POST["id_pegawai"]);
    $tanggal_daftar = htmlspecialchars($_POST["tanggal_daftar"]);
    $jam_daftar = htmlspecialchars($_POST["jam_daftar"]);
    $status_daftar = htmlspecialchars($_POST["status_daftar"]);
    $query = "INSERT INTO tbl_pendaftaran VALUES ('', '$id_pegawai', '$tanggal_daftar', '$jam_daftar','$status_daftar')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
            alert('Data berhasil disimpan...!');
            document.location.href = 'jadwaltamu.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Data gagal disimpan...!');
            document.location.href = 'jadwaltamu-tambah.php';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data jadwal Tamu | DPMPTSP KOTA BANJARMASIN</title>
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
                            <h1>Jadwal Tamu</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="jadwaltamu.php">Data Tamu</a></li>
                                <li class="breadcrumb-item active">Tambah Data</li>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label" for="id_pegawai">Nama Instansi :</label>

                                            <select class="form-control" id="id_pegawai" name="id_pegawai" required>
                                                <option value="">-- Pilih Nama Pegawai --</option>
                                                <?php
                                                $query_pegawai = "SELECT * FROM tbl_pegawai";
                                                $result_pegawai = mysqli_query($conn, $query_pegawai);
                                                while ($row_pegawai = mysqli_fetch_assoc($result_pegawai)) {
                                                ?>
                                                    <option value="<?php echo $row_pegawai["id_pegawai"]; ?>"><?php echo $row_pegawai["nama_pegawai"]; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="tanggal_daftar">Tanggal :</label>
                                            <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" placeholder="Masukkan Tanggal_daftar" required>

                                            <label for="jam_daftar">Jam_daftar :</label>
                                            <input type="time" class="form-control" id="jam_daftar" name="jam_daftar" placeholder="Masukkan Jam_daftar Untuk Berkunjung " required>

                                            <label for="status_daftar">Status :</label>
                                            <select class="form-control" name="status_daftar" id="status_daftar">
                                                <option value="1">Ada</option>
                                                <option value="2">Full</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary mr-1">Simpan</button>
                                        <a href="jadwaltamu.php" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
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