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

if (isset($_POST["submit"])) {

    $id_pegawai = htmlspecialchars($_POST["id_pegawai"]);
    $tanggal = htmlspecialchars($_POST["tanggal"]);
    $jam = htmlspecialchars($_POST["jam"]);
    $asal_instansi = htmlspecialchars($_POST["asal_instansi"]);
    $nama_tamu = htmlspecialchars($_POST["nama_tamu"]);
    $jumlah_tamu = htmlspecialchars($_POST["jumlah_tamu"]);
    $no_hp = htmlspecialchars($_POST["no_hp"]);
    $perihal_kunjungan = htmlspecialchars($_POST["perihal_kunjungan"]);
    // $surat_permohonan = htmlspecialchars($_POST["surat_permohonan"]);
    $status_permohonan = htmlspecialchars($_POST["status_permohonan"]);
    $alasan = htmlspecialchars($_POST["alasan"]);
    $surat_permohonan = $_FILES["surat_permohonan"]["name"];

    move_uploaded_file($_FILES['surat_permohonan']['tmp_name'], '../assets/files/' . $surat_permohonan);


    $query = "INSERT INTO pemohon VALUES ('', '$id_pegawai', '$tanggal', '$jam', '$asal_instansi', '$nama_tamu', '$jumlah_tamu', '$no_hp', '$perihal_kunjungan', '$surat_permohonan', '$status_permohonan', '$alasan')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
            alert('Data berhasil disimpan...!');
            document.location.href = 'pemohon.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Data gagal disimpan...!');
            document.location.href = 'pemohon-tambah.php';
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
                            <h1>Daftar Pemohon</h1>
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
                                                <label for="id_pegawai">Nama Pegawai</label>
                                                <select class="form-control" id="id_pegawai" name="id_pegawai" required>
                                                    <option value="">-- Pilih Nama Pegawai --</option>
                                                    <?php
                                                    $query_pegawai = "SELECT * FROM pegawai";
                                                    $result_pegawai = mysqli_query($conn, $query_pegawai);
                                                    while ($row_pegawai = mysqli_fetch_assoc($result_pegawai)) {
                                                    ?>
                                                        <option value="<?php echo $row_pegawai["id_pegawai"]; ?>"><?php echo $row_pegawai["nama_pegawai"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal :</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Nama pemohon/Bidang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jam">Jam :</label>
                                                <input type="time" class="form-control" id="jam" name="jam" placeholder="Nama pemohon/Bidang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="asal_instansi">Asal Instansi :</label>
                                                <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" placeholder="Masukkan Asal Instansi Anda" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_tamu">Nama Tamu :</label>
                                                <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" placeholder="Masukkan Nam Lengkap Anda" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_tamu">Jumlah Tamu :</label>
                                                <input type="text" class="form-control" id="jumlah_tamu" name="jumlah_tamu" placeholder="Masukkan Jumlah Tamu yang akan datang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp">No Handphone :</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No Handphone Yang Aktif" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="perihal_kunjungan">Perihal Kunjungan :</label>
                                                <input type="text" class="form-control" id="perihal_kunjungan" name="perihal_kunjungan" placeholder="Masukkan Perihal Kunjungan datang ke Instansi" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="surat_permohonan">Surat Permohonan :</label>
                                                <input type="file" class="form-control" id="surat_permohonan" name="surat_permohonan" required>
                                            </div>
                                            <div class="form-group">
                                                <!-- <label for="status_permohonan">Status Permohonan :</label> -->
                                                <input type="hidden" class="form-control" id="status_permohonan" name="status_permohonan" value="Menunggu"> 
                                            </div>
                                            <div class="form-group">
                                                <!-- <label for="alasan">Alasan :</label> -->
                                                <input type="hidden" class="form-control" id="alasan" name="alasan" value="-">
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary mr-1">Simpan</button>
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