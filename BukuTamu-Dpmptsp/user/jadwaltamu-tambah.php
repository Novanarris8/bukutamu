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

$kd_user = $_SESSION["kode_pengguna"];
$id_daftar = $_GET["id_daftar"];

$query = "SELECT * FROM tbl_pendaftaran
            LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai WHERE id_daftar = $id_daftar";
$result = mysqli_query($conn, $query);
$rowPegawai = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {

    $asal_pemohon = htmlspecialchars($_POST["asal_pemohon"]);
    $namarekan_pemohon = htmlspecialchars($_POST["namarekan_pemohon"]);
    $jumlahtamu_pemohon = htmlspecialchars($_POST["jumlahtamu_pemohon"]);
    $perihal_pemohon = htmlspecialchars($_POST["perihal_pemohon"]);
    $status_pemohon = "Menunggu";
    $alasan = "";


    $surat_pemohon = $_FILES["surat_pemohon"]["name"];

    move_uploaded_file($_FILES['surat_pemohon']['tmp_name'], '../assets/files/' . $surat_pemohon);


    $query = "INSERT INTO tbl_pemohon VALUES ('', '$id_daftar', '$kd_user', '$asal_pemohon', '$namarekan_pemohon', '$jumlahtamu_pemohon', '$perihal_pemohon', '$surat_pemohon', '$status_pemohon', '$alasan')";
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
    <title>Tambah Data Pemohon | DPMPTSP</title>
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
                            <h1>Silahkan Isi Form Ini</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="pemohon.php">pemohon</a></li>
                                <li class="breadcrumb-item active">Tambah Pemohon</li>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="id_pegawai"> Pegawai : <?= $rowPegawai["nama_pegawai"] ?></label>

                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal : <?= $rowPegawai["tanggal_daftar"] ?></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="asal_pemohon">Asal Instansi :</label>
                                                <input type="text" class="form-control" id="asal_pemohon" name="asal_pemohon" placeholder="Masukkan Asal Instansi Anda" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="namarekan_pemohon">Nama Tamu :</label>
                                                <input type="text" class="form-control" id="namarekan_pemohon" name="namarekan_pemohon" placeholder="Masukkan Nama Rekan Anda" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlahtamu_pemohon">Jumlah Tamu :</label>
                                                <input type="text" class="form-control" id="jumlahtamu_pemohon" name="jumlahtamu_pemohon" placeholder="Masukkan Jumlah Tamu yang akan datang" required>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="no_hp">No Handphone :</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No Handphone Yang Aktif" required>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="perihal_pemohon">Perihal Kunjungan :</label>
                                                <input type="text" class="form-control" id="perihal_pemohon" name="perihal_pemohon" placeholder="Masukkan Perihal Kunjungan datang ke Instansi" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="surat_pemohon">Surat Permohonan :</label>
                                                <input type="file" class="form-control" id="surat_pemohon" name="surat_pemohon" required>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary mr-1">Kirim</button>
                                                <a href="pemohon.php" class="btn btn-secondary">Batal</a>
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