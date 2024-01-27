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

// Query untuk mendapatkan data siswa dari tabel_siswa
$querySiswa = "SELECT * FROM tbl_konsumsi A 
                LEFT JOIN tbl_pemohon B ON A.id_pemohon = B.id_pemohon
                LEFT JOIN tbl_user C ON B.kode_user = C.kode_user
                LEFT JOIN tbl_pendaftaran D ON B.id_daftar = D.id_daftar";
$resultSiswa = mysqli_query($conn, $querySiswa);

// Iid_daftarialisasi array untuk menyimpan opsi siswa
$optionsSiswa = [];

while ($rowSiswa = mysqli_fetch_assoc($resultSiswa)) {
    // Menyusun opsi siswa dalam format "id_daftar - Nama Siswa"
    $optionsSiswa[] = $rowSiswa['id_pemohon'] . ' - ' . $rowSiswa['nama_user'] . ' - ' . $rowSiswa['jumlahtamu_pemohon'] . ' - ' . $rowSiswa['tanggal_daftar'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data konsumsi | DPMPTSP KOTA BANJARMASIN</title>
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
                            <h1>Data konsumsi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="konsumsi.php">konsumsi</a></li>
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
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">

                                            <label for="id_pemohon" class="form-label">Pemohon:</label>

                                            <!-- Menggunakan elemen select untuk memilih siswa -->
                                            <select class="form-control" name="id_pemohon" id="id_pemohon" required>
                                                <?php
                                                // Menampilkan opsi siswa dalam elemen select
                                                foreach ($optionsSiswa as $option) {
                                                    // Memisahkan data id_pemohon dan jumlahtamu_pemohon
                                                    list($id_pemohon, $namaSiswa, $kodeKelas, $tanggalDaftar) = explode(' - ', $option);
                                                    echo "<option value='" . $id_pemohon . "' data-kode-kelas='" . $kodeKelas . "' ambil-tanggal ='" . $tanggalDaftar . "'>" . $namaSiswa . " - " . $kodeKelas . " - " . $tanggalDaftar . " </option>";
                                                }
                                                ?>
                                            </select>

                                            <label for="tanggal_daftar">Tanggal Daftar :</label>
                                            <input type="text" class="form-control" id="tanggal_daftar" name="tanggal_daftar" readonly>


                                            <label for="jumlah">Jumlah :</label>
                                            <!-- <input type="number" step="any" min="0"id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Tamu Yang Berkunjung" class="form-control" required autocomplete="off"> -->
                                            <input type="number" class="form-control" step="any" min="0" id="jumlahtamu_pemohon" name="jumlahtamu_pemohon" readonly>

                                            <label for="konsumsi">Konsumsi :</label>
                                            <input type="text" class="form-control" id="konsumsi" name="makanan_konsumsi" required autocomplete="off">

                                            <label for="harga">Harga :</label>
                                            <input type="number" step="any" min="0" id="harga" name="harga_konsumsi" placeholder="Masukkan Harga Per Pcs" class="form-control" required autocomplete="off">

                                            <label for="total">Total :</label>
                                            <input type="text" class="form-control" step="any" min="0" id="total" name="total_konsumsi" value="0" readonly required autocomplete="off">
                                        </div>
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

    <!-- Skrip JavaScript -->
    <script>
        document.getElementById('id_pemohon').addEventListener('change', function() {
            // Dapatkan nilai id_pemohon dan jumlahtamu_pemohon dari opsi yang dipilih
            var selectedOption = this.options[this.selectedIndex];
            var id_pemohon = selectedOption.value;
            var kodeKelas = selectedOption.getAttribute('data-kode-kelas');
            var ambilTanggal = selectedOption.getAttribute('ambil-tanggal');

            // Perbarui nilai pada elemen input jumlahtamu_pemohon
            document.getElementById('jumlahtamu_pemohon').value = kodeKelas;
            document.getElementById('tanggal_daftar').value = ambilTanggal;
        });
    </script>

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
<?php


//query tampilan data Konsumsi
if (isset($_POST["submit"])) {
    $id_pemohon = htmlspecialchars($_POST["id_pemohon"]);
    // $tanggalDaftar = htmlspecialchars($_POST["tanggal_daftar"]);
    // $kodeKelas = htmlspecialchars($_POST["jumlahtamu_pemohon"]);
    $makanan_konsumsi = htmlspecialchars($_POST["makanan_konsumsi"]);
    $harga_konsumsi = htmlspecialchars($_POST["harga_konsumsi"]);
    // $total = htmlspecialchars($_POST["total"]);
    $total_konsumsi = htmlspecialchars($_POST["total_konsumsi"]);

    $query = "INSERT INTO tbl_konsumsi (id_konsumsi, id_pemohon, makanan_konsumsi, harga_konsumsi,total_konsumsi) VALUES ('','$id_pemohon', '$makanan_konsumsi', '$harga_konsumsi', '$total_konsumsi')";

    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
            alert('Data berhasil disimpan...!');
            document.location.href = 'konsumsi.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Data gagal disimpan...!');
            document.location.href = 'konsumsi-tambah.php';
            </script>";
    }
}
?>