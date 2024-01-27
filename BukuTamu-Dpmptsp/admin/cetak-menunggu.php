<?php
session_start();

include '../koneksi.php';

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Custom styles for this template -->
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body onload="window.print();">
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
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama Pegawai</th>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">Jam</th>
                                    <th rowspan="2">Asal Instansi</th>
                                    <th rowspan="2">Nama Tamu</th>
                                    <th rowspan="2">Jumlah Tamu</th>
                                    <th rowspan="2">No Handphone</th>
                                    <th rowspan="2">Perihal Kunjungan</th>
                                    <th rowspan="2">Surat Permohonan</th>
                                    <th rowspan="2">Status Permohonan</th>
                                    <!-- <th rowspan="2">Alasan</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database
                                include '../koneksi.php';

                                // Initialize filter variables
                                $tanggal_menunggu_dari = isset($_GET['tanggal_menunggu_dari']) ? $_GET['tanggal_menunggu_dari'] : '';
                                $tanggal_menunggu_sampai = isset($_GET['tanggal_menunggu_sampai']) ? $_GET['tanggal_menunggu_sampai'] : '';

                                // Mengecek apakah tanggal kosong
                                if (empty($tanggal_menunggu_dari) || empty($tanggal_menunggu_sampai)) {
                                    // Jika tanggal kosong, query akan menampilkan semua data
                                    $query = "SELECT * FROM tbl_pemohon 
                                            LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                            LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                            LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                            WHERE tbl_pemohon.status_pemohon = 'Menunggu' ORDER BY tbl_pendaftaran.tanggal_daftar";
                                } else {
                                    // Jika tanggal diisi, query akan memfilter berdasarkan tanggal
                                    $query = "SELECT * FROM tbl_pemohon 
                                            LEFT JOIN tbl_pendaftaran ON tbl_pemohon.id_daftar = tbl_pendaftaran.id_daftar 
                                            LEFT JOIN tbl_pegawai ON tbl_pendaftaran.id_pegawai = tbl_pegawai.id_pegawai
                                            LEFT JOIN tbl_user ON tbl_pemohon.kode_user = tbl_user.kode_user
                                            WHERE tbl_pendaftaran.tanggal_daftar >= '$tanggal_menunggu_dari' AND tbl_pendaftaran.tanggal_daftar <= '$tanggal_menunggu_sampai'
                                            AND tbl_pemohon.status_pemohon = 'Menunggu'";
                                }

                                $result = mysqli_query($conn, $query);

                                if (!$result) {
                                    // Output the error message for debugging purposes
                                    echo "Error: " . mysqli_error($conn);
                                    // You may want to handle this error more gracefully in a production environment
                                    die();
                                }
                                // echo "Debugging Query: $query";
                                $no = 0;
                                // Check if any rows were returned
                                if (mysqli_num_rows($result) > 0) {
                                    // Menampilkan data dengan perulangan while
                                    while ($data = mysqli_fetch_array($result)) :
                                        $no++;
                                ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data['nama_pegawai']; ?> </td>
                                            <td><?php echo $data['tanggal_daftar']; ?> </td>
                                            <td><?php echo $data['jam_daftar']; ?> </td>
                                            <td><?php echo $data['asal_pemohon']; ?> </td>
                                            <td><?php echo $data['namarekan_pemohon']; ?> </td>
                                            <td><?php echo $data['jumlahtamu_pemohon']; ?> Orang</td>
                                            <td><?php echo $data['no_telp']; ?> </td>
                                            <td><?php echo $data['perihal_pemohon']; ?> </td>
                                            <td><?php echo $data['surat_pemohon']; ?> </td>
                                            <td><?php echo $data['status_pemohon']; ?> </td>
                                        </tr>
                                        <!-- bagian akhir (penutup) while -->
                                <?php endwhile;
                                } else {
                                    echo "No data found"; // Output a message if no data is found
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>