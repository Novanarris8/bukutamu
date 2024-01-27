<?php
include "../koneksi.php";
session_start();
if ($_SESSION["peran"] == "ADMIN") {
    header("Location: logout.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

$id = $_SESSION["id"];
$id_user = $_GET["id_user"];

$query_user = "SELECT * FROM tbl_pengguna";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$query_user = "SELECT *  FROM tbl_pengguna A
INNER JOIN tbl_user P ON A.kode_pengguna = P.kode_user
WHERE P.id_user = '$id'";

$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

if (isset($_POST["submit"])) {
    $username = htmlspecialchars($_POST["username"]);
    $kode_user = htmlspecialchars($_POST["kode_user"]);
    $nama_user = htmlspecialchars($_POST["nama_user"]);
    $jk = htmlspecialchars($_POST["jk"]);
    $email = htmlspecialchars($_POST["email"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $no_telp = htmlspecialchars($_POST["no_telp"]);
    $fotoLama = htmlspecialchars($_POST["fotoLama"]);

    if ($_FILES["foto"]["error"] === 4) {
        $file = $fotoLama;
    } else {

        $namaFile = $_FILES["foto"]["name"];
        $ukuranFile = $_FILES["foto"]["size"];
        $errorFile = $_FILES["foto"]["error"];
        $tmpName = $_FILES["foto"]["tmp_name"];

        $ekstensifileValid = ['jpg', 'jpeg', 'png'];
        $ekstensifile = explode('.', $namaFile);
        $ekstensifile = strtolower(end($ekstensifile));

        if (!in_array($ekstensifile, $ekstensifileValid)) {
            echo "<script>alert('Yang anda upload bukan file yang sesuai...!'); history.go(-1);</script>";
            return false;
        }

        if ($ukuranFile > 10000000) {
            echo "<script>alert('Ukuran file terlalu besar, Maksimal 10 MB'); history.go(-1);</script>";
            return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensifile;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        $file = $namaFileBaru;
    }


    //jalankan Query
    $query = "UPDATE tbl_user SET 
    kode_user = '$kode_user',
    nama_user = '$nama_user',
    foto = '$file',
    jk = '$jk',
    alamat = '$alamat',
    no_telp = '$no_telp',
    email = '$email'
    WHERE id_user = $id_user";
    $edit = mysqli_query($conn, $query);

    $query = "UPDATE tbl_pengguna SET 
    username = '$username'
    WHERE id = $id";
    $edit2 = mysqli_query($conn, $query);

    if ($edit && $edit2) {
        echo "<script>
            alert('Data berhasil diedit...!');
            document.location.href = 'profile-user.php?id=$id&id_user=$id_user';
        </script>";
    } else {
        echo "<script>
            alert('Data GAGAL diedit...!');
            history.go(-1);
        </script>";
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Daftar Tamu | DPMPTSP KOTA BANJARMASIN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link href="../../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/app.css" rel="stylesheet">
    <link href="../../assets/css/icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                            <h1>Ganti Password</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="password.php">Password</a></li>
                                <li class="breadcrumb-item active">Tambah Data</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!--start page wrapper -->
                <div class="page-wrapper">
                    <div class="page-content">
                        <!--breadcrumb-->
                        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                            <div class="ps-3">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0 p-0">
                                        <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!--end breadcrumb-->
                        <div class="row">
                            <div class="col-xl-12 mx-auto">
                                <h6 class="mb-0 text-uppercase">Profile</h6>
                                <hr />
                                <div class="card border-top border-0 border-4 border-primary">
                                    <div class="card-body px-5 pb-5">
                                        <div class="card-title d-flex align-items-center">
                                            <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                            </div>
                                            <h5 class="mb-0 text-primary">Profile Anda</h5>
                                        </div>
                                        <hr>
                                        <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                            <input type="hidden" name="fotoLama" value="<?= $row_user["foto"] ?>">

                                            <div class="col-12 d-flex align-items-center justify-content-center align-content-center">
                                                <img src="img/<?= $row_user["foto"] ?>" class="rounded p-1 border" width="150" alt="<?= $row_user["foto"] ?>">
                                            </div>
                                            <div class="col-4">

                                            </div>

                                            <div class=" col-4 text-center">
                                                <label for="foto" class="form-label">Ganti Foto ?</label>
                                                <input class="form-control" type="file" name="foto" id="foto">
                                                <small>File format .JPG .JPEG .PNG. dengan ukuran maksimal 1 MB</small>
                                            </div>
                                            <div class="col-4"></div>
                                            <div class="col-2"></div>
                                            <div class="col-4">
                                                <label for="nama_user" class="form-label">Nama :</label>
                                                <input type="text" class="form-control text-center" name="nama_user" id="nama_user" value="<?= $row_user["nama_user"] ?>">
                                            </div>
                                            <div class="col-4">
                                                <label for="username" class="form-label">Username :</label>
                                                <input type="text" class="form-control text-center" name="username" id="username" value="<?= $row_user["username"] ?>">
                                            </div>
                                            <div class="col-2"></div>
                                            <div class="col-2"></div>
                                            <!-- <div class="col-4">
                                                <label for="nip" class="form-label">Nomor Induk Pegawai :</label>
                                                <input type="number" class="form-control" name="nip" id="nip" value="<?= $row_user["nip"] ?>">
                                            </div> -->
                                            <div class="col-4">
                                                <label for="email" class="form-label">Email :</label>
                                                <input type="email" class="form-control" name="email" id="email" value="<?= $row_user["email"] ?>">
                                            </div>
                                            <!-- <div class="col-4"></div> -->
                                            <div class="col-2">
                                                <label for="peran" class="form-label">Status :</label>
                                                <?php if ($row_user["peran"] == "ADMIN") { ?>
                                                    <div class="">
                                                        <span class="badge bg-success">Admin</span>
                                                    </div>
                                                <?php } else if ($row_user["peran"] == "USER") { ?>
                                                    <div class="">
                                                        <span class="badge bg-danger">User</span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-2">
                                                <label for="jk" class="form-label">Jenis Kelamin :</label>
                                                <select class="form-control" name="jk" id="jk" value="<?= $row_pengguna["jk"] ?>">
                                                    <option value="1">Laki-Laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-2"></div>
                                            <div class="col-2"></div>
                                            <div class="col-4">
                                                <label for="no_telp" class="form-label">No Telp :</label>
                                                <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?= $row_user["no_telp"] ?>">
                                            </div>
                                            <div class="col-4">
                                                <label for="kode_user" class="form-label">Kode Admin :</label>
                                                <input type="text" class="form-control" name="kode_user" id="kode_user" value="<?= $row_user["kode_user"] ?>">
                                            </div>
                                            <div class="col-2"></div>
                                            <div class="col-2"></div>
                                            <div class="col-8">
                                                <label for="alamat" class="form-label">Alamat :</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $row_user["alamat"] ?>">
                                            </div>
                                            <div class="col-4"></div>
                                            <div class="col-4 mt-3">
                                                <button type="Submit" class="btn btn-primary px-5" name="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

<?php

?>