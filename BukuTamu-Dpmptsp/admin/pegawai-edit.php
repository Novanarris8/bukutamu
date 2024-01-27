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

$id_pegawai = $_GET["id_pegawai"];
$query_pegawai = "SELECT * FROM tbl_pegawai WHERE id_pegawai = $id_pegawai";
$result_pegawai = mysqli_query($conn, $query_pegawai);
$row_pegawai = mysqli_fetch_assoc($result_pegawai);

//query tampilan data konsumsi
if (isset($_POST["submit"])) {
    $nip_pegawai = htmlspecialchars($_POST["nip_pegawai"]);
    $nama_pegawai = htmlspecialchars($_POST["nama_pegawai"]);
    $ttl_pegawai = htmlspecialchars($_POST["ttl_pegawai"]);
    $jabatan_pegawai = htmlspecialchars($_POST["jabatan_pegawai"]);
    $alamat_pegawai = htmlspecialchars($_POST["alamat_pegawai"]);

    $query = "UPDATE tbl_pegawai SET
            nip_pegawai = '$nip_pegawai',
            nama_pegawai = '$nama_pegawai',
            ttl_pegawai = '$ttl_pegawai',
            jabatan_pegawai = '$jabatan_pegawai',
            alamat_pegawai = '$alamat_pegawai'
            WHERE id_pegawai= $id_pegawai";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'>
            alert('Data berhasil diedit...!');
            document.location.href = 'pegawai.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Data GAGAL diedit...!');
            document.location.href = 'pegawai-edit.php?id=$id';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Pegawai | DPMPTSP KOTA BANJARMASIN</title>
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
                                <li class="breadcrumb-item"><a href="Pegawai.php">Pegawai</a></li>
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
                                            <label for="nip_pegawai">NIP :</label>
                                            <input type="text" class="form-control" id="nip_pegawai" name="nip_pegawai" value="<?= $row_pegawai["nip_pegawai"]; ?>" placeholder="Masukkan nip" required autocomplete="off">
                                             <label for="nama_pegawai">Nama Pegawai :</label>
                                            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="<?= $row_pegawai["nama_pegawai"]; ?>" placeholder="Masukkan Nama Pegawai" required autocomplete="off">
                                            <label for="ttl_pegawai">Tanggal Lahir:</label>
                                            <input type="date" class="form-control" id="ttl_pegawai" name="ttl_pegawai" value="<?= $row_pegawai["ttl_pegawai"]; ?>" placeholder="Masukkan Tanggal lahir Pegawai" required autocomplete="off">
                                            <label for="jabatan_pegawai">Jabatan :</label>
                                            <input type="text" class="form-control" id="jabatan_pegawai" name="jabatan_pegawai" value="<?= $row_pegawai["jabatan_pegawai"]; ?>" placeholder="Masukkan Jabatan Pegawai" required autocomplete="off">
                                            <label for="alamat_pegawai">Alamat :</label>
                                            <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai" value="<?= $row_pegawai["alamat_pegawai"]; ?>" placeholder="Masukkan Alamat Pegawai" required autocomplete="off">                                             
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
    <!-- <script type="text/javascript">
    $("#jumlah").keyup(function() {
        var a = parseFloat($("#jumlah").val());
        var b = parseFloat($("#harga").val());

        // Check if the values are valid numbers
        if (!isNaN(a) && !isNaN(b)) {
            var d = a * b;
            $("#total").val(d);
        } else {
            $("#total").val(''); // Set total to empty if any value is not a number
        }
    });

    $("#harga").keyup(function() {
        var a = parseFloat($("#jumlah").val());
        var b = parseFloat($("#harga").val());

        // Check if the values are valid numbers
        if (!isNaN(a) && !isNaN(b)) {
            var d = a * b;
            $("#total").val(d);
        } else {
            $("#total").val(''); // Set total to empty if any value is not a number
        }
    });
</script> -->


</body>

</html>