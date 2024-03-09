<?php
//include library
include('../../../assets/fpdf/fpdf.php');
include('../../../config.php');
session_start();
//make Object
$pdf = new FPDF('L', 'mm', 'Legal');
$pdf -> setMargins(12.5, 10);
$pdf ->AddFont('SLC','','OldEnglish.php');
$pdf ->SetTitle('Stockroom Issuance Report');

if(isset($_GET['ref'])){
$id = $_GET['ref'];

$stmt = "SELECT * FROM stockroom_issuance_report WHERE id = '$id'";
$query = mysqli_query($conn, $stmt);
$result = mysqli_fetch_assoc($query);


//add page
$pdf -> AddPage();

//add content

//Header;
$pdf ->Image('../../../assets/images/logo-bw.png',80,10,25,25);

$pdf -> setFont('SLC', '', 20);
$pdf ->Cell(110,8,"",0,0,'C');
$pdf ->Cell(110,8,"Saint Louis College",0,0,'C');
$pdf ->Cell(70,8,"",0,0);
$pdf -> setFont('Arial', '', 5);
$pdf ->Cell(40,5,"Reference Code: #####",1,1,'L','','','',true);


$pdf ->Cell(290,5,'',0,0);
$pdf ->Cell(40,5,"Revision Number: 0",1,1,'L','','','',true);

$pdf -> setFont('Arial', '', 12);
$pdf ->Cell(110,5,"",0,0,'C');
$pdf ->Cell(110,5,"City of San Fernando, La Union",0,0,'C');
$pdf ->Cell(70,8,"",0,0);
$pdf -> setFont('Arial', '', 5);
$pdf ->Cell(40,5,"Effective Date: ".date('F d, Y'),1,1,'L');
$pdf ->Ln();

//Title
$pdf ->setFont('Arial','b',12);
$pdf ->Cell(110,5,"",0,0,'C');
$pdf ->Cell(110,5,"PROPERTY MANAGEMENT OFFICE",0,1,'C');

$pdf ->Cell(330,5,'',0,1);

$pdf ->setFont('Arial','b',16);
$pdf ->Cell(110,5,"",0,0,'C');
$pdf ->Cell(110,5,"MONTHLY STOCKROOM ISSUANCE REPORT",0,1,'C');
$pdf ->Ln();

$pdf ->setFont('Arial','',10);
$pdf ->Cell(110,5,'AS PER OFFICE/DEPARTMENT',0,0,'L');
$pdf ->Cell(110,5,'',0,0);
$pdf ->Cell(50,5,'',0,0);
$pdf ->Cell(60,5,'STOCKROOM INVENTORIES',0,1,'R');

$pdf ->Cell(110,5,'FOR THE MONTH OF '.$result['month'].' '.$result['year'],0,0,'L');
$pdf ->Cell(110,5,'',0,0);
$pdf ->Cell(50,5,'',0,0);
$pdf ->Cell(60,5,'SCHOOL YEAR: 2021-2022',0,1,'R');

//Table

//TABLE HEADER
$pdf ->setFont('Arial','B',9);
$pdf ->Cell(30,10,'DATE DUE',1,0,'C');
$pdf ->Cell(30,5,'DATE','LTR',0,'C');
$pdf ->Cell(15,5,'R.S.','LTR',0,'C');
$pdf ->setFont('Arial','B',9);
$pdf ->Cell(25,5,'ITEM','LTR',0,'C');

$pdf ->setFont('Arial','B',10);
$pdf ->Cell(90,10,'PARTICULARS',1,0,'C');

$pdf ->setFont('Arial','B',9);
$pdf ->Cell(15,10,'QTY',1,0,'C');
$pdf ->Cell(15,10,'UNIT',1,0,'C');
$pdf ->Cell(20,10,'PRICE',1,0,'C');
$pdf ->Cell(20,10,'AMOUNT',1,0,'C');
$pdf ->Cell(20,10,'TOTAL',1,0,'C');
$pdf ->Cell(50,10,'ISSUED TO',1,0,'C');
$pdf ->Cell(0,5,'',0,1);

$pdf ->Cell(30,5,'',0,0);
$pdf ->Cell(30,5,'DELIVERED','LBR',0,'C');
$pdf ->Cell(15,5,'NUMBER','LBR',0,'C');
$pdf ->Cell(25,5,'CODE','LBR',0,'C');
$pdf ->Cell(230,5,'',0,1);

//TABLE CONTENT
$querySir = "SELECT * FROM tbl_request_stockroom WHERE status = 'Issued' ";
$resultSir = mysqli_query($conn, $querySir);

if(mysqli_num_rows($resultSir) > 0){
    foreach($resultSir as $ris){
        $queryRis = "SELECT *, quantityReq*price AS amount FROM tbl_ris_stockroom WHERE iss_no = '$ris[iss_no]' ";
        $resultRis = mysqli_query($conn, $queryRis);
        $itemss = mysqli_fetch_assoc($resultRis);
        
        if(mysqli_num_rows($resultRis) > 0){
            foreach($resultRis as $items){
                $pdf ->setFont('Arial','',9);
                $pdf ->Cell(30,8,$ris['req_date'],1,0,'C');
                $pdf ->Cell(30,8,$ris['rcv_date'],1,0,'C');
                $pdf ->Cell(15,8,$items['iss_no'],1,0,'C');
                $pdf ->Cell(25,8,$items['item_code'],1,0,'C');
                $pdf ->Cell(90,8,$items['particulars'],1,0,'C');
                $pdf ->Cell(15,8,$items['quantityReq'],1,0,'C');
                $pdf ->Cell(15,8,$items['unit'],1,0,'C');
                $pdf ->Cell(20,8,$items['price'],1,0,'C');
                $pdf ->Cell(20,8,number_format((float)$items['amount'], 2, '.', ','),1,0,'C');
                $pdf ->Cell(20,8,"",1,0,'C');
                $pdf ->Cell(50,8,$ris['office'],1,1,'C');
            }
        }
        $pdf ->Cell(30,8,'',1,0,'C');
        $pdf ->Cell(30,8,'',1,0,'C');
        $pdf ->Cell(15,8,'',1,0,'C');
        $pdf ->Cell(25,8,'',1,0,'C');
        $pdf ->Cell(90,8,'',1,0,'C');
        $pdf ->Cell(15,8,'',1,0,'C');
        $pdf ->Cell(15,8,'',1,0,'C');
        $pdf ->Cell(40,8,'TOTAL AMOUNT:','LTB',0,'R');
            $totalStmt = "SELECT SUM(quantityReq*price) AS total FROM tbl_ris_stockroom WHERE iss_no = '$ris[iss_no]'";
            $totalQuery = mysqli_query($conn, $totalStmt);
            $total = mysqli_fetch_assoc($totalQuery);
        $pdf ->Cell(20,8,number_format((float)$total['total'], 2, '.', ','),'TRB',0,'C');
        $pdf ->Cell(50,8,'',1,1,'C');
        
        $pdf ->Cell(30,8,'',1,0,'C');
        $pdf ->Cell(30,8,'',1,0,'C');
        $pdf ->Cell(15,8,'',1,0,'C');
        $pdf ->Cell(25,8,'',1,0,'C');
        $pdf ->Cell(90,8,'',1,0,'C');
        $pdf ->Cell(15,8,'',1,0,'C');
        $pdf ->Cell(15,8,'',1,0,'C');
        $pdf ->Cell(20,8,"",1,0,'C');
        $pdf ->Cell(20,8,"",1,0,'C');
        $pdf ->Cell(20,8,"",1,0,'C');
        $pdf ->Cell(50,8,'',1,1,'C');   
    }
}

}else{
    $_SESSION['alert'] = "Failed to View Issuance Report!";
    $_SESSION['alertCode'] = "warning";
    header("Location: stockroom-issuance-report.php");
    exit(0);
}
//output
$pdf -> Output();
?>