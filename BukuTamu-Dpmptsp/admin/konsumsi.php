<?php
include "untuk-sesi.php";

$query = "SELECT * FROM tbl_konsumsi K 
            LEFT JOIN tbl_pemohon P ON K.id_pemohon = P.id_pemohon
            LEFT JOIN tbl_pendaftaran D ON P.id_daftar = D.id_daftar
            LEFT JOIN tbl_user U ON P.kode_user = U.kode_user";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Konsumsi | DPMPTSP KOTA BANJARMASIN</title>
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
                            <h1>Data Konsumsi DPMPTSP</h1>
                            <h1>Kota Banjarmasin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Konsumsi</li>
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
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Tamu</th>
                                                <th>Jumlah Tamu</th>
                                                <th>Konsumsi</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $hitung = mysqli_query($conn, "SELECT * FROM tbl_konsumsi K 
                                                        LEFT JOIN tbl_pemohon P ON K.id_pemohon = P.id_pemohon
                                                        LEFT JOIN tbl_pendaftaran D ON P.id_daftar = D.id_daftar
                                                        LEFT JOIN tbl_user U ON P.kode_user = U.kode_user");
                                            $jumlah = []; // Initialize an array to store 'total' values

                                            while ($data = mysqli_fetch_array($hitung)) {
                                                $jumlah[] = $data['total_konsumsi'];
                                            }

                                            $jumlah_barang = array_sum($jumlah);

                                            $no = 1; // Assuming $no is supposed to start from 1

                                            // Assuming $result is the result of a query fetching data from another table
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo date('Y-m-d', strtotime($row["tanggal_daftar"])); ?></td>
                                                    <td><?php echo $row["nama_user"]; ?></td>
                                                    <td><?php echo $row["jumlahtamu_pemohon"]; ?> Orang</td>
                                                    <td><?php echo $row["makanan_konsumsi"]; ?></td>
                                                    <td> Rp. <?php echo $row["harga_konsumsi"]; ?></td>
                                                    <td> Rp. <?php echo $row["total_konsumsi"]; ?></td>
                                                    <td>
                                                        <a href="konsumsi-edit.php?id_konsumsi=<?php echo $row["id_konsumsi"]; ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit">Ubah</i></a>
                                                        <a href="konsumsi-hapus.php?id_konsumsi=<?php echo $row["id_konsumsi"]; ?>" class="btn btn-danger btn-xs text-light" onClick="javascript: return confirm('Apakah yakin ingin mengapus data ini...?');"><i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                        <td colspan="6" class="text-center">Jumlah</td>
                                        <td class="text-left"><?= 'Rp. ' . number_format($jumlah_barang); ?></td>
                                        <td></td>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "order": [
                    [0, "asc"]
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>