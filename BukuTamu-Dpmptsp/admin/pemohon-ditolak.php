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

$id_pemohon = $_GET["id_pemohon"];

$query_pemohon = "SELECT * FROM tbl_pemohon WHERE id_pemohon = $id_pemohon";
$result_pemohon = mysqli_query($conn, $query_pemohon);
$row_pemohon = mysqli_fetch_assoc($result_pemohon);

if (isset($_POST["submit"])) {

    $alasan = htmlspecialchars($_POST["alasan"]);

    $query = "UPDATE tbl_pemohon SET 
            status_pemohon = 'Tolak', 
            alasan = '$alasan' 
            WHERE id_pemohon = $id_pemohon";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'> 
            alert('Data berhasil ditolak...!'); 
            document.location.href = 'pemohon.php'; 
            </script>";
    } else {
        echo "<script type='text/javascript'> 
            alert('Data GAGAL ditolak...!'); 
            document.location.href = 'pemohon-ditolak.php?id_pemohon=$id_pemohon'; 
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Pemohon | PRAKTIKUM FTI UNISKA</title>
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
                            <h1>Data Pemohon</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="pemohon.php">Pemohon</a></li>
                                <li class="breadcrumb-item active">Edit Pemohon</li>
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
                                            <label for="alasan">Alasan:</label>
                                            <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Masukkan Alasan Data di tolak">
                                            <!-- <textarea name="alasan" id="alasan" cols="30" rows="10"></textarea> -->
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="submit" class="btn btn-primary mr-1">Tolak Data</button>

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
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>