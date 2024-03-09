<?php
session_start();
//include library
include('../../../assets/fpdf/fpdf.php');
include('../../../config.php');

//make Object
$pdf = new FPDF('P', 'mm', 'Legal');
$pdf ->AddFont('SLC','','OldEnglish.php');
$pdf ->SetTitle('Surrendered Equipment');

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
$pdf ->Cell(80, 5, 'SURRENDERED EQUIPMENT', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1);

$pdf ->Ln();

$pdf -> setFont('helvetica', 'B', 8);
$pdf ->Cell(50,8,'AS OF ' .date('F Y'),0,0, 'L');
$pdf ->Cell(100,8,"",0,0);
$pdf -> setFont('helvetica', 'B', 8);
$pdf ->Cell(40,8,'SCHOOL YEAR: 2021-2022',0,1, 'R');

$pdf ->Cell(190, 2, '', 0, 1);

$pdf ->SetFont('Arial', 'B', '10');
$pdf ->Cell(15,10,'MR No.',1,0,'C');
$pdf ->Cell(60,10,'PARTICULARS',1,0,'C');
$pdf ->Cell(10,10,'QTY',1,0,'C');
$pdf ->Cell(15,10,'UNIT/S',1,0,'C');
$pdf ->Cell(25,10,'DATE',1,0,'C');
$pdf ->Cell(30,10,'SURRENDER BY',1,0,'C');
$pdf ->Cell(35,10,'LOCATION',1,1,'C');

$query = "SELECT inv.*, surr.locations  FROM tbl_inventory inv
        INNER JOIN surrender_equip surr 
        ON inv.id = surr.surr_id
        WHERE inv.status != 'OK'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0):
    foreach($result as $rows){

$pdf ->SetFont('Arial', '', '8');
$pdf ->Cell(15,10,$rows['mr_no'],1,0,'C');
$pdf ->Cell(60,10,$rows['particulars'],1,0,'C');
$pdf ->Cell(10,10,$rows['quantity'],1,0,'C');
$pdf ->Cell(15,10,$rows['unit'],1,0,'C');
$pdf ->Cell(25,10,date('M d, Y',strtotime($rows['date_moved'])),1,0,'C');
$pdf ->Cell(30,10,$rows['recipient'],1,0,'C');
$pdf ->Cell(35,10,$rows['locations'],1,1,'C');

}
endif;
$pdf ->Cell(15,10,'',1,0,'C');
$pdf ->Cell(60,10,'',1,0,'C');
$pdf ->Cell(10,10,'',1,0,'C');
$pdf ->Cell(15,10,'',1,0,'C');
$pdf ->Cell(25,10,'',1,0,'C');
$pdf ->Cell(30,10,'',1,0,'C');
$pdf ->Cell(35,10,'',1,1,'C');


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