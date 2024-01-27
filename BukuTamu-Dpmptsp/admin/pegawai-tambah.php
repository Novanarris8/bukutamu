<?php
include "untuk-sesi.php";

//query tampilan data Konsumsi
if (isset($_POST["submit"])) {
    $nip_pegawai = htmlspecialchars($_POST["nip_pegawai"]);
    $nama_pegawai = htmlspecialchars($_POST["nama_pegawai"]);
    $ttl_pegawai = htmlspecialchars($_POST["ttl_pegawai"]);
    $jabatan_pegawai = htmlspecialchars($_POST["jabatan_pegawai"]);
    $alamat_pegawai = htmlspecialchars($_POST["alamat_pegawai"]);

    $query = "INSERT INTO tbl_pegawai VALUES ('', '$nip_pegawai','$nama_pegawai','$ttl_pegawai', '$jabatan_pegawai','$alamat_pegawai')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
            alert('Data berhasil disimpan...!');
            document.location.href = 'pegawai.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Data gagal disimpan...!');
            document.location.href = 'pegawai-tambah.php';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Pegawai | DPMPTSP KOTA BANJARMASIN</title>
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
                            <h1>Data Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="konsumsi.php">Pegawai</a></li>
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
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nip_pegawai">NIP :</label>
                                            <input type="text" class="form-control" id="nip_pegawai" name="nip_pegawai" placeholder="Masukkan NIP" required autocomplete="off">
                                            <label for="nama_pegawai">Nama :</label>
                                            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan Nama Lengkap Pegawai" required autocomplete="off">
                                            <label for="ttl_pegawai">Tanggal Lahir :</label>
                                            <input type="date" step="any" min="0" id="ttl_pegawai" name="ttl_pegawai" placeholder="Masukkan Tanggal Lahir Pegawai" class="form-control" required autocomplete="off">
                                            <label for="jabatan_pegawai">Jabatan :</label>
                                            <input type="text" class="form-control" id="jabatan_pegawai" name="jabatan_pegawai" placeholder="Masukkan jabatan_pegawai Pegawai" required autocomplete="off">
                                            <label for="alamat_pegawai">Alamat :</label>
                                            <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai" placeholder="Masukkan Alamat Lengkap Pegawai" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary mr-1">Simpan</button>
                                        <a href="pegawai.php" class="btn btn-secondary">Batal</a>
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