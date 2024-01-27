<?php
session_start();

include '../koneksi.php';

// Initialize filter variables
$tanggal_konsumsi_dari = '';
$tanggal_konsumsi_sampai = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Inisialisasi filter
    $tanggal_konsumsi_dari = isset($_GET['tanggal_konsumsi_dari']) ? $_GET['tanggal_konsumsi_dari'] : '';
    $tanggal_konsumsi_sampai = isset($_GET['tanggal_konsumsi_sampai']) ? $_GET['tanggal_konsumsi_sampai'] : '';
}

// Query untuk mengambil data pengaduan dengan filter
$query = "SELECT *
FROM tbl_konsumsi
INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user";

// Filter tanggal Konsumsi
if ($tanggal_konsumsi_dari != '' && $tanggal_konsumsi_sampai != '') {

    $query .= " WHERE tbl_pendaftaran.tanggal_daftar BETWEEN ? AND ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die('Error in preparing the statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ss", $tanggal_konsumsi_dari, $tanggal_konsumsi_sampai);
    mysqli_stmt_execute($stmt);

    $result_konsumsi = mysqli_stmt_get_result($stmt);

    if (!$result_konsumsi) {
        die('Error in getting result: ' . mysqli_error($conn));
    }
} else {
    // Execute the query without the date range condition
    $result_konsumsi = mysqli_query($conn, $query);

    if (!$result_konsumsi) {
        die('Error in getting result: ' . mysqli_error($conn));
    }
}

$hitung = mysqli_query($conn, "SELECT * FROM tbl_konsumsi
INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user WHERE tbl_pendaftaran.tanggal_daftar between '$tanggal_konsumsi_dari' and '$tanggal_konsumsi_sampai'");
$jumlah = []; // Initialize an array to store 'total' values

while ($data = mysqli_fetch_array($hitung)) {
    $jumlah[] = $data['total_konsumsi'];
}
$jumlah_barang = array_sum($jumlah);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Konsumsi</title>
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
                            <h1>Laporan Konsumsi DPMPTSP</h1>
                            <h1>Kota Banjarmasin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Laporan Konsumsi</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="card mb-4">
                <div class="card-header">
                    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="tanggal_konsumsi_dari">From Date : </label>
                                <input type="date" name="tanggal_konsumsi_dari" id="tanggal_konsumsi_dari" value="<?php echo $tanggal_konsumsi_dari; ?>">

                                <label for="tanggal_konsumsi_sampai"> To Date : </label>
                                <input type="date" name="tanggal_konsumsi_sampai" id="tanggal_konsumsi_sampai" value="<?php echo $tanggal_konsumsi_sampai; ?>">
                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-warning mr-2"><i class="fas fa-filter"></i> Filter
                                </button>

                                <a href="laporan-konsumsi.php" class="btn btn-secondary mr-2" style="text-decoration: none;">
                                    <i class="fas fa-undo"></i> Reset
                                </a>

                                <button type="button" class="btn btn-primary" onclick="printKonsumsi()">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                    </form>
                </div>


                <table class="table table-hover table-bordered" id="laporanTable">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Jumlah Tamu</th>
                            <th>Konsumsi</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Gunakan nilai tanggal dan kode kelas untuk memfilter data
                        if (!empty($tanggal_konsumsi_dari) && !empty($tanggal_konsumsi_sampai)) {
                            $queryMemanggil = " SELECT * FROM tbl_konsumsi
                                                INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
                                                INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
                                                INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user WHERE tbl_pendaftaran.tanggal_daftar >= '$tanggal_konsumsi_dari' and tbl_pendaftaran.tanggal_daftar <= '$tanggal_konsumsi_sampai'";
                        } else {
                            // Jika tanggal atau kode kelas tidak diatur, mungkin tampilkan pesan atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
                            $queryMemanggil = "SELECT * FROM tbl_konsumsi
                            INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
                            INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
                            INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user";

                            $hitung = mysqli_query($conn, "SELECT * FROM tbl_konsumsi
                            INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
                            INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
                            INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user");
                            $jumlah = []; // Initialize an array to store 'total' values

                            while ($data = mysqli_fetch_array($hitung)) {
                                $jumlah[] = $data['total_konsumsi'];
                            }
                            $jumlah_barang = array_sum($jumlah);
                        }
                        $result_konsumsi = mysqli_query($conn, $queryMemanggil);
                        while ($row_konsumsi = mysqli_fetch_assoc($result_konsumsi)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row_konsumsi["tanggal_daftar"]); ?></td>
                                <td><?php echo htmlspecialchars($row_konsumsi["nama_user"]); ?></td>
                                <td><?php echo htmlspecialchars($row_konsumsi["jumlahtamu_pemohon"]); ?> Orang</td>
                                <td><?php echo htmlspecialchars($row_konsumsi["makanan_konsumsi"]); ?></td>
                                <td>Rp. <?php echo htmlspecialchars($row_konsumsi["harga_konsumsi"]); ?> </td>
                                <td>Rp. <?php echo htmlspecialchars($row_konsumsi["total_konsumsi"]); ?>
                                </td>
                            </tr>

                        <?php } ?>
                        <!-- Summary Row -->
                        <tr>
                            <td colspan="5" class="text-center">Jumlah</td>
                            <td class="text-left"><?= 'Rp. ' . number_format($jumlah_barang); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "theme-footer.php" ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>

    <!-- File Export Data Table -->
    <script src="../js/file-export/jquery-3.7.0.js"></script>
    <script src="../js/file-export/jquery.dataTables.min.js"></script>
    <script src="../js/file-export/dataTables.buttons.min.js"></script>
    <script src="../js/file-export/jszip.min.js"></script>
    <script src="../js/file-export/pdfmake.min.js"></script>
    <script src="../js/file-export/vfs_fonts.js"></script>
    <script src="../js/file-export/buttons.html5.min.js"></script>
    <script src="../js/file-export/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [
                    [1, 'asc']
                ],
                pageLength: 20
            });
        });
    </script>
    <!-- <script>
        function printKonsumsi() {
            var url = 'cetak-konsumsi.php?print=true&tanggal_konsumsi_dari=<?php echo $tanggal_konsumsi_dari; ?>&tanggal_konsumsi_sampai=<?php echo $tanggal_konsumsi_sampai; ?>';
            window.location.href = url;
        }
    </script> -->
    <script>
        function printKonsumsi() {
            var tanggal_konsumsi_dari = '<?php echo isset($tanggal_konsumsi_dari) ? $tanggal_konsumsi_dari : ""; ?>';
            var tanggal_konsumsi_sampai = '<?php echo isset($tanggal_konsumsi_sampai) ? $tanggal_konsumsi_sampai : ""; ?>';

            var url = 'cetak-konsumsi.php?print=true';

            if (tanggal_konsumsi_dari !== "") {
                url += '&tanggal_konsumsi_dari=' + tanggal_konsumsi_dari;
            }

            if (tanggal_konsumsi_sampai !== "") {
                url += '&tanggal_konsumsi_sampai=' + tanggal_konsumsi_sampai;
            }

            window.open(url, '_blank');
        }
    </script>
    <!-- <script>
        function printmenunggu() {
            var tanggal_menunggu_dari = '<?php echo isset($tanggal_menunggu_dari) ? $tanggal_menunggu_dari : ""; ?>';
            var tanggal_menunggu_sampai = '<?php echo isset($tanggal_menunggu_sampai) ? $tanggal_menunggu_sampai : ""; ?>';

            var url = 'cetak-menunggu.php?print=true';

            if (tanggal_menunggu_dari !== "") {
                url += '&tanggal_menunggu_dari=' + tanggal_menunggu_dari;
            }

            if (tanggal_menunggu_sampai !== "") {
                url += '&tanggal_menunggu_sampai=' + tanggal_menunggu_sampai;
            }

            window.open(url, '_blank');
        }
    </script> -->
</body>

</html>