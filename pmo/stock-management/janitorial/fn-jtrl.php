<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
 }

 //Add Janitorial Particulars
 if(isset($_POST['addParticular'])){
     $particulars = $_POST['particulars'];
     $item_code = $_POST['item_code'];
     $stock_type = $_POST['stock_type'];
     $unit = $_POST['unit'];
     $order_level = $_POST['order_level'];
 
    $query = "INSERT INTO tbl_particulars_janitorial (particulars, item_code, stock_type, unit, order_level) VALUES ('$particulars', '$item_code', '$stock_type', '$unit', '$order_level')";
    $result = mysqli_query($conn, $query);
    if($result){
          $lastID = mysqli_insert_id($conn);
          $queryStock = "INSERT INTO tbl_stock_janitorial (id,particulars,unit,stock_type) VALUES ('$lastID','$particulars','$unit','$stock_type')";
          $resultStock = mysqli_query($conn, $queryStock);

          $auditDate = date('Y/m/d');
          $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                         VALUES ('$auditDate','Added Particular for Janitorial Supplies','$_SESSION[user_lvl]')";
          $auditResult = mysqli_query($conn, $auditQuery);
        if($resultStock){
          $_SESSION['alert'] = "New Particular Added!";
          $_SESSION['alertCode'] = "success";
          header("Location: jtrl-stocks.php?ref=$lastID");
          exit(0);
        }else{
          $_SESSION['alert'] = "Failed to add Particular!";
          $_SESSION['alertCode'] = "warning";
          header("Location: jtrl-particulars.php");
          exit(0);
        }
   }else{
          $_SESSION['alert'] = "Failed to add Particular!";
          $_SESSION['alertCode'] = "warning";
          header("Location: jtrl-particulars.php");
          exit(0);
   }
 }

 //Edit Janitorial Particulars
 if(isset($_POST['editParticular'])){
     $refid = $_POST['refid'];
     $particulars = $_POST['particulars'];
     $item_code = $_POST['item_code'];
     $unit = $_POST['unit'];
     $order_level = $_POST['order_level'];

     $query = "UPDATE tbl_particulars_janitorial SET particulars = '$particulars', item_code = '$item_code', unit = '$unit', order_level = '$order_level' WHERE id = '$refid' ";
     $result = mysqli_query($conn, $query);

     $auditDate = date('Y/m/d');
     $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                    VALUES ('$auditDate','Update Particular for Janitorial Supplies','$_SESSION[user_lvl]')";
     $auditResult = mysqli_query($conn, $auditQuery);
     if($result){
          $_SESSION['message'] = "Particular Updated";
          header("Location:jtrl-particulars.php");
          exit(0);
     }else{
          $_SESSION['message'] = "Particular Update Failed";
          header("Location:jtrl-particulars.php");
          exit(0);
     }
 }

 //Add Stock
 if(isset($_POST['addStock'])){
     $refid = $_POST['refid'];
     $particulars = $_POST['particulars'];
     $item_code = $_POST['item_code'];
     $stock_type = $_POST['stock_type'];
     $quantity = $_POST['quantity'];
     $unit = $_POST['unit'];
     $price = $_POST['price'];
     $date = $_POST['date'];

     $query = "INSERT INTO tbl_stock_janitorial (id,item_code,particulars,quantity,unit,stock_type,price,rem_qty,date) VALUES ('$refid','$item_code','$particulars','$quantity','$unit','$stock_type','$price', '$quantity', '$date')";
     $result = mysqli_query($conn, $query);

     $auditDate = date('Y/m/d');
     $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                    VALUES ('$auditDate','Added Stock for Janitorial Supplies','$_SESSION[user_lvl]')";
     $auditResult = mysqli_query($conn, $auditQuery);
     if($result){
          $_SESSION['alert'] = "New Stock Added!";
          $_SESSION['alertCode'] = "success";
          header("Location: jtrl-stocks.php?ref=$refid");
          exit(0);
     }else{
          $_SESSION['alert'] = "Failed to Add new Stock!";
          $_SESSION['alertCode'] = "warning";
          header("Location: jtrl-stocks.php?ref=$refid");
          exit(0);
     }
 }

 //Edit Stock
 if(isset($_POST['editStock'])){
     $uid = $_POST['uid'];
     $refid = $_POST['refid'];
     $quantityUpdt = $_POST['quantity'];
     $price = $_POST['price'];
     $date = $_POST['date'];

     $query = "SELECT * FROM tbl_stock_janitorial WHERE uid = '$uid'";
     $result = mysqli_query($conn, $query);
     $stock = mysqli_fetch_assoc($result);
     if($result){
          if($quantityUpdt >= $stock['quantity']){
               $pQTY = $quantityUpdt - $stock['quantity'];
               $pquery = "UPDATE tbl_stock_janitorial SET quantity = '$quantityUpdt', price = '$price', rem_qty = (rem_qty + '$pQTY'), date = '$date' WHERE uid = '$uid'";
               $presult = mysqli_query($conn, $pquery);

               $auditDate = date('Y/m/d');
               $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                              VALUES ('$auditDate','Update Stock for Janitorial Supplies','$_SESSION[user_lvl]')";
               $auditResult = mysqli_query($conn, $auditQuery);
               if($presult){
                    $_SESSION['alert'] = "Stock Updated Successfully";
                    $_SESSION['alertCode'] = "success";
                    header("Location: jtrl-stocks.php?ref=$refid");
                    exit(0);
               }else{
                    $_SESSION['alert'] = "Stock Update Failed";
                    $_SESSION['alertCode'] = "warning";
                    header("Location: edit-stock.php?ref=$uid");
                    exit(0);
               }
          }elseif ($quantityUpdt <= $stock['quantity']) {
               $mQTY = $stock['quantity'] - $quantityUpdt;
               $mquery = "UPDATE tbl_stock_janitorial SET quantity = '$quantityUpdt', price = '$price', rem_qty = (rem_qty - '$mQTY'), date = '$date' WHERE uid = '$uid'";
               $mresult = mysqli_query($conn, $mquery);

               $auditDate = date('Y/m/d');
               $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                              VALUES ('$auditDate','Update Stock for Janitorial Supplies','$_SESSION[user_lvl]')";
               $auditResult = mysqli_query($conn, $auditQuery);
               if($mresult){
                    $_SESSION['alert'] = "Stock Updated Successfully";
                    $_SESSION['alertCode'] = "success";
                    header("Location: jtrl-stocks.php?ref=$refid");
                    exit(0);
               }else{
                    $_SESSION['alert'] = "Stock Update Failed";
                    $_SESSION['alertCode'] = "warning";
                    header("Location: edit-stock.php?ref=$uid");
                    exit(0);
               }
          }else{
               $_SESSION['alert'] = "Stock Update Failed";
               $_SESSION['alertCode'] = "warning";
               header("Location: edit-stock.php?ref=$uid");
               exit(0);
          }
     }else{
          $_SESSION['alert'] = "Stock Update Failed";
          $_SESSION['alertCode'] = "warning";
          header("Location: edit-stock.php?ref=$uid");
          exit(0);
     }
}
?>