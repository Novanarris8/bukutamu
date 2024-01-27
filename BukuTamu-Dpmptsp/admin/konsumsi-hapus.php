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

$id_konsumsi = $_GET["id_konsumsi"];
$query = "DELETE FROM tbl_konsumsi WHERE id_konsumsi = $id_konsumsi";
$delete = mysqli_query($conn, $query);

    if ($delete) {
        echo "<script type='text/javascript'>
        alert('Data berhasil dihapus...!');
        document.location.href = 'konsumsi.php'; 
        </script>";
    }
?>