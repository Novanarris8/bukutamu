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

$id_pegawai = $_GET["id_pegawai"];
$query = "DELETE FROM tbl_pegawai WHERE id_pegawai = $id_pegawai";
$delete = mysqli_query($conn, $query);

    if ($delete) {
        echo "<script type='text/javascript'>
        alert('Data berhasil dihapus...!');
        document.location.href = 'pegawai.php'; 
        </script>";
    }
?>