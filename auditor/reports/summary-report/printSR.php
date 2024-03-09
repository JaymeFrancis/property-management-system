<?php
session_start();
//include library
include('../../../assets/fpdf/fpdf.php');
include('../../../config.php');

//make Object
$pdf = new FPDF('P', 'mm', 'Legal');
$pdf ->AddFont('SLC','','OldEnglish.php');
$pdf ->SetTitle('Summary Report');
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
$pdf ->Cell(80, 5, 'SUMMARY REPORT', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1);

$pdf ->Ln();

$pdf -> setFont('Arial', 'B', 8);
$pdf ->Cell(50,5,'STOCK INVENTORY MOVEMENTS',0,0, 'L');
$pdf ->Cell(100,5,"",0,0);
$pdf ->Cell(40,5,'AS OF ' .date('F Y'),0,1, 'R');

$pdf -> setFont('Arial', 'B', 8);
$pdf ->Cell(50,5,'',0,0, 'L');
$pdf ->Cell(100,5,"",0,0);
$pdf ->Cell(40,5,'SCHOOL YEAR: 2021-2022',0,1, 'R');

$pdf ->Cell(190, 2, '', 0, 1);
/*
$pdf -> setFont('Arial', 'b', 8);
$pdf ->Cell(20,15,'DATE',1,0,'C');
$pdf ->Cell(30,5,'PURCHASES','LTR',0,'C');
$pdf ->Cell(15,15,'P.O.NO.',1,0,'C');
$pdf ->Cell(20,5,'INVOICE','LTR',0,'C');
$pdf ->Cell(25,15,'AMOUNT',1,0,'C');
$pdf ->Cell(20,5,'MONTHLY','LTR',0,'C');
$pdf ->Cell(20,5,'MONTHLY','LTR',0,'C');
$pdf ->Cell(20,5,'MONTHLY','LTR',0,'C');
$pdf ->Cell(20,15,'REMARKS',1,0,'C');
$pdf ->Cell(0,5,'',0,1,'C');

$pdf ->Cell(20,5,'',0,0,'C');
$pdf ->Cell(30,5,'PARTICULARS','LR',0,'C');
$pdf ->Cell(15,5,'',0,0,'C');
$pdf ->Cell(20,5,'NO.','LR',0,'C');
$pdf ->Cell(25,5,'',0,0,'C');
$pdf ->Cell(20,5,'BEGINNING','LR',0,'C');
$pdf ->Cell(20,5,'ISSUANCE','LR',0,'C');
$pdf ->Cell(20,5,'ENDING','LR',0,'C');
$pdf ->Cell(20,5,'',0,0,'C');
$pdf ->Cell(0,5,'',0,1,'C');

$pdf ->Cell(20,5,'',0,0,'C');
$pdf ->Cell(30,5,'NAME OF SUPPLIERS','LBR',0,'C');
$pdf ->Cell(15,5,'',0,0,'C');
$pdf ->Cell(20,5,'','LBR',0,'C');
$pdf ->Cell(25,5,'',0,0,'C');
$pdf ->Cell(20,5,'INVENTORY','LBR',0,'C');
$pdf ->Cell(20,5,'REPORT','LBR',0,'C');
$pdf ->Cell(20,5,'INVENTORY','LBR',0,'C');
$pdf ->Cell(20,5,'',0,1,'C');

*/
$pdf -> setFont('Arial', 'B', 12);
$pdf ->Cell(190, 8,'MONTH OF '.date('F Y').'',0,1,'C');

$pdf -> setFont('Arial', 'B', 8);
$pdf ->Cell(20,8,'Date',1,0,'C');
$pdf ->Cell(30,8,'Supplier',1,0,'C');
$pdf ->Cell(15,8,'P.O.',1,0,'C');
$pdf ->Cell(20,8,'INVOICE',1,0,'C');
$pdf ->Cell(25,8,'AMOUNT',1,0,'C');
$pdf ->Cell(80, 8,'Control Number for New Products',1,1,'C');

$pdf -> setFont('Arial', '', 8);
$pdf ->Cell(20,8,'Dec. 8, 2022',1,0,'C');
$pdf ->Cell(30,8,'CSI',1,0,'C');
$pdf ->Cell(15,8,'17745',1,0,'C');
$pdf ->Cell(20,8,'CSI 123',1,0,'C');
$pdf ->Cell(25,8,'12,500',1,0,'C');
$pdf ->Cell(80, 8,'',1,1,'C');

$pdf ->Cell(20,8,'Dec. 14, 2022',1,0,'C');
$pdf ->Cell(30,8,'LU Morning Star',1,0,'C');
$pdf ->Cell(15,8,'18284',1,0,'C');
$pdf ->Cell(20,8,'SI 15992',1,0,'C');
$pdf ->Cell(25,8,'8,000',1,0,'C');
$pdf ->Cell(80, 8,'',1,1,'C');

$pdf ->Cell(20,8,'Dec. 13, 2022',1,0,'C');
$pdf ->Cell(30,8,'National Bazaar',1,0,'C');
$pdf ->Cell(15,8,'17718',1,0,'C');
$pdf ->Cell(20,8,'CI 45629',1,0,'C');
$pdf ->Cell(25,8,'7,800',1,0,'C');
$pdf ->Cell(80, 8,'',1,1,'C');

$pdf ->Cell(20,8,'Dec. 11, 2022',1,0,'C');
$pdf ->Cell(30,8,'SKM Comp. Trade',1,0,'C');
$pdf ->Cell(15,8,'2210',1,0,'C');
$pdf ->Cell(20,8,'CI 2194',1,0,'C');
$pdf ->Cell(25,8,'15,750',1,0,'C');
$pdf ->Cell(80, 8,'',1,1,'C');

$pdf ->Cell(20,8,'Dec. 15, 2022',1,0,'C');
$pdf ->Cell(30,8,'SKM Comp. Trade',1,0,'C');
$pdf ->Cell(15,8,'20109',1,0,'C');
$pdf ->Cell(20,8,'CSI 0055',1,0,'C');
$pdf ->Cell(25,8,'1196',1,0,'C');
$pdf ->Cell(80, 8,'',1,1,'C');

$pdf ->Cell(20,8,'Dec. 14, 2022',1,0,'C');
$pdf ->Cell(30,8,'New Gate Comp',1,0,'C');
$pdf ->Cell(15,8,'20119',1,0,'C');
$pdf ->Cell(20,8,'CI 0226',1,0,'C');
$pdf ->Cell(25,8,'29,700',1,0,'C');
$pdf ->Cell(80, 8,'',1,1,'C');

$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(30,8,'',1,0,'C');
$pdf ->Cell(15,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(25,8,'74,946',1,0,'C');
$pdf ->Cell(20, 8,'',1,0,'C');
$pdf ->Cell(20, 8,'',1,0,'C');
$pdf ->Cell(20, 8,'',1,0,'C');
$pdf ->Cell(20, 8,'',1,1,'C');



$pdf ->Ln(10);
$pdf ->SetFont('Arial', 'BU', '10');

$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(80,5,'MR. CHRISTIAN DOMINIQUE B. CALDERON',0,1,'C');

$pdf ->SetFont('Arial', 'I', '10');

$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(80,5,'Property Management Officer',0,1,'C');
//output
$pdf -> Output();
?>