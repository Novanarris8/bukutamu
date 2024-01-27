<?php
session_start();

include '../koneksi.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Laporan Konsumsi</title>
    <!-- Include your stylesheets and other head elements here -->
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <style>
        .style9 {
            color: #000000;
            font-size: 9pt;
            font-weight: normal;
            font-family: Arial;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-1 float-left">
                        <img src="../../img/img/logo.png" width="55px" style="margin-left:240px ;" alt="brand" />
                    </div>
                    <div class="col-sm-11 text-center">
                        <h3>DPMPTSP Banjarmasin</h3>
                        <h6></h6>
                        <h6>Jl.Sultan Adam No.49,Sungai Andai,Surgi Mufti <br>
                            Kec.Banjarmasin Utara,Kota Banjarmasin,Kalimantan Selatan 70122</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!--rows -->
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">Nama Tamu</th>
                                    <th rowspan="2">Jumlah Tamu</th>
                                    <th rowspan="2">Konsumsi</th>
                                    <th rowspan="2">Harga</th>
                                    <th rowspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database
                                include '../koneksi.php';

                                // Initialize filter variables
                                $tanggal_konsumsi_dari = isset($_GET['tanggal_konsumsi_dari']) ? $_GET['tanggal_konsumsi_dari'] : '';
                                $tanggal_konsumsi_sampai = isset($_GET['tanggal_konsumsi_sampai']) ? $_GET['tanggal_konsumsi_sampai'] : '';

                                // Mengecek apakah tanggal kosong
                                if (empty($tanggal_konsumsi_dari) || empty($tanggal_konsumsi_sampai)) {

                                    // Jika tanggal kosong, query akan menampilkan semua data
                                    $query = mysqli_query($conn, "SELECT *
                                    FROM tbl_konsumsi
                                    INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
                                    INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
                                    INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user");

                                    $hitung = mysqli_query($conn, "SELECT * FROM tbl_konsumsi");
                                    $jumlah = []; // Initialize an array to store 'total' values

                                    while ($data = mysqli_fetch_array($hitung)) {
                                        $jumlah[] = $data['total_konsumsi'];
                                    }
                                    $jumlah_barang = array_sum($jumlah);
                                } else {
                                    // Jika tanggal diisi, query akan memfilter berdasarkan tanggal
                                    $query = mysqli_query($conn, "SELECT *
                                    FROM tbl_konsumsi
                                    INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
                                    INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
                                    INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user WHERE tbl_pendaftaran.tanggal_daftar between '$tanggal_konsumsi_dari' and '$tanggal_konsumsi_sampai'");

                                    $hitung = mysqli_query($conn, "SELECT *
                                    FROM tbl_konsumsi
                                    INNER JOIN tbl_pemohon ON tbl_konsumsi.id_pemohon = tbl_pemohon.id_pemohon
                                    INNER JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar
                                    INNER JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user WHERE tbl_pendaftaran.tanggal_daftar between '$_GET[tanggal_konsumsi_dari]' and '$_GET[tanggal_konsumsi_sampai]'");
                                    $jumlah = []; // Initialize an array to store 'total' values

                                    while ($data = mysqli_fetch_array($hitung)) {
                                        $jumlah[] = $data['total_konsumsi'];
                                    }
                                    $jumlah_barang = array_sum($jumlah);
                                    // $tanggal_konsumsi_dari = isset($_GET['tanggal_konsumsi_dari']) ? $_GET['tanggal_konsumsi_dari'] : '';
                                    // $tanggal_konsumsi_sampai = isset($_GET['tanggal_konsumsi_sampai']) ? $_GET['tanggal_konsumsi_sampai'] : '';
                                }
                                $no = 0;
                                // Check if any rows were returned
                                if (mysqli_num_rows($query) > 0) {
                                    // Menampilkan data dengan perulangan while
                                    while ($data = mysqli_fetch_array($query)) :
                                        $no++;
                                ?>
                                        <tr>
                                            <td><?php echo $data['tanggal_daftar']; ?> </td>
                                            <td><?php echo $data['nama_user']; ?> </td>
                                            <td><?php echo $data['jumlahtamu_pemohon']; ?> Orang </td>
                                            <td><?php echo $data['makanan_konsumsi']; ?> </td>
                                            <td>Rp. <?php echo $data['harga_konsumsi']; ?> </td>
                                            <td>Rp. <?php echo $data['total_konsumsi']; ?> </td>
                                        </tr>
                                        <!-- bagian akhir (penutup) while -->
                                    <?php endwhile; ?>

                                    <!-- Summary Row -->
                                    <tr>
                                        <td colspan="5" class="text-center">Jumlah</td>
                                        <td class="text-left"><?= 'Rp. ' . number_format($jumlah_barang); ?></td>
                                    </tr>
                                <?php
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No data found</td></tr>"; // Output a message if no data is found
                                }
                                ?>
                            </tbody>

                        </table>
                        <table width="98%" border="0" align="right">
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="3582">
                                    <div align="right"></div>
                                </td>
                                <td width="889">
                                    <div align="center" class="style9">Pemimpin</div>
                                </td>
                                <td width="76"></td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="182">
                                    <div align="right"></div>
                                </td>
                                <td width="189">
                                    <div align="center" class="style9">.....................</div>
                                </td>
                                <td width="76"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>