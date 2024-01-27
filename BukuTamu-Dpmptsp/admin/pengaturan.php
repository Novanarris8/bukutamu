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

if (isset($_POST['filter'])) {
    $date = date('Y-m-d', strtotime($_POST['bulan']));
    $query = "SELECT * FROM konsumsi WHERE tanggal='$date'";
} else {
    $query = "SELECT * FROM konsumsi";
}
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Konsumsi | DPMPTSP KOTA BANJARMASIN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                                <li class="breadcrumb-item active">konsumsi</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="konsumsi-tambah.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                                    <!-- <a href="konsumsi-cetak.php" class="btn btn-success"><i class="fa fa-print"></i> Cetak Data</a> -->
                                    <!-- <form method="post">
                    <label for="tanggal">Pilih Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal">

                        <button type="submit">Filter</button>
                </form> -->
                                    <!-- <?php
                                            // Cek apakah form telah disubmit
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                // Ambil nilai tanggal dari form
                                                $selectedtanggal = $_POST["tanggal"];

                                                // Query untuk mengambil data dari database berdasarkan tanggal
                                                $kueri_tanggal = "SELECT * FROM konsumsi WHERE tanggal = '$selectedtanggal'";
                                                $result = $conn->query($kueri_tanggal);

                                                // Tampilkan hasil cetak
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<p>Informasi untuk tanggal $selectedtanggal:</p>";
                                                        echo "<p>{$row['tanggal']},{$row['nama_instansi']}</p>";
                                                    }
                                                } else {
                                                    echo "<p>Tidak ada data untuk tanggal $selectedtanggal</p>";
                                                }
                                            }
                                            ?>
                    </div> -->
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="bulan">Bulan:</label><br>
                                                <input class="form-control" type="date" name="bulan" id="bulan" style="width: 250px;">
                                            </div>
                                            <div class="">
                                                <button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
                                                <a href="konsumsi.php" class="btn btn-info"><i class="fa fa-sync"></i> Refresh</a>
                                            </div>
                                        </form>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Instansi</th>
                                                    <th>Nama Tamu</th>
                                                    <th>Jumlah Tamu</th>
                                                    <th>Konsumsi</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $row["tanggal"]; ?></td>
                                                        <td><?php echo $row["nama_instansi"]; ?></td>
                                                        <td><?php echo $row["nama_tamu"]; ?></td>
                                                        <td><?php echo $row["jumlah"]; ?> Orang </td>
                                                        <td><?php echo $row["konsumsi"]; ?></td>
                                                        <td class="text-right"><?php echo 'Rp. ' . number_format($row["harga"], 0, '.', ',') . ',-'; ?></td>
                                                        <td class="text-right"><?php echo 'Rp. ' . number_format($row["total"], 0, '.', ',') . ',-'; ?></td>

                                                        <td>
                                                            <a href="konsumsi-edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit">Ubah</i></a>
                                                            <a href="konsumsi-hapus.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs text-light" onClick="return confirm('Anda yakin ingin menghapus?')"><i class="fa fa-trash"></i> Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
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
                // "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pagingType": "simple_numbers",
                "pageLength": 5,
            });
        });
    </script>
</body>

</html>