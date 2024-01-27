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

$id = $_GET["id"];
$query_tbl_user = "SELECT * FROM tbl_user WHERE id_user = $id";
$result_tbl_user = mysqli_query($conn, $query_tbl_user);
$row_daftartamu = mysqli_fetch_assoc($result_tbl_user);


$query_pengguna = "SELECT * FROM tbl_pengguna";
$result_pengguna = mysqli_query($conn, $query_pengguna);
$row_pengguna = mysqli_fetch_assoc($result_pengguna);
?>
<?php
// Kode PHP untuk mengecek status edited sebelum menampilkan formulir edit

$id = $_GET['id'];

// Periksa status edited
$sql_check = "SELECT konfirmasi FROM tbl_pengguna WHERE id = $id";
$result = mysqli_query($conn, $sql_check);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $edited_status = $row['konfirmasi'];

    if ($edited_status == 1) {
        // Data sudah diedit, berikan pemberitahuan atau tindakan sesuai dengan kebutuhan Anda
        echo  "<script>Data sudah diubah dan tidak dapat diedit lagi.</script>";
    } else {
        // Tampilkan formulir edit
        // ...
    }
}
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
                            <h1>Approve AKun</h1>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="status" name="status" value="Tolak">
                                            <input type="hidden" class="form-control" id="konfirmasi" name="konfirmasi" value="1">
                                            <input type="hidden" class="form-control" id="oleh" name="oleh" value="<?= $row_pengguna["username"] ?>" readonly>
                                            <label for="Alasan">Alasan di Tolak :</label>
                                            <input type="text" class="form-control" id="alasan" name="alasan" required rows="4" autocomplete="off">
                                            <br>
                                            <!-- <select name="status" id="status" class="form-select" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Terima">Terima</option>
                                                <option value="Tolak">Tolak</option>
                                                
                                            </select>                    -->
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-dark mr-1">Kirim</button>
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

    <script src="../../js/sweetalert2.all.min.js"></script>
</body>

</html>

<?php

//query tampilan data daftartamu
if (isset($_POST["submit"])) {
    $status = "0";

    $query = "UPDATE tbl_pengguna SET 
    status= '$status'
    WHERE id = $id";

    $edit = mysqli_query($conn, $query);

    if ($edit) {
        // Tampilkan pesan SweetAlert menggunakan JavaScript
        echo '<script>
        Swal.fire({
            title: "Apakah yakin menolak data ini?",
            text: "Data tidak dapat di ubah",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "TOLAK!",
                    text: "Data ini berhasil di tolak",
                    icon: "success"
                }).then(() => {
                    // Redirect to the desired page
                    window.location.href = "daftartamu.php";
                });
            }
        });
    </script>';
    } else {
        echo "<script type='text/javascript'>
                alert('Data GAGAL diedit...!');
                document.location.href = 'daftartamu-edit.php?id=$id';
            </script>";
    }
}
