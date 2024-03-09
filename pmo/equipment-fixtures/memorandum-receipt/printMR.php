<?php
session_start();
//include library
include('../../../assets/fpdf/fpdf.php');
include('../../../config.php');

//make Object
$pdf = new FPDF('P', 'mm', 'A4');
$pdf ->AddFont('SLC','','OldEnglish.php');

//add page
$pdf -> AddPage();

if(isset($_GET['mr'])){
    $mrno = $_GET['mr'];

    $query = "SELECT *, quantity*price AS amount FROM memorandum_receipt WHERE mr_no = '$mrno'";
    $result = mysqli_query($conn, $query);
    $results = mysqli_fetch_assoc($result);

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
$pdf ->Cell(80, 5, 'PROPERTY MANAGEMENT SYSTEM', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1);

$pdf ->Ln();

$pdf ->SetFont('Arial', 'B', '12');
$pdf ->Cell(55, 5, '', 0,0);
$pdf ->Cell(80, 5, 'MEMORANDUM RECEIPT', 0, 0, 'C');
$pdf ->Cell(55, 5, 'NO. '.$mrno, 0,1, 'C');

$pdf ->SetFont('Arial', 'B', '9');
$pdf ->Cell(55, 5, '', 0,0);
$pdf ->Cell(80, 5, '(for Furniture, Fixture, and other Fabricated Asset)', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1,);

$pdf ->SetFont('Arial', 'I', '9');
$pdf ->Cell(35, 5, '', 0,0);
$pdf ->Cell(120, 5, 'I acknowledge receipt of the following property/ies issued of which I am responsible:', 0, 0, 'C');
$pdf ->Cell(35, 5, '', 0,1,);

$pdf ->Cell(190, 2, '', 0, 1);

$pdf ->SetFont('Arial', 'B', '10');
$pdf ->Cell(20,8,'DATE',1,0,'C');
$pdf ->Cell(20,8,'QTY',1,0,'C');
$pdf ->Cell(20,8,'UNIT',1,0,'C');
$pdf ->Cell(70,8,'PARTICULARS',1,0,'C');
$pdf ->Cell(20,8,'PRICE',1,0,'C');
$pdf ->Cell(20,8,'AMOUNT',1,0,'C');
$pdf ->Cell(20,8,'LOCATION',1,1,'C');

//Content
$fontsize = 8;
$tempfontsize = $fontsize;

foreach($result as $memo){
$pdf ->SetFont('Arial', '', '8');
$pdf ->Cell(20,8,date('M d, Y',strtotime($memo['date'])),1,0,'C');
$pdf ->Cell(20,8,$memo['quantity'],1,0,'C');
$pdf ->Cell(20,8,$memo['unit'],1,0,'C');
$pdf ->Cell(70,8,$memo['particulars'],1,0,'C');
$pdf ->Cell(20,8,$memo['price'],1,0,'C');
$pdf ->Cell(20,8,$memo['amount'],1,0,'C');

$locationWidth = 20;
while($pdf -> GetStringWidth($memo['locations']) > $locationWidth){
    $pdf ->SetFontSize($tempfontsize -= 0.1);
}
$pdf ->Cell($locationWidth,8,$memo['locations'],1,1,'C');
}

$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(70,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,1,'C');

$pdf ->SetFont('Arial', 'B', '10');
$pdf ->Cell(150,8,'TOTAL :',1,0,'L');
$pdf ->Cell(20,8,'',1,0,'C');
$pdf ->Cell(20,8,'',1,1,'C');

$pdf ->Cell(150, 5, '', 0,1);

$pdf ->SetFont('Arial', 'I', '10');
$pdf ->Cell(80,8,'Issued by:',0,0,'C');
$pdf ->Cell(30,8,'',0,0);
$pdf ->Cell(80,8,'Recieved by:',0,1,'C');

$pdf ->Cell(150, 2, '', 0,1);

//Footer
$recQuery = "SELECT * FROM tbl_memo_receipt WHERE mr_number = '$mrno'";
$recResult = mysqli_query($conn, $recQuery);
$rec = mysqli_fetch_assoc($recResult);

$pdf ->SetFont('Arial', 'BU', '10');
$pdf ->Cell(80,5,'MR. CHRISTIAN DOMINIQUE B. CALDERON',0,0,'C');
$pdf ->Cell(30,5,'',0,0);
$pdf ->Cell(80,5,'MR/S. '.strtoupper($rec['recipient']),0,1,'C');

$pdf ->SetFont('Arial', 'I', '10');
$pdf ->Cell(80,5,'Property Management Officer',0,0,'C');
$pdf ->Cell(30,5,'',0,0);
$pdf ->Cell(80,5,$rec['position'].', '.$results['locations'],0,1,'C');


}
//output
$pdf -> Output();
?>