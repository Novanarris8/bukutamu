<?php
require('fpdf/fpdf.php');
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetLeftMargin(20);
$pdf->AddPage();
$pdf->Image('../../logo.png', $x = 40, $y = 0, $w = 30, $h = 30);
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'LAPORAN KONSUMSI', 0, 10, 'C');
$pdf->Cell(10, 7, '', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(10, 6, 'No.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Tanggal', 1, 0, 'C');
$pdf->Cell(70, 6, 'Nama Instansi', 1, 0, 'C');
$pdf->Cell(50, 6, 'Nama Tamu', 1, 0, 'C');
$pdf->Cell(30, 6, 'Jumlah Tamu', 1, 0, 'C');
$pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
$pdf->Cell(20, 6, 'Total', 1, 1, 'C');
$pdf->SetFont('Times', '', 10);
include '../koneksi.php';
$no = 1;
$result = mysqli_query($conn,  "SELECT * FROM tbl_konsumsi K 
LEFT JOIN tbl_pemohon P ON K.id_pemohon = P.id_pemohon
LEFT JOIN tbl_pendaftaran D ON P.id_daftar = D.id_daftar
LEFT JOIN tbl_user U ON P.kode_user = U.kode_user");
while ($data = mysqli_fetch_array($result)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(20, 6, $data['tanggal_daftar'], 1, 0);
    $pdf->Cell(70, 6, $data['asal_pemohon'], 1, 0);
    $pdf->Cell(50, 6, $data['nama_user'], 1, 0);
    $pdf->Cell(30, 6, $data['jumlahtamu_pemohon'] . ' orang', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Rp. ' . $data['harga_konsumsi'], 1, 0);
    $pdf->Cell(20, 6, 'Rp. ' . $data['total_konsumsi'], 1, 1);
}
$pdf->Ln(5);
// $pdf->SetFont('Times', '', 12);
// $pdf->Cell(250, 10, 'Banjarmasin, 05 Januari 2022', 0, 250, 'R');
// $pdf->Cell(235, 5, 'Hormat Kami,', 235, 5, 'R');
// $pdf->Cell(235, 5, 'Kepala Klinik', 235, 5, 'R');
// $pdf->SetFont('Times','U',12);
// $pdf->Cell(239, 40, 'AULIA ANDINI', 239, 40, 'R');
// $pdf->Cell(150);
// $pdf->Ln(-35);
// $pdf->SetFont('Times', '', 12);
// $pdf->Cell(237, 40, '2010010241', 237, 40, 'R');
$pdf->Output();
