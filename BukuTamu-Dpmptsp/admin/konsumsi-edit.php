<?php
include "untuk-sesi.php";

$id_konsumsi = $_GET["id_konsumsi"];
$query_konsumsi = "SELECT * FROM tbl_konsumsi K 
            LEFT JOIN tbl_pemohon P ON K.id_pemohon = P.id_pemohon
            LEFT JOIN tbl_pendaftaran D ON P.id_daftar = D.id_daftar
            LEFT JOIN tbl_user U ON P.kode_user = U.kode_user WHERE id_konsumsi = $id_konsumsi";
$result_konsumsi = mysqli_query($conn, $query_konsumsi);
$row_konsumsi = mysqli_fetch_assoc($result_konsumsi);

if (isset($_POST["submit"])) {

    $makanan_konsumsi = htmlspecialchars($_POST["makanan_konsumsi"]);
    $harga_konsumsi = htmlspecialchars($_POST["harga_konsumsi"]);
    $total_konsumsi = htmlspecialchars($_POST["total_konsumsi"]);

    $query = "UPDATE tbl_konsumsi SET 
            makanan_konsumsi = '$makanan_konsumsi', 
            harga_konsumsi = '$harga_konsumsi', 
            total_konsumsi = '$total_konsumsi'
            WHERE id_konsumsi = $id_konsumsi";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'> 
            alert('Data berhasil diedit...!'); 
            document.location.href = 'konsumsi.php'; 
            </script>";
    } else {
        echo "<script type='text/javascript'> 
            alert('Data GAGAL diedit...!'); 
            document.location.href = 'konsumsi-edit.php?id_konsumsi=$id_konsumsi'; 
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Konsumsi | PRAKTIKUM FTI UNISKA</title>
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
                            <h1>Data Konsumsi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="pemohon.php">Konsumsi</a></li>
                                <li class="breadcrumb-item active">Edit Konsumsi</li>
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
                                            <label for="jumlahtamu_pemohon">Jumlah:</label>
                                            <input type="number" class="form-control" step="any" min="0" id="jumlahtamu_pemohon" name="jumlahtamu_pemohon" value="<?php echo $row_konsumsi["jumlahtamu_pemohon"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="makanan_konsumsi">Konsumsi:</label>
                                            <input type="text" class="form-control" id="makanan_konsumsi" name="makanan_konsumsi" value="<?php echo $row_konsumsi["makanan_konsumsi"]; ?>" placeholder="Nama Bagian/Bidang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_konsumsi">Harga:</label>
                                            <input type="number" step="any" min="0" id="harga" name="harga_konsumsi" value="<?php echo $row_konsumsi["harga_konsumsi"]; ?>" class="form-control" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="total_konsumsi">Total :</label>
                                            <input type="text" class="form-control" id="total" name="total_konsumsi" value="<?php echo $row_konsumsi["total_konsumsi"]; ?>" placeholder="Nama Bagian/Bidang" required>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" name="submit" class="btn btn-primary mr-1">Simpan</button>
                                            <a href="konsumsi.php" class="btn btn-secondary">Batal</a>
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

<script type="text/javascript">
    $("#jumlahtamu_pemohon").keyup(function() {
        var a = parseFloat($("#jumlahtamu_pemohon").val());
        var b = parseFloat($("#harga").val());
        var d = a * b;
        $("#total").val(d);
    });

    $("#harga").keyup(function() {
        var a = parseFloat($("#jumlahtamu_pemohon").val());
        var b = parseFloat($("#harga").val());
        var d = a * b;
        $("#total").val(d);
    });
</script>

</html>