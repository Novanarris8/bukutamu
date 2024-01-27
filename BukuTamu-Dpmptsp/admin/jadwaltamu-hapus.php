<?php
include 'untuk-sesi.php';

$id_daftar = $_GET["id_daftar"];
$query = "DELETE FROM tbl_pendaftaran WHERE id_daftar = $id_daftar";
$delete = mysqli_query($conn, $query);

if ($delete) {
    echo "<script type='text/javascript'>
        alert('Data berhasil dihapus...!');
        document.location.href = 'jadwaltamu.php'; 
        </script>";
}
