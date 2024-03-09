<?php
session_start();
//include library
include('../../../assets/fpdf/fpdf.php');
include('../../../config.php');

//make Object
$pdf = new FPDF('P', 'mm', 'Legal');
$pdf ->AddFont('SLC','','OldEnglish.php');
$pdf ->SetTitle('Stock Position Report');
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
$pdf ->Cell(80, 5, 'MONTHLY STOCK POSITION REPORT OF STOCKROOM SUPPLIES', 0, 0, 'C');
$pdf ->Cell(55, 5, '', 0,1);

$pdf ->Ln();

$pdf -> setFont('helvetica', 'B', 8);
$pdf ->Cell(50,8,'AS OF ' .date('F Y'),0,0, 'L');
$pdf ->Cell(100,8,"",0,0);
$pdf -> setFont('helvetica', 'B', 8);
$pdf ->Cell(40,8,'SCHOOL YEAR: 2021-2022',0,1, 'R');


$pdf ->Cell(190, 2, '', 0, 1);

$pdf ->SetFont('Arial', 'B', '10');
$pdf ->Cell(15,5,'ITEM','LTR',0,'C');
$pdf ->Cell(40,10,'PARTICULARS',1,0,'C');
$pdf ->Cell(15,5,'ITEM','LTR',0,'C');
$pdf ->Cell(15,10,'UNIT/S',1,0,'C');
$pdf ->Cell(15,10,'PRICE',1,0,'C');
$pdf ->Cell(20,10,'AMOUNT',1,0,'C');
$pdf ->Cell(35,5,'ISSUANCE',1,0,'C');
$pdf ->Cell(15,5,'ITEM','LTR',0,'C');
$pdf ->Cell(20,10,'AMOUNT',1,0,'C');
$pdf ->Cell(0,5,'',0,1,'C');

$pdf ->Cell(15,5,'CODE','LBR',0,'C');
$pdf ->Cell(40,5,'',0,0,'C');
$pdf ->Cell(15,5,'BAL.','LBR',0,'C');
$pdf ->Cell(50,5,'',0,0,'C');
$pdf ->Cell(15,5,'QTY','BR',0,'C');
$pdf ->Cell(20,5,'PRICE','LB',0,'C');
$pdf ->Cell(15,5,'BAL.','LBR',0,'C');
$pdf ->Cell(20,5,'',0,1,'C');

if(isset($_GET['ref'])){
    $refid = $_GET['ref'];

    $query = "SELECT *, quantity*price AS amount, issuance_qty*price AS issuance_amt, rem_qty*price AS rem_amt FROM tbl_stock_stockroom WHERE item_code != '' ORDER BY particulars";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)>0){
        foreach($result as $rows){
            $pdf ->SetFont('Arial', '', '8');
            $pdf ->Cell(15,8,$rows['item_code'],1,0,'C');
            $pdf ->Cell(40,8,$rows['particulars'],1,0,'C');
            $pdf ->Cell(15,8,$rows['quantity'],1,0,'C');
            $pdf ->Cell(15,8,$rows['unit'],1,0,'C');
            $pdf ->Cell(15,8,number_format((float)$rows['price'], 2,'.',','),1,0,'C');
            $pdf ->Cell(20,8,number_format((float)$rows['amount'], 2,'.',','),1,0,'C');
            $pdf ->Cell(15,8,$rows['issuance_qty'],1,0,'C');
            $pdf ->Cell(20,8,number_format((float)$rows['issuance_amt'], 2,'.',','),1,0,'C');
            $pdf ->Cell(15,8,$rows['rem_qty'],1,0,'C');
            $pdf ->Cell(20,8,number_format((float)$rows['rem_amt'], 2,'.',','),1,1,'C');
        }
    }
   
    $pdf ->Cell(15,8,'',1,0,'C');
    $pdf ->Cell(40,8,'',1,0,'C');
    $pdf ->Cell(15,8,'',1,0,'C');
    $pdf ->Cell(15,8,'',1,0,'C');
    $pdf ->Cell(15,8,'',1,0,'C');
    $pdf ->Cell(20,8,'',1,0,'C');
    $pdf ->Cell(15,8,'',1,0,'C');
    $pdf ->Cell(20,8,'',1,0,'C');
    $pdf ->Cell(15,8,'',1,0,'C');
    $pdf ->Cell(20,8,'',1,1,'C');


$pdf ->Ln(10);
$pdf ->SetFont('Arial', 'BU', '10');

$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(80,5,'MR. CHRISTIAN DOMINIQUE B. CALDERON',0,1,'C');

$pdf ->SetFont('Arial', 'I', '10');

$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(55,5,'',0,0);
$pdf ->Cell(80,5,'Property Management Officer',0,1,'C');
}








//output
$pdf -> Output();
?>