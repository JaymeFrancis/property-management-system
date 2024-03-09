<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
 }

 //New Issuance
 if(isset($_POST['newIssuance'])){
    $recipient = $_POST['recipient'];
    $locID= $_POST['locID'];
    $reqdate = $_POST['req_date'];

    $locStmt = "SELECT * FROM tbl_location WHERE locID = $locID";
    $locQuery = mysqli_query($conn, $locStmt);
    $office = mysqli_fetch_assoc($locQuery);

    $query = "INSERT INTO tbl_request_janitorial (recipient, office, req_date) VALUES ('$recipient', '$office[locations]', '$reqdate')";
    $result = mysqli_query($conn, $query);
    $lastID = mysqli_insert_id($conn);

    $auditDate = date('Y/m/d');
    $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                  VALUES ('$auditDate','Added Issuance for Janitorial Supplies','$_SESSION[user_lvl]')";
    $auditResult = mysqli_query($conn, $auditQuery);
    if($result){
      $_SESSION['alert'] = "New Issuance Added";
      $_SESSION['alertCode'] = "success";
      header("Location: issued-items.php?ref=$lastID");
      exit(0);
   }else{
      $_SESSION['alert'] = "There was a problem occured when recording issuance details!";
      $_SESSION['alertCode'] = "warning";
      header("Location: requests.php");
      exit(0);
   }
 }

 //Edit Issuance
 if(isset($_POST['editIssuance'])){
    $refid = $_POST['iss_no'];
    $recipient = $_POST['recipient'];
    $office = $_POST['office'];
    $date = $_POST['req_date'];

    $query = "UPDATE tbl_request_janitorial SET recipient = '$recipient', office = '$office', req_date = '$date' WHERE iss_no = '$refid'";
    $result = mysqli_query($conn, $query);

   $auditDate = date('Y/m/d');
   $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                  VALUES ('$auditDate','Update Issuance for Janitorial Supplies','$_SESSION[user_lvl]')";
   $auditResult = mysqli_query($conn, $auditQuery);
    if($result){
      $_SESSION['alert'] = "Issuance Updated";
      $_SESSION['alertCode'] = "success";
      header("Location: requests.php");
      exit(0);
   }else{
      $_SESSION['alert'] = "There was a problem occured when updating issuance details!";
      $_SESSION['alertCode'] = "warning";
      header("Location: requests.php");
      exit(0);
   }
 }


 //AJAX Fill Form
 if(isset($_GET['p'])){
    $ref = $_GET['p'];
    $query = "SELECT item_code FROM tbl_stock_janitorial WHERE particulars = '$ref' AND rem_qty > 0";
    $result = mysqli_query($conn, $query);
    
    while(list($item_code) = mysqli_fetch_row($result)){
    echo '<option value="" selected disabled hidden>Select Item Code</option>';
    echo '<option value"'.$item_code.'">'.$item_code.'</option>';
    }
    }
    
if(isset($_GET['q'])){
     $ref = $_GET['q'];
     $query = "SELECT rem_qty, unit, price FROM tbl_stock_janitorial WHERE item_code = ?";
     
     $stmt = $conn->prepare($query);
     $stmt->bind_param("s", $ref);
     $stmt->execute();
     $stmt->store_result();
     $stmt->bind_result($quantity, $unit, $price);
     $stmt->fetch();
     $stmt->close();
     
     echo $quantity.'|'.$unit.'|'.$price;
}

//Add Items
if(isset($_POST['addItem'])){
   $refid = $_POST['refid'];
   $item_code = $_POST['item_code'];
   $particulars = $_POST['particulars'];
   $quantity = $_POST['quantity'];
   $price = $_POST['price'];
   $quantityReq = $_POST['quantityReq'];
   $unit = $_POST['unit'];


   if($quantityReq > $quantity){
      $_SESSION['alert'] = "Requested Quantity of Item is more than the available Stock";
      $_SESSION['alertCode'] = "warning";
      header("Location: add-items.php?ref=$refid");
      exit(0);
   }else{
      $query = "INSERT INTO tbl_ris_janitorial (iss_no, particulars, item_code, quantityReq, unit, price) VALUES ('$refid','$particulars', '$item_code', '$quantityReq', '$unit', '$price')";
      $result = mysqli_query($conn, $query);
      if($result){
         $query1 = "UPDATE tbl_stock_janitorial SET rem_qty = rem_qty - '$quantityReq' WHERE item_code = '$item_code'";
         $result1 = mysqli_query($conn, $query1);
         if($result1){
            $_SESSION['alert'] = "Item Issuance Added";
            $_SESSION['alertCode'] = "success";
            header("Location: issued-items.php?ref=$refid");
            exit(0);
         }else{
            $_SESSION['alert'] = "Item not deducted from Stocks";
            $_SESSION['alertCode'] = "danger";
            header("Location: issued-items.php?ref=$refid");
            exit(0);
            }
      }else{
         $_SESSION['alert'] = "Item Issuance not Added";
         $_SESSION['alertCode'] = "danger";
         header("Location: issued-items.php?ref=$refid");
         exit(0);
      } 
   }
}

//Remove Items
if(isset($_GET['remove'])){
   $id = $_GET['remove'];

   $query = "SELECT * FROM tbl_ris_janitorial WHERE id = '$id'";
   $result = mysqli_query($conn, $query);
   $item = mysqli_fetch_assoc($result);
   $refid = $item['iss_no'];
   $item_code = $item['item_code'];
   $quantityReq = $item['quantityReq'];
   if($result){
      $query1 = "UPDATE tbl_stock_janitorial SET rem_qty = rem_qty + '$quantityReq' WHERE item_code = '$item_code'";
      $result1 = mysqli_query($conn, $query1);
      if($result1){
         $query2 = "DELETE FROM tbl_ris_janitorial WHERE id = $id";
         $result2 = mysqli_query($conn, $query2);
         if($result2){
            $_SESSION['alert'] = "Item Deleted";
            $_SESSION['alertCode'] = "success";
            header("Location: issued-items.php?ref=$refid");
            exit(0);
         }else{
            $_SESSION['alert'] = "There was a problem occured when removing the item!";
            $_SESSION['alertCode'] = "warning";
            header("Location: issued-items.php?ref=$refid");
            exit(0);
         }
      }else{
         $_SESSION['alert'] = "There was a problem occured when removing the item!";
         $_SESSION['alertCode'] = "warning";
         header("Location: issued-items.php?ref=$refid");
         exit(0);
      }
   }else{
      $_SESSION['alert'] = "There was a problem occured when removing the item!";
      $_SESSION['alertCode'] = "warning";
      header("Location: issued-items.php?ref=$refid");
      exit(0);
   }
}

//Release Issuance
if(isset($_GET['releaseID'])){
     $rel_id = $_GET['releaseID'];
  
     $query = "SELECT * FROM tbl_ris_janitorial WHERE iss_no = '$rel_id'";
     $result = mysqli_query($conn, $query);
  
     if(mysqli_num_rows($result) > 0){
        foreach($result as $issuance){
           $issuanceQuery = "UPDATE tbl_stock_janitorial SET issuance_qty=(issuance_qty + '$issuance[quantityReq]') WHERE item_code = '$issuance[item_code]' AND particulars = '$issuance[particulars]'";
           $issuanceResult = mysqli_query($conn, $issuanceQuery);
  
        }if($issuanceResult){
         $statusQuery = "UPDATE tbl_request_janitorial SET status = 'Issued', rcv_date = CURDATE() WHERE iss_no = '$rel_id'";
         $statusResult = mysqli_query($conn, $statusQuery);

         $auditDate = date('Y/m/d');
         $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                        VALUES ('$auditDate','Released Issuance for Janitorial Supplies','$_SESSION[user_lvl]')";
         $auditResult = mysqli_query($conn, $auditQuery);
         if($statusResult){
            $_SESSION['alert'] = "Issued items has been released!";
            $_SESSION['alertCode'] = "success";
            header("Location: view-issued.php?ref=$rel_id");
            exit(0);
         }else{
            $_SESSION['alert'] = "There was a problem occured when releasing the issuance! -4 ";
            $_SESSION['alertCode'] = "warning";
            header("Location: requests.php");
            exit(0);
         }
      }else{
         $_SESSION['alert'] = "There was a problem occured when releasing the issuance! -3 ";
         $_SESSION['alertCode'] = "warning";
         header("Location: requests.php");
         exit(0);
      }
     }else{
      $_SESSION['alert'] = "There are to Items to release!";
      $_SESSION['alertCode'] = "warning";
      header("Location: issued-items.php?ref=$rel_id");
      exit(0);
     }
  }
?>