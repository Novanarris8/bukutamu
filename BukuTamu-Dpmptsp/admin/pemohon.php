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

$query = "SELECT * FROM tbl_pemohon A 
            LEFT JOIN tbl_pendaftaran B ON A.id_daftar = B.id_daftar
            LEFT JOIN tbl_pegawai C ON B.id_pegawai = C.id_pegawai
            LEFT JOIN tbl_user D ON A.kode_user = D.kode_user ";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pemohon | DPMPTSP</title>
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
                            <h1>Daftar Pemohon DPMPTSP</h1>
                            <h1>Kota Banjarmasin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Pemohon</li>
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
                                <!-- <div class="card-header">
                                    <a href="pemohon-tambah.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                                </div> -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Menemui</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Asal Instansi</th>
                                                <!-- <th>Nama Tamu</th>
                                                <th>Nama Rekan</th>
                                                <th>Jumlah Tamu</th>
                                                <th>No Hp</th>
                                                <th>Perihal Kunjungan</th> -->
                                                <th>Surat Permohonan</th>
                                                <th>Status Permohonan</th>
                                                <th>Alasan</th>
                                                <th>Action</th>
                                                <th>Lihat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row["nama_pegawai"]; ?></td>
                                                    <td><?php echo $row["tanggal_daftar"]; ?></td>
                                                    <td><?php echo $row["jam_daftar"]; ?></td>
                                                    <td><?php echo $row["asal_pemohon"]; ?></td>
                                                    <!-- <td><?php echo $row["nama_user"]; ?></td>
                                                    <td><?php echo $row["namarekan_pemohon"]; ?></td>
                                                    <td><?php echo $row["jumlahtamu_pemohon"]; ?></td>
                                                    <td><?php echo $row["no_hp"]; ?></td>
                                                    <td><?php echo $row["perihal_kunjungan"]; ?></td> -->
                                                    <td>
                                                        <a href="../assets/files/<?php echo $row["surat_pemohon"]; ?>" target="_blank"><i class="fas fa-link"></i>
                                                            <?php echo $row["surat_pemohon"]; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row["status_pemohon"] == "Menunggu") { ?>
                                                            <span class="badge p-1 bg-success">Data sedang di Proses</span>
                                                        <?php } else if ($row["status_pemohon"] == "Di Verifikasi") { ?>
                                                            <span class="badge bg-primary">Data ini di verifikasi</span>
                                                        <?php } else if ($row["status_pemohon"] == "Tolak") { ?>
                                                            <span class="badge bg-danger">Data ini di TOLAK</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $row["alasan"]; ?></td>
                                                    <td><?php
                                                        if ($row["status_pemohon"] == "Menunggu") { ?>
                                                            <a href="pemohon-edit.php?id_pemohon=<?php echo $row["id_pemohon"]; ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit">Konfirmasi</i></a>
                                                        <?php } else if ($row["status_pemohon"] == "Di Verifikasi") { ?>
                                                            <a href="pemohon-edit.php?id_pemohon=<?php echo $row["id_pemohon"]; ?>" class="btn btn-dark btn-xs mr-1" style="text-decoration: none; pointer-events: none;"><i class="fa fa-edit">Konfirmasi</i></a>
                                                        <?php } else if ($row["status_pemohon"] == "Tolak") { ?>
                                                            <a href="pemohon-ditolak.php?id_pemohon=<?php echo $row["id_pemohon"]; ?>" class="btn btn-dark btn-xs mr-1" style="text-decoration: none; pointer-events: none;"><i class="fa fa-edit">Konfirmasi</i></a>
                                                        <?php } ?>

                                                    </td>
                                                    <!-- <td>
                                                <a href="pemohon-edit.php?id_pemohon=<?php echo $row["id_pemohon"]; ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit">Ubah</i></a>
                                                <a href="pemohon-hapus.php?id_pemohon=<?php echo $row["id_pemohon"]; ?>" class="btn btn-danger btn-xs text-light"
                                                onClick="javascript: return confirm('Apakah yakin ingin mengapus data ini...?');"><i class="fa fa-trash"></i> Hapus</a>
                                            </td> -->
                                                    <td>
                                                        <div class="d-flex order-actions">
                                                            <a class="text-light btn bg-primary cursor-pointer border-2" onclick="showDetail('<?= $row['nama_pegawai'] ?>',
                                                    '<?= $row['tanggal_daftar'] ?>',
                                                    '<?= $row['jam_daftar'] ?>',
                                                    '<?= $row['asal_pemohon'] ?>',
                                                    '<?= $row['nama_user'] ?>',
                                                    '<?= $row['jumlahtamu_pemohon'] ?>',
                                                    '<?= $row['no_telp'] ?>',
                                                    '<?= $row['perihal_pemohon'] ?>',
                                                    '<?= $row['surat_pemohon'] ?>',
                                                    '<?= $row['status_pemohon'] ?>',
                                                    '<?= $row['alasan'] ?>')"><i class='fas fa-eye'></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>

                                    <!-- Modal for user details -->
                                    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Permohonan</h5>
                                                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <!-- Menampilkan foto dengan ID 'detailPhoto' -->
                                                            <!-- <img src="" alt="User Photo" id="detailFoto" class="img-fluid"> -->
                                                        </div>
                                                        <div class="col-md-8">
                                                            <ul>
                                                                <li><strong>Menemui:</strong> <span id="detailPegawai"></span></li>
                                                                <li><strong>Tanggal:</strong> <span id="detailTanggal"></span></li>
                                                                <li><strong>Jam:</strong> <span id="detailJam"></span></li>
                                                                <li><strong>Asal Instansi:</strong> <span id="detailInstansi"></span></li>
                                                                <li><strong>Nama Tamu:</strong> <span id="detailTamu"></span></li>
                                                                <li><strong>Jumlah Tamu:</strong> <span id="detailJumlah"></span> Orang</li>
                                                                <li><strong>No Handphone:</strong> <span id="detailHp"></span></li>
                                                                <li><strong>Perihal Kunjungan:</strong> <span id="detailKunjungan"></span></li>
                                                                <li><strong>Surat Permohonan:</strong> <span id="detailPermohonan"></span></li>
                                                                <li><strong>Status:</strong> <span id="detailStatus"></span></li>
                                                                <li><strong>Alasan di Tolak:</strong> <span id="detailAlasan"></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                                        </div> -->
                                            </div>
                                        </div>
                                    </div>


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
    <script>
        function showDetail(nama_pegawai, tanggal, jam, asal_instansi, nama_tamu, jumlah_tamu, no_hp, perihal_kunjungan, surat_permohonan, status, alasan) {

            // Ubah level menjadi "guru" jika level = 1, dan "user" jika level = 2
            // var levelText = (level == 1) ? "Admin" : "Guru";

            // Ubah status menjadi "aktif" jika status = 1, dan "Non Aktif" jika status = 2
            // var statusText = (status == 1) ? "Aktif" : "Non Aktif";
            // var bagianText = (bagian == 1) ? "Guru Umum" : "Guru Ektrakurikuler";
            // var jk = (jk == 1) ? "Laki-Laki" : "Perempuan";

            // Mengatur isi dari elemen-elemen lain sesuai dengan data yang diterima
            document.getElementById('detailPegawai').innerText = nama_pegawai;
            document.getElementById('detailTanggal').innerText = tanggal;
            document.getElementById('detailJam').innerText = jam;
            document.getElementById('detailInstansi').innerText = asal_instansi;
            document.getElementById('detailTamu').innerText = nama_tamu;
            document.getElementById('detailJumlah').innerText = jumlah_tamu;
            document.getElementById('detailHp').innerText = no_hp;
            document.getElementById('detailKunjungan').innerText = perihal_kunjungan;
            document.getElementById('detailPermohonan').innerText = surat_permohonan;
            document.getElementById('detailStatus').innerText = status;
            document.getElementById('detailAlasan').innerText = alasan;

            // Ganti path untuk foto
            // var fotoUrl = 'img/' + foto;

            // Tampilkan foto
            // document.getElementById('detailFoto').src = fotoUrl;

            // Tampilkan modal
            $('#detailModal').modal('show');
        }
    </script>
</body>

</html>