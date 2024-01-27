<?php
session_start();

include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Default values jika belum ada form submission atau nilai tidak diatur
    $tanggal_menunggu_dari = isset($_POST["tanggal_menunggu_dari"]) ? $_POST["tanggal_menunggu_dari"] : "";
    $tanggal_menunggu_sampai = isset($_POST["tanggal_menunggu_sampai"]) ? $_POST["tanggal_menunggu_sampai"] : "";

    // Gunakan nilai tanggal dan kode kelas untuk memfilter data
    if (!empty($tanggal_menunggu_dari) && !empty($tanggal_menunggu_sampai)) {
        $queryMemanggil = "SELECT * FROM tbl_pemohon 
                                                    LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                                    LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                                    LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                                    WHERE tbl_pemohon.status_pemohon='Menunggu'";
        $result_menunggu = mysqli_query($conn, $queryMemanggil);

        // Cek apakah query menghasilkan data
        if (!$result_menunggu) {
            die("Query error: " . mysqli_error($conn));
        }
    } else {
        // Jika tanggal atau kode kelas tidak diatur, mungkin tampilkan pesan atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
        echo "Tanggal laporan menunggu belum diatur.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pemohon Menunggu</title>
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
                            <h1>Laporan Pemohon Menunggu DPMPTSP</h1>
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
                    <form method="post" action="">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="tanggal_menunggu_dari">From Date : </label>
                                <input type="date" name="tanggal_menunggu_dari" id="tanggal_menunggu_dari">

                                <label for="tanggal_menunggu_sampai"> To Date : </label>
                                <input type="date" name="tanggal_menunggu_sampai" id="tanggal_menunggu_sampai">
                            </div>
                            <div class="btn-group">
                                <button type="submit" name="tampilkan" class="btn btn-warning mr-2"><i class="fas fa-filter"></i> Filter</button>
                                <a href="laporan-menunggu.php" class="btn btn-secondary mr-2" style="text-decoration: none;"><i class="fas fa-undo"></i> Reset</a>
                                <button type="button" class="btn btn-primary" onclick="printmenunggu()">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-hover table-bordered" id="laporanTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Asal Instansi</th>
                                <th>Nama Tamu</th>
                                <th>Jumlah Tamu</th>
                                <th>No Handphone</th>
                                <th>Perihal Kunjungan</th>
                                <th>Surat Permohonan</th>
                                <th>Status Permohonan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Gunakan nilai tanggal dan kode kelas untuk memfilter data
                            if (!empty($tanggal_menunggu_dari) && !empty($tanggal_menunggu_sampai)) {
                                $queryMemanggil = "SELECT * FROM tbl_pemohon 
                                                    LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                                    LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                                    LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                                    WHERE tbl_pendaftaran.tanggal_daftar >= '$tanggal_menunggu_dari' AND tbl_pendaftaran.tanggal_daftar <= '$tanggal_menunggu_sampai'
                                                    AND tbl_pemohon.status_pemohon = 'Menunggu'
                                                   ";
                            } else {
                                // Jika tanggal atau kode kelas tidak diatur, mungkin tampilkan pesan atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
                                $queryMemanggil = "SELECT * FROM tbl_pemohon 
                                                    LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                                    LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                                    LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                                    WHERE tbl_pemohon.status_pemohon = 'Menunggu'
                                                   ";
                            }
                            $result_menunggu = mysqli_query($conn, $queryMemanggil);
                            while ($row_menunggu = mysqli_fetch_assoc($result_menunggu)) { ?>
                                <tr>
                                    <td><?php echo $row_menunggu['nama_pegawai']; ?> </td>
                                    <td><?php echo $row_menunggu['tanggal_daftar']; ?> </td>
                                    <td><?php echo $row_menunggu['jam_daftar']; ?> </td>
                                    <td><?php echo $row_menunggu['asal_pemohon']; ?> </td>
                                    <td><?php echo $row_menunggu['namarekan_pemohon']; ?> </td>
                                    <td><?php echo $row_menunggu['jumlahtamu_pemohon']; ?> Orang</td>
                                    <td><?php echo $row_menunggu['no_telp']; ?> </td>
                                    <td><?php echo $row_menunggu['perihal_pemohon']; ?> </td>
                                    <td><?php echo $row_menunggu['surat_pemohon']; ?> </td>
                                    <td><?php echo $row_menunggu['status_pemohon']; ?> </td>
                                </tr>
                            <?php } // Cek apakah query menghasilkan data
                            if (!$result_menunggu) {
                                die("Query error: " . mysqli_error($conn));
                            } else {
                                // Jika tanggal tidak diatur, mungkin tampilkan pesan atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
                                // echo "<div class='alert alert-warning'> Kelas dan Tanggal belum diatur. </div> ";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </main>

        <?php include "theme-footer.php" ?>

    </div>
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

    <script>
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
    </script>
</body>

</html>