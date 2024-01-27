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

$query_admin = "SELECT *  FROM tbl_admin A
INNER JOIN tbl_pengguna P ON A.kode_admin = P.kode_pengguna
WHERE P.id = '$id'";
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <h6 class="mb-0 text-uppercase">Password</h6>
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
                                        <input type="hidden" name="fotoLama" value="<?= $row_admin["foto"] ?>">
                                        <div class="d-flex align-items-center justify-content-center align-content-center">
                                            <img src="img/<?= $row_admin["foto"] ?>" class="rounded p-1 border" width="150" alt="<?= $row_admin["foto"] ?>">
                                        </div>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username :</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $row_admin["username"] ?>" placeholder="Username satu kata saja dan huruf kecil" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="nama_admin" class="form-label">Nama :</label>
                                            <input type="text" class="form-control" name="nama_admin" id="nama_admin" value="<?= $row_admin["nama_admin"] ?>" placeholder="Nama lengkap dengan gelar" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="passwordLama" class="form-label">Password Lama :</label>
                                            <input type="password" class="form-control" name="passwordLama" id="passwordLama" required autofocus>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password Baru :</label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="konfirmasiPassword" class="form-label">Ulangi Password Baru :</label>
                                            <input type="password" class="form-control" name="konfirmasiPassword" id="konfirmasiPassword" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-3 px-5" name="submit">Simpan</button>
                                            <button type="button" class="btn btn-secondary mt-3 px-5" onclick="self.history.back()">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
            $query = "UPDATE tbl_pengguna SET password = '$password1' WHERE id = '$id'";
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