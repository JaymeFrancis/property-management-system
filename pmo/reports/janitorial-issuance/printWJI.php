<?php
session_start();
//include library
include('../../../assets/fpdf/fpdf.php');
include('../../../config.php');

//make Object
$pdf = new FPDF('P', 'mm', 'Legal');
$pdf ->AddFont('SLC','','OldEnglish.php');

//add page
$pdf -> AddPage();



//Header
$pdf ->Image('../../../assets/images/logo-bw.png',30,10,20,20);

$pdf ->SetFont('SLC', '', '20');
$pdf ->Cell(30, 5, '', 0,0);
$pdf ->Cell(25, 5, '', 0,0);
$pdf ->Cell(80, 10, 'Saint Louis College', 0,0,'C');
$pdf ->Cell(15, 5, '', 0,0);
$pdf ->SetFont('Arial', '', '6');
$pdf ->Cell(40, 5, 'Reference Code: FM-PMO-002', 'LTR',1,'L');

$pdf ->Cell(150, 5, '', 0,0);
$pdf ->Cell(40, 5, 'Revision Number: 0', 'LR',1,'L');

$pdf ->SetFont('Arial', '', '12');
$pdf ->Cell(55, 5, '', 0,0);
$pdf ->Cell(80, 5, 'City of San Fernando, La Union', 0,0,'C');
$pdf ->Cell(15, 5, '', 0,0);
$pdf ->SetFont('Arial', '', '6');
$pdf ->Cell(40, 5, 'Effective Date: July 1, 2019', 'LBR',1,'L');

$pdf ->Ln();

$pdf ->SetFont('Arial', '', '14');
$pdf ->Cell(55, 5, '', 0,0);
$pdf ->Cell(80, 5, 'PROPERTY MANAGEMENT OFFICE', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1);

$pdf ->Ln();

$pdf ->SetFont('Arial', 'B', '12');
$pdf ->Cell(55, 5, '', 0,0);
$pdf ->Cell(80, 5, 'WEEKLY JANITORIAL ISSUANCE', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1);

$pdf ->Ln();

$pdf -> setFont('helvetica', 'B', 8);
$pdf ->Cell(50,8,'AS OF ' .date('F Y'),0,0, 'L');
$pdf ->Cell(100,8,"",0,0);
$pdf -> setFont('helvetica', 'B', 8);
$pdf ->Cell(40,8,'SCHOOL YEAR: 2021-2022',0,1, 'R');

$pdf ->Cell(190, 2, '', 0, 1);

$pdf -> setFont('helvetica', 'b', 8);
$pdf ->Cell(20,10,'ITEM CODE',1,0,'C');
$pdf ->Cell(65,10,'PARTICULARS',1,0,'C');
$pdf ->Cell(15,10,'MONTH',1,0,'C');
$pdf ->Cell(15,10,'MONTH',1,0,'C');
$pdf ->Cell(15,10,'MONTH',1,0,'C');
$pdf ->Cell(15,10,'MONTH',1,0,'C');
$pdf ->Cell(15,10,'MONTH',1,0,'C');
$pdf ->Cell(30,10,'TOTAL',1,0,'C');





//output
$pdf -> Output();
?>