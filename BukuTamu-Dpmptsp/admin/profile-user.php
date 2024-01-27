<?php
include "../koneksi.php";
session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

$id = $_SESSION["id"];

$query_user = "SELECT * FROM tbl_pengguna WHERE id = $id";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$query_admin = "SELECT *  FROM tbl_pengguna A
INNER JOIN tbl_admin P ON A.kode_pengguna = P.kode_admin
WHERE P.id_admin = '$id'";
$result_admin = mysqli_query($conn, $query_admin);
$row_admin = mysqli_fetch_assoc($result_admin);

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
                                            <div class="col-12 d-flex">
                                                <img src="img/<?= $row_admin["foto"] ?>" class="rounded p-1 border" width="150" alt="<?= $row_admin["foto"] ?>">
                                            </div>
                                            <div class="col-4">
                                                <label for="nama_admin" class="form-label">Nama :</label>
                                                <input type="text" class="form-control text-center" name="nama_admin" id="nama_admin" value="<?= $row_admin["nama_admin"] ?>" readonly>
                                            </div>
                                            <div class="col-4">
                                                <label for="username" class="form-label">Username :</label>
                                                <input type="text" class="form-control text-center" name="username" id="username" value="<?= $row_admin["username"] ?>" readonly>
                                            </div>
                                            <div class="col-4">

                                            </div>
                                            <div class="col-4">
                                                <label for="nip" class="form-label">Nomor Induk Pegawai :</label>
                                                <input type="number" class="form-control" name="nip" id="nip" value="<?= $row_admin["nip"] ?>" readonly>
                                            </div>
                                            <div class="col-4">
                                                <label for="email" class="form-label">Email :</label>
                                                <input type="email" class="form-control" name="email" id="email" value="<?= $row_admin["email"] ?>" readonly>
                                            </div>
                                            <div class="col-4"></div>
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
                                            <div class="col-4">
                                                <label for="kode_admin" class="form-label">Kode Admin :</label>
                                                <input type="text" class="form-control" name="kode_admin" id="kode_admin" value="<?= $row_admin["kode_admin"] ?>" readonly>
                                            </div>
                                            <div class="col-2">
                                                <label for="jk" class="form-label">Jenis Kelamin :</label>
                                                <?php
                                                if ($row_admin["jk"] == 1) { ?>
                                                    <div class="">
                                                        <span class="badge bg-primary">Laki - Laki</span>
                                                    </div>
                                                <?php } else if ($row_admin["jk"] == 2) { ?>
                                                    <div class="">
                                                        <span class="badge bg-warning">Perempuan</span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-8">
                                                <label for="alamat" class="form-label">Alamat :</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $row_admin["alamat"] ?>" readonly>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <a href="profile-edit.php?id=<?= $row_admin["id"] ?>&id_admin=<?= $row_admin["id_admin"] ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Edit Profile</a>
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
if (isset($_POST["submit"])) {

    $password = htmlspecialchars($_POST["passwordLama"]);

    if (password_verify($password, $row_user["password"])) {

        $password1 = mysqli_real_escape_string($conn, $_POST["password"]);
        $password2 = mysqli_real_escape_string($conn, $_POST["konfirmasiPassword"]);

        if ($password1 !== $password2) {
?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ubah Password Gagal, Konfirmasi Password tidak cocok!',
                    onClose: () => {
                        history.go(-1);
                    }
                });
            </script>
        <?php
            return false;
        } else {

            $password1 = password_hash($password1, PASSWORD_DEFAULT);
            $query = "UPDATE pengguna SET password = '$password1' WHERE id = '$id'";
            $edit = mysqli_query($conn, $query);
        }
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ubah Password Gagal, Password Lama tidak cocok!',
                onClose: () => {
                    history.go(-1);
                }
            });
        </script>
    <?php
        return false;
    }

    if ($edit) {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Password Berhasil diganti, anda harus Login kembali...',
            }).then(() => {
                window.location.href = 'logout.php';
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data GAGAL disimpan!',
                onClose: () => {
                    history.go(-1);
                }
            });
        </script>
<?php
    }
}
?>