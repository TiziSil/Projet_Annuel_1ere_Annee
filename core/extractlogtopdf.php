<?php
require 'pdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
//$filePath = '/var/www/log.txt';
$filePath = '../log.txt';
$logContent = file_get_contents($filePath);
$pdf->Cell(0, 10, $logContent, 0, 1);
$pdf->Output('log_extract.pdf', 'I');
