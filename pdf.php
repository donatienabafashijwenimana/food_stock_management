<?php
include 'tcpdf/tcpdf.php';
$a = "gatore";
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->writeHTML($a);
$pdf->Output('don.pdf','I');
?>