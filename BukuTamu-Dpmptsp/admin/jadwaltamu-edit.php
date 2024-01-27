<?php
include "untuk-sesi.php";

$id_daftar = $_GET["id_daftar"];
$query_pendaftaran = "SELECT * FROM tbl_pendaftaran WHERE id_daftar = $id_daftar";
$result_pendaftaran = mysqli_query($conn, $query_pendaftaran);
$row_pendaftaran = mysqli_fetch_assoc($result_pendaftaran);

//query tampilan data pendaftaran
if (isset($_POST["submit"])) {
    $id_pegawai = htmlspecialchars($_POST["id_pegawai"]);
    $tanggal_daftar = htmlspecialchars($_POST["tanggal_daftar"]);
    $jam_daftar = htmlspecialchars($_POST["jam_daftar"]);
    $status_daftar = htmlspecialchars($_POST["status_daftar"]);


    $query = "UPDATE tbl_pendaftaran SET
            id_pegawai = '$id_pegawai',
            tanggal_daftar= '$tanggal_daftar',
            jam_daftar= '$jam_daftar',
            status_daftar= '$status_daftar'
            WHERE id_daftar = $id_daftar
            ";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'>
            alert('Data berhasil diedit...!');
            document.location.href = 'jadwaltamu.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Data GAGAL diedit...!');
            document.location.href = 'jadwaltamu-edit.php?id_daftar=$id_daftar';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Jadwal Kunjungan | DPMPTSP KOTA BANJARMASIN</title>
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
                            <h1>Mengatur Jadwal</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="pendaftaran.php">Mengatur Jadwal</a></li>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <select class="form-control" name="id_pegawai">
                                                <?php
                                                $query_pegawai = "SELECT * FROM tbl_pegawai";
                                                $result_pegawai = mysqli_query($conn, $query_pegawai);

                                                while ($row_pegawai = mysqli_fetch_assoc($result_pegawai)) {
                                                    $selected = ($row_pemohon["id_pegawai"] == $row_pegawai['id_pegawai']) ? "selected" : "";
                                                ?>
                                                    <option value="<?php echo $row_pegawai['id_pegawai']; ?>" <?php echo $selected; ?>>
                                                        <?php echo $row_pegawai["nama_pegawai"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <!-- <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai" value="<?php echo $row_pemohon["id_pegawai"]; ?>" placeholder="Nama Bagian/Bidang" required> -->

                                            <label for="tanggal_daftar">Tanggal :</label>
                                            <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" value="<?= $row_pendaftaran["tanggal_daftar"]; ?>" placeholder="Masukkan tanggal_daftar In Bertamu" required>

                                            <label class="form-label" for="jam_daftar">Jam sebelumnya : <?= $row_pendaftaran["jam_daftar"]; ?> </label><br>
                                            <label class="form-label" for="jam_daftar">Perbaharui Jam :</label>
                                            <input type="time" class="form-control" id="jam_daftar" name="jam_daftar" value="<?= $row_pendaftaran["jam_daftar"]; ?>" required>

                                            <label for="status_daftar">Status :</label>
                                            <select class="form-control" id="status_daftar" name="status_daftar" required>
                                                <option value="1" <?php echo ($row_pendaftaran["status_daftar"] == 1) ? 'selected' : ''; ?>>Ada</option>
                                                <option value="2" <?php echo ($row_pendaftaran["status_daftar"] == 2) ? 'selected' : ''; ?>>Full</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary mr-1">Simpan</button>
                                        <a href="pendaftaran.php" class="btn btn-secondary">Batal</a>
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