<?php
include "untuk-sesi.php";

$query_pemohon = "SELECT COUNT(*) AS jumlah_pemohon FROM tbl_pemohon";
$result_pemohon = mysqli_query($conn, $query_pemohon);
$row_pemohon = mysqli_fetch_assoc($result_pemohon);
$jumlah_pemohon = $row_pemohon['jumlah_pemohon'];

$query_pemohon1 = "SELECT COUNT(*) AS jumlah_pemohon FROM tbl_pemohon WHERE status_pemohon='Di Verifikasi'";
$result_pemohon1 = mysqli_query($conn, $query_pemohon1);
$row_pemohon1 = mysqli_fetch_assoc($result_pemohon1);
$jumlah_pemohon1 = $row_pemohon1['jumlah_pemohon'];

// $queryMemanggil = "SELECT * FROM tbl_pemohon 
// LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
// LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
// LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
// WHERE tbl_pemohon.status_pemohon='Di Verifikasi'";
// $resultMemanggil = mysqli_query($conn, $queryMemanggil);


$query_pegawai = "SELECT COUNT(*) AS jumlah_pegawai FROM tbl_pegawai";
$result_pegawai = mysqli_query($conn, $query_pegawai);
$row_pegawai = mysqli_fetch_assoc($result_pegawai);
$jumlah_pegawai = $row_pegawai['jumlah_pegawai'];

// $query_tamu = "SELECT COUNT(*) AS jumlah_tamu FROM tamu";
// $result_tamu = mysqli_query($conn, $query_tamu);
// $row_tamu = mysqli_fetch_assoc($result_tamu);
// $jumlah_tamu = $row_tamu['jumlah_tamu'];

//query tampilan data mahasiswa
// $query = "SELECT * FROM mahasiswa";
// $result = mysqli_query($conn, $query);

$id = $_SESSION["id"];
$query_user = "SELECT * FROM tbl_pengguna WHERE id = $id";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Admin | BUKU TAMU DPMPTSP </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/chart.js/Chart.bundle.min.js">
    <link rel="stylesheet" href="../plugins/chart.js/Chart.bundle.js">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../tema/dark-theme.css" />
    <link rel="stylesheet" href="../tema/semi-dark.css" />
    <link rel="stylesheet" href="../tema/header-colors.css" />

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

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                                <li class="breadcrumb-item active">Home</li>
                            </ol>
                        </div>
                    </div>
                    <marquee>
                        <h1>Selamat Datang Di Aplikasi Buku Tamu</h1>
                    </marquee>
                </div><!-- /.container-fluid -->
                <!-- Main content -->
                <section class="content">
                    <style>
                        .bg-info {
                            background: linear-gradient(to right, #3498db, #ffc0cb);
                            /* Change the color codes as needed */
                            color: #fff;
                            /* Set text color to white or another contrasting color */
                        }

                        .bg-success {
                            background: linear-gradient(to right, #3498db, #ff66b2);
                            /* Change the color codes as needed */
                            color: #fff;
                            /* Set text color to white or another contrasting color */
                        }

                        .bg-warning {
                            background: linear-gradient(to right, #3498db, #ff6b81);
                            /* Change the color codes as needed */
                            color: #fff;
                            /* Set text color to white or another contrasting color */
                        }
                    </style>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?php echo $jumlah_pegawai; ?></h3>
                                        <p>Pegawai</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <a href="pegawai.php" class="small-box-footer">
                                        More info<i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?php echo $jumlah_pemohon; ?></h3>
                                        <p>Pemohon</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <a href="pemohon.php" class="small-box-footer">
                                        More info<i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?php echo $jumlah_pemohon1; ?></h3>
                                        <p>Tamu</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <a href="tamu.php" class="small-box-footer">
                                        More info<i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">

                                        <div class="col-lg-6 col-6">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">KONSUMSI</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>

                                        <!-- ./col -->
                                        <div class="col-lg-6 col-6">
                                            <!-- small card -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">STATUS</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- ./col -->
                                        </div>
                                    </div>
                                    <!-- /.container-fluid -->
                            </section>


                        </div>

                    </div>
                    <!-- /.container-fluid -->
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

    <?php
    $dataPoints = array();
    $dataPoints2 = array();

    $result = $conn->query("SELECT * FROM tbl_konsumsi");
    $result2 = $conn->query("SELECT COUNT(status_pemohon) as status2, status_pemohon FROM tbl_pemohon GROUP BY status_pemohon");

    while ($row = $result->fetch_assoc()) {
        $dataPoints[] = $row;
    }

    while ($row2 = $result2->fetch_assoc()) {
        $dataPoints2[] = $row2;
    }
    $conn->close();
    ?>

    <script>
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $("#donutChart").get(0).getContext("2d");
        var donutData = {
            labels: <?php echo json_encode(array_column($dataPoints, 'tbl_konsumsi')); ?>,
            datasets: [{
                data: <?php echo json_encode(array_column($dataPoints, 'total_konsumsi')); ?>,
                backgroundColor: [
                    "#f56954",
                    "#00a65a",
                    "#f39c12",
                    "#00c0ef",
                    "#3c8dbc",
                    "#d2d6de",
                ],
            }, ],
        };
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: "doughnut",
            data: donutData,
            options: donutOptions,
        });
    </script>

    <script>
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $("#donutChart2").get(0).getContext("2d");
        var donutData = {
            labels: <?php echo json_encode(array_column($dataPoints2, 'status_permohonan')); ?>,
            datasets: [{
                data: <?php echo json_encode(array_column($dataPoints2, 'status2')); ?>,
                backgroundColor: [
                    "grey",
                    "blue",
                    "red",
                    "#00c0ef",
                    "#3c8dbc",
                    "#d2d6de",
                ],
            }, ],
        };
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: "doughnut",
            data: donutData,
            options: donutOptions,
        });
    </script>

</body>

</html>