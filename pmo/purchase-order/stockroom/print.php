<?php
//include library
include('../../../assets/fpdf/fpdf.php');
require '../../../config.php'; 

//make Object
$pdf = new FPDF('P', 'mm', 'Legal');
$pdf -> setMargins(12.5,10);
$pdf ->AddFont('SLC','','OldEnglish.php');

//add page
$pdf -> AddPage();

//Header;
$pdf ->Image('../../../assets/images/logo-bw.png',30,10,20,20);

$pdf -> setFont('SLC', '', 20);
$pdf ->Cell(60,8,"",0,0,'C');
$pdf ->Cell(70,8,"Saint Louis College",0,0,'C');
$pdf ->Cell(30,8,"",0,0);
$pdf -> setFont('Arial', '', 5);
$pdf ->Cell(30,5,"Reference Code: #####",1,1,'L','','','',true);


$pdf ->Cell(160,5,'',0,0);
$pdf ->Cell(30,5,"Revision Number: 0",1,1,'L','','','',true);

$pdf -> setFont('Arial', '', 12);
$pdf ->Cell(60,5,"",0,0,'C');
$pdf ->Cell(70,5,"City of San Fernando, La Union",0,0,'C');
$pdf ->Cell(30,8,"",0,0);
$pdf -> setFont('Arial', '', 5);
$pdf ->Cell(30,5,"Effective Date: ".date('F d, Y'),1,1,'L');
$pdf ->Ln(10);

//add content
if(isset($_GET['print'])){
    $id = $_GET['print'];
    $query0 = "SELECT * FROM tbl_purchase_stockroom WHERE id = '$id'";
    $result0 = mysqli_query($conn, $query0);
    $dates = mysqli_fetch_assoc($result0);

    if(mysqli_num_rows($result0)>0){
        $pdf -> setFont('Arial', 'BU', 14);
        $pdf ->Cell(190,10,"NEED TO REQUEST FOR STOCKROOM SUPPLIES (".$dates['month']." ".$dates['year'].")",0,1,'C');
        $pdf ->Ln(5);

        $pdf ->setFont('Arial','B',12);
        $pdf ->Cell(40,10,'Quantity',1,0,'C');
        $pdf ->Cell(40,10,'Units',1,0,'C');
        $pdf ->Cell(110,10,'Particulars',1,1,'C');
    
        $query = "SELECT * FROM tbl_purchaseitems_stockroom WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($result)>0){
            foreach($result as $order){
                $pdf ->setFont('Arial','',12);
                $pdf ->Cell(40,10,$order['quantity'],1,0,'C');
                $pdf ->Cell(40,10,$order['unit'],1,0,'C');
                $pdf ->Cell(110,10,$order['particulars'],1,1,'C');
            }
        }
      
            $pdf ->Cell(40,10,'',1,0);
            $pdf ->Cell(40,10,'',1,0);
            $pdf ->Cell(110,10,'',1,1);

            $pdf ->setTextColor(255, 0, 0);
            $pdf ->Cell(190,10,'As of '.date('F d, Y',strtotime($dates['date'])),1,1,'C');
            $pdf ->Ln(10);
    }
}

//Footer
$pdf ->setTextColor(0, 0, 0);
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