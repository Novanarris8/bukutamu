<?php
session_start();

include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Default values jika belum ada form submission atau nilai tidak diatur
    $tanggal_terima_dari = isset($_POST["tanggal_terima_dari"]) ? $_POST["tanggal_terima_dari"] : "";
    $tanggal_terima_sampai = isset($_POST["tanggal_terima_sampai"]) ? $_POST["tanggal_terima_sampai"] : "";

    // Gunakan nilai tanggal dan kode kelas untuk memfilter data
    if (!empty($tanggal_terima_dari) && !empty($tanggal_terima_sampai)) {
        $queryMemanggil = "SELECT * FROM tbl_pemohon 
                                                    LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                                    LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                                    LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                                    WHERE tbl_pemohon.status_pemohon='Di Verifikasi'";
        $result_terima = mysqli_query($conn, $queryMemanggil);

        // Cek apakah query menghasilkan data
        if (!$result_terima) {
            die("Query error: " . mysqli_error($conn));
        }
    } else {
        // Jika tanggal atau kode kelas tidak diatur, mungkin tampilkan pesan atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
        echo "Tanggal laporan terima belum diatur.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pemohon Terima</title>
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
                            <h1>Laporan Pemohon Terima DPMPTSP</h1>
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
                                <label for="tanggal_terima_dari">From Date : </label>
                                <input type="date" name="tanggal_terima_dari" id="tanggal_terima_dari">

                                <label for="tanggal_terima_sampai"> To Date : </label>
                                <input type="date" name="tanggal_terima_sampai" id="tanggal_terima_sampai">
                            </div>
                            <div class="btn-group">
                                <button type="submit" name="tampilkan" class="btn btn-warning mr-2"><i class="fas fa-filter"></i> Filter</button>
                                <a href="laporan-terima.php" class="btn btn-secondary mr-2" style="text-decoration: none;"><i class="fas fa-undo"></i> Reset</a>
                                <button type="button" class="btn btn-primary" onclick="printterima()">
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
                            if (!empty($tanggal_terima_dari) && !empty($tanggal_terima_sampai)) {
                                $queryMemanggil = "SELECT * FROM tbl_pemohon 
                                                    LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                                    LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                                    LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                                    WHERE tbl_pendaftaran.tanggal_daftar >= '$tanggal_terima_dari' AND tbl_pendaftaran.tanggal_daftar <= '$tanggal_terima_sampai'
    AND tbl_pemohon.status_pemohon = 'Di Verifikasi'
                                                   ";
                            } else {
                                // Jika tanggal atau kode kelas tidak diatur, mungkin tampilkan pesan atau lakukan sesuatu yang sesuai dengan kebutuhan Anda
                                $queryMemanggil = "SELECT * FROM tbl_pemohon 
                                                    LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                                    LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                                    LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                                    WHERE tbl_pemohon.status_pemohon = 'Di Verifikasi'
                                                   ";
                            }
                            $result_terima = mysqli_query($conn, $queryMemanggil);
                            while ($row_terima = mysqli_fetch_assoc($result_terima)) { ?>
                                <tr>
                                    <td><?php echo $row_terima['nama_pegawai']; ?> </td>
                                    <td><?php echo $row_terima['tanggal_daftar']; ?> </td>
                                    <td><?php echo $row_terima['jam_daftar']; ?> </td>
                                    <td><?php echo $row_terima['asal_pemohon']; ?> </td>
                                    <td><?php echo $row_terima['namarekan_pemohon']; ?> </td>
                                    <td><?php echo $row_terima['jumlahtamu_pemohon']; ?> Orang</td>
                                    <td><?php echo $row_terima['no_telp']; ?> </td>
                                    <td><?php echo $row_terima['perihal_pemohon']; ?> </td>
                                    <td><?php echo $row_terima['surat_pemohon']; ?> </td>
                                    <td><?php echo $row_terima['status_pemohon']; ?> </td>
                                </tr>
                            <?php } // Cek apakah query menghasilkan data
                            if (!$result_terima) {
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
        function printterima() {
            var tanggal_terima_dari = '<?php echo isset($tanggal_terima_dari) ? $tanggal_terima_dari : ""; ?>';
            var tanggal_terima_sampai = '<?php echo isset($tanggal_terima_sampai) ? $tanggal_terima_sampai : ""; ?>';

            var url = 'cetak-terima.php?print=true';

            if (tanggal_terima_dari !== "") {
                url += '&tanggal_terima_dari=' + tanggal_terima_dari;
            }

            if (tanggal_terima_sampai !== "") {
                url += '&tanggal_terima_sampai=' + tanggal_terima_sampai;
            }

            window.open(url, '_blank');
        }
    </script>
</body>

</html>