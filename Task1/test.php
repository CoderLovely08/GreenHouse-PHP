<?php

require('fpdf/fpdf.php');

// New object created and constructor invoked
$pdf = new FPDF();

// Add new pages. By default no pages available.
$pdf->AddPage();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 20);

// Framed rectangular area
$pdf->Cell(176, 5, 'GreenVerz', 0, 0, 'C');

// Set it new line
$pdf->Ln();
$pdf->Image('images/logo.png', 30, 8, 20);
$pdf->Image('images/logo.png', 160, 8, 20);

// Set font format and font-size
$pdf->SetFont('Times', 'B', 12);

// Framed rectangular area
$pdf->Cell(176, 10, 'Exploring the Real Nature!', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 22);
$pdf->Image('images/flower-pot.png', 60, 40, 100,100);
$pdf->SetXY(100,150);
$pdf->Cell(10, 0, 'Money Plant', 0, 10, 'C');
// $pdf->Cell(0, 0, 'Money Plant', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 16);
$pdf->SetXY(85,160);
$pdf->Cell(50, 0, 'Author: Lovely Sharma',0,1,'C');

$pdf->SetXY(0,170);
$pdf->Cell(50, 0, 'Description:', 0, 1, 'C');

$pdf->SetFont('Times', '', 10);
$pdf->SetXY(10,175);
$fullText="Some text";
$pdf->Write(10,$fullText);





// Close document and sent to the browser
$pdf->Output();
// $pdf->Output('Myfile.pdf','D');

?>
