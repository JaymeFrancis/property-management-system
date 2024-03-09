<?php 
session_start();
require 'config.php';

//Login and Logout Functions

if (isset($_POST['login'])){
   $username = $_POST["username"];
   $password = $_POST["password"];

   $query = "SELECT * FROM tbl_users WHERE user_name = '$username' AND password = '$password'";
   $result = mysqli_query($conn, $query);

   if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)){
            $_SESSION["name"] = $row['fname'].' '.$row['lname'];
            $_SESSION["user_lvl"] = $row['user_lvl'];
            $_SESSION["ulvl_code"] = $row['ulvl_code'];
            if($row["ulvl_code"] == "pmo"){
               $auditDate = date('Y/m/d');
               $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                              VALUES ('$auditDate','Logged In','$_SESSION[user_lvl]')";
               $auditResult = mysqli_query($conn, $auditQuery);
               if(isset($_SESSION["ulvl_code"])){
                  $_SESSION['alert'] = "Welcome ".$_SESSION['name']." you are logged in as ".$_SESSION['user_lvl']." !";
                  $_SESSION['alertCode'] = "success";
                  header('location: pmo\dashboard\dboard\dashboard.php');
                  exit(0);
               }
            }elseif($row["ulvl_code"] == "auditor"){
               if(isset($_SESSION["ulvl_code"])){
                  header('location: auditor\dashboard\dboard\dashboard.php');
               }
            }else{
               $_SESSION['alert'] = "Not authorized!";
               $_SESSION['alertCode'] = "error";
               header("Location: index.php");
               exit(0);
            }
            
      }
   }else{
      $_SESSION['alert'] = "Wrong Username or Password!";
      $_SESSION['alertCode'] = "error";
      header("Location: index.php");
      exit(0);
   }
}

if (isset($_GET['log'])){
   $auditDate = date('Y/m/d');
   $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                  VALUES ('$auditDate','Logged Out','$_SESSION[user_lvl]')";
   $auditResult = mysqli_query($conn, $auditQuery);
   if($auditResult){
      unset($_SESSION["name"]);
      unset($_SESSION["user_lvl"]);
      header("location:index.php");
   }
}

//User Management Functions

if(isset($_POST['add-user'])){
    $emp_id = $_POST['emp_id'];
    $fname =  $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $user_lvl = $_POST['user_lvl'];

    $query = "INSERT INTO tbl_users (emp_id,fname,mname,lname,user_lvl) VALUES ('$emp_id','$fname','$mname','$lname','$user_lvl')";

    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION['message'] = "User Account Created Successfully";
        header("Location: manage-user.php");
        exit(0);
    }else{
        $_SESSION['message'] = "User Account Creation Failed";
        header("Location: manage-user.php");
        exit(0);
    }
}

if(isset($_POST['update-user'])){
    $id = $_POST['update_id']; 
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];

    $query = "UPDATE tbl_users SET emp_id='$id', fname='$fname', mname='$mname', lname='$lname' WHERE emp_id='$id'  ";
    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['message'] = "User Account Updated Successfully";
        header("Location: manage-user.php");
        exit(0);
    }else{
        $_SESSION['message'] = "User Account Update Failed";
        header("Location: manage-user.php");
        exit(0);
   }
}

if(isset($_POST['delete-user'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM tbl_users WHERE emp_id='$id'";
    $result = mysqli_query($conn, $query);

    if($result){
      $_SESSION['message'] = "User Account Deleted Successfully";
      header("Location: manage-user.php");
      exit(0);
    }else{
      $_SESSION['message'] = "User Account Deletion Failed";
      header("Location: manage-user.php");
      exit(0);
    }
}

//Stock Management Functions

if(isset($_POST['addParticulars'])){
   $particulars = $_POST['particulars'];
   $item_code = $_POST['item_code'];
   $stock_type = $_POST['stock_type'];
   $unit = $_POST['unit'];

   $query = "INSERT INTO tbl_particulars (particulars, item_code, stock_type, unit) VALUES ('$particulars', '$item_code', '$stock_type', '$unit')";
   $result = mysqli_query($conn, $query);
   if($result){
      $_SESSION['message'] = "New Particular Added";
      header("Location: particulars.php");
      exit(0);
  }else{
      $_SESSION['message'] = "Particular Addition Failed";
      header("Location: particulars.php");
      exit(0);
  }
}

if(isset($_POST['edit-particulars'])){
   $id = $_POST['update-id'];
   $particulars = $_POST['particulars'];
   $item_code = $_POST['item_code'];
   $stock_type = $_POST['stock_type'];
   $unit = $_POST['unit'];

   $query = "UPDATE tbl_particulars SET particulars='$particulars', item_code='$item_code', stock_type='$stock_type', unit='$unit' WHERE id = '$id'";
   $result = mysqli_query($conn, $query);
   if($result){
      $_SESSION['message'] = "Particular Updated";
      header("Location: particulars.php");
      exit(0);
  }else{
      $_SESSION['message'] = "Particular Update Failed";
      header("Location: particulars.php");
      exit(0);
  }
}

if(isset($_POST['add-stock'])){
   $item_code = $_POST['item_code'];
   $particulars =  $_POST['particulars'];
   $quantity = $_POST['quantity'];
   $unit = $_POST['unit'];
   $stock_type = $_POST['stock_type'];
   $price = $_POST['price'];
   $order_level = $_POST['order_level'];
   $date = $_POST['date'];

   
   $countItemCode = "SELECT COUNT(item_code) FROM tbl_stock WHERE item_code LIKE '%$item_code%'";
   $count = mysqli_query($conn, $countItemCode);
   $row = mysqli_fetch_column($count);
   

   if($row>=1){
      $query = "INSERT INTO tbl_stock (item_code,particulars,quantity,unit,stock_type,price,rem_qty,order_level,date) VALUES ( CONCAT('$item_code', CHAR('$row' + 96)),'$particulars','$quantity','$unit','$stock_type','$price', '$quantity', '$order_level', '$date')";
      $result = mysqli_query($conn, $query);
   
      if($result){
          $_SESSION['message'] = "Stock Added Successfully";
          header("Location: stock-management.php?id=$item_code");
          exit(0);
      }else{
          $_SESSION['message'] = "Stock Addition Failed";
          header("Location: particulars.php");
          exit(0);
      }
   }elseif($row == 0){
      $query = "INSERT INTO tbl_stock (item_code,particulars,quantity,unit,stock_type,price,rem_qty,order_level,date) VALUES ('$item_code','$particulars','$quantity','$unit','$stock_type','$price', '$quantity', '$order_level', '$date')";
      $result = mysqli_query($conn, $query);
   
         if($result){
            $_SESSION['message'] = "Stock Added Successfully";
            header("Location: stock-management.php?id='%$item_code%'");
            exit(0);
         }else{
            $_SESSION['message'] = "Stock Addition Failed";
            header("Location: particulars.php");
            exit(0);
         }
   }
 
}

if(isset($_POST['edit-stock'])){
   $update_code = $_POST['item_code'];
   $particulars =  $_POST['particulars'];
   $quantity = $_POST['quantity'];
   $stock_type = $_POST['stock_type'];
   $unit = $_POST['unit'];
   $price = $_POST['price'];
   $order_level = $_POST['order_level'];
   $date = $_POST['date'];

   $query = "UPDATE tbl_stock SET particulars='$particulars', quantity='$quantity', stock_type='$stock_type', unit='$unit', price='$price', rem_qty='$quantity', order_level='$order_level', date='$date' WHERE item_code='$update_code' ";
   $result = mysqli_query($conn,$query);

   if($result){
      $_SESSION['message'] = "Stock Updated";
      header("Location: stock-management.php?id=$update_code");
      exit(0);
   }else{
      $_SESSION['message'] = "Stock Update Failed";
      header("Location: stock-management.php?id=$update_code");
      exit(0);
  }
}

//Purchase Order Functions

if(isset($_POST['addPurchaseOrder'])){
   $id = $_POST['purchaseOrder_id'];

   $query = "INSERT INTO purchase (purchaseID) VALUES ('$id')";
   $result = mysqli_query($conn, $query);
   if($result){
      $_SESSION['message'] = "Purchase Order Added";
      header("Location: purchase-order.php");
      exit(0);
   }else{
      $_SESSION['message'] = "Purchase Order Addition Failed";
      header("Location: purchase-order.php");
      exit(0);
   }
}

if(isset($_POST['add-purchaseOrderItem'])){
   $particulars =  $_POST['particulars'];
   $quantity =  $_POST['quantity'];
   $unit =  $_POST['unit'];
   $purchaseID =  $_POST['purchaseID'];

   $query = "INSERT INTO purchase_order (particulars, quantity, unit, purchaseID) VALUES ('$particulars', '$quantity', '$unit', '$purchaseID')";
   $result = mysqli_query($conn, $query);
   if($result){
      $_SESSION['message'] = "Purchase Order Added";
      header("Location: purchase-order-management.php?id=$purchaseID");
      exit(0);
   }else{
      $_SESSION['message'] = "Purchase Order Addition Failed";
      header("Location: purchase-order-management.php?id=$purchaseID");
      exit(0);
   }
}

if(isset($_POST['edit-purchaseOrder'])){
   $particulars = $_POST['update_particulars']; 
   $quantity = $_POST['quantity'];
   $unit = $_POST['unit'];

   $query = "UPDATE purchase_order SET particulars='$particulars', quantity='$quantity', unit='$unit' WHERE particulars='$particulars' ";
   $result = mysqli_query($conn, $query);

   if($result){
       $_SESSION['message'] = "Purchase Order Updated Successfully";
       header("Location: purchase-order.php");
       exit(0);
   }else{
       $_SESSION['message'] = "Purchase Order Update Failed";
       header("Location: purchase-order.php");
       exit(0);
  }
}

if(isset($_POST['delete-order'])){
   $id = $_POST['delete_order'];

   $query = "DELETE FROM purchase_order WHERE particulars='$id'";
   $result = mysqli_query($conn, $query);

   if($result){
     $_SESSION['message'] = "Order Deleted Successfully";
     header("Location: purchase-order.php");
     exit(0);
   }else{
     $_SESSION['message'] = "Order Deletion Failed";
     header("Location: purchase-order.php");
     exit(0);
   }
}

//Inventory Functions
if(isset($_POST['add-inventory'])){
   $mr_no = $_POST['mr_no'];
   $invoice = $_POST['invoice'];
   $po = $_POST['po'];
   $particulars = $_POST['particulars'];
   $supplier = $_POST['supplier'];
   $date = $_POST['date'];
   $location = $_POST['location'];
   $recipient = $_POST['recipient'];
   $quantity = $_POST['quantity'];
   $unit = $_POST['unit'];
   $price = $_POST['price'];
   
   

   $query = "INSERT INTO tbl_inventory (mr_no, invoice, po, particulars, supplier, date, quantity, unit, price, location, recipient)
            VALUES ('$mr_no', '$invoice', '$po', '$particulars', '$supplier', '$date', '$quantity', '$unit', '$price', '$location', '$recipient')"; 

   $result = mysqli_query($conn, $query);
   if($result){
      $_SESSION['message'] = "New Item Added";
      header("Location: inventory.php");
      exit(0);
   }else{
      $_SESSION['message'] = "Item Addition Failed";
      header("Location: inventory.php");
      exit(0);
   }
}

if(isset($_POST['edit-inventory'])){
   $mr_no = $_POST['mr_no'];
   $invoice = $_POST['invoice'];
   $po = $_POST['po'];
   $particulars = $_POST['particulars'];
   $supplier = $_POST['supplier'];
   $date = $_POST['date'];
   $location = $_POST['location'];
   $recipient = $_POST['recipient'];
   $quantity = $_POST['quantity'];
   $unit = $_POST['unit'];
   $price = $_POST['price'];
   

   $query = "UPDATE tbl_inventory SET invoice='$invoice', po='$po', particulars='$particulars', supplier='$supplier', date='$date', quantity='$quantity', unit='$unit', price='$price', location='$location', recipient='$recipient' WHERE mr_no='$mr_no' ";
   $result = mysqli_query($conn, $query);

   if($result){
       $_SESSION['message'] = "Item Information Updated Successfully";
       header("Location: equip-fixtures.php");
       exit(0);
   }else{
       $_SESSION['message'] = "Item Information Update Failed";
       header("Location: equip-fixtures.php");
       exit(0);
  }
}

//Request Issuance Funtions

if(isset($_POST['addRequest'])){
   $req_id = $_POST['req_id'];
   $requestor = $_POST['requestor'];
   $office = $_POST['office'];
   $date = $_POST['date'];

   $query = "INSERT INTO tbl_req (req_id, requestor, office) VALUES ('$req_id', '$requestor', '$office')";
   $result = mysqli_query($conn, $query);

   if($result){
      $_SESSION['message'] = "New Request Added";
      header("Location: requests.php");
      exit(0);
   }else{
      $_SESSION['message'] = "Request Addition Failed";
      header("Location: requests.php");
      exit(0);
   }
}

if(isset($_POST['editRequest'])){
   $update_id = $_POST['update_id'];
   $req_id = $_POST['req_id'];
   $requestor = $_POST['requestor'];
   $office = $_POST['office'];
   $date = $_POST['date'];

   $query = "UPDATE tbl_req SET req_id='$req_id', requestor='$requestor', office='$office' WHERE id = '$update_id' ";
   $result = mysqli_query($conn, $query);

   if($result){
      $_SESSION['message'] = "Request Updated Successful";
      header("Location: requests.php");
      exit(0);
   }else{
      $_SESSION['message'] = "Request Update Failed";
      header("Location: requests.php");
      exit(0);
   }
}

if(isset($_POST['addIssuance'])){
   $req_id = $_POST['req_id'];
   $item_code = $_POST['item_code'];
   $particulars = $_POST['particulars'];
   $quantity = $_POST['quantity'];
   $quantityDeduct = $_POST['quantityDeduct'];
   $unit = $_POST['unit'];
   $req_date = $_POST['req_date'];


   if($quantityDeduct > $quantity){
      $_SESSION['message'] = "Requested Quantity of Item is more than the available Stock";
      header("Location: request-issuance-management.php?id=$req_id");
      exit(0);
   }else{
      $query = "INSERT INTO tbl_ris (req_id, particulars, item_code, quantityDeduct, unit, req_date) VALUES ('$req_id','$particulars', '$item_code', '$quantityDeduct', '$unit', '$req_date')";
      //$query1 = "UPDATE tbl_stock SET quantity = quantity - '$quantityDeduct' WHERE item_code = '$item_code'";
   
      $result = mysqli_query($conn, $query);
      //$result1 = mysqli_query($conn, $query1);
      if($result){
         $_SESSION['message'] = "New Issuance Added";
         header("Location: request-issuance-management.php?id=$req_id");
         exit(0);
      }else{
         $_SESSION['message'] = "Item Addition Failed";
         header("Location: request-issuance-management.php?id=$req_id");
         exit(0);
      }
   }
   
}


if(isset($_GET['p'])){
$ref = $_GET['p'];
$query = "SELECT item_code FROM tbl_stock WHERE particulars = '$ref' AND rem_qty > 0";
$result = mysqli_query($conn, $query);

while(list($item_code) = mysqli_fetch_row($result)){
echo '<option selected disabled hidden>Select Item Code</option>';
echo '<option value"'.$item_code.'">'.$item_code.'</option>';
}
}

if(isset($_GET['q'])){
   $ref = $_GET['q'];
   $query = "SELECT  rem_qty, unit FROM tbl_stock WHERE item_code = ?";
   
   $stmt = $conn->prepare($query);
   $stmt->bind_param("s", $ref);
   $stmt->execute();
   $stmt->store_result();
   $stmt->bind_result($quantity, $unit);
   $stmt->fetch();
   $stmt->close();
   
  echo $quantity.'|'.$unit;
}

//Deduction
if(isset($_GET['reqID'])){
   $req_id = $_GET['reqID'];

   $query = "SELECT * FROM tbl_ris WHERE req_id = '$req_id'";
   $result = mysqli_query($conn, $query);

   if(mysqli_num_rows($result) > 0){
      foreach($result as $issuance){
         $deductQuery = "UPDATE tbl_stock SET issuance_qty=(issuance_qty + '$issuance[quantityDeduct]'), rem_qty=(rem_qty - '$issuance[quantityDeduct]') WHERE item_code = '$issuance[item_code]'";
         $deductResult = mysqli_query($conn, $deductQuery);

         $saveQuery = "UPDATE tbl_ris SET rcv_date = CURDATE()";
         $saveResult = mysqli_query($conn, $saveQuery);

      }if($deductResult){

         $statusQuery = "UPDATE tbl_req SET status = 'Issued'";
         $statusResult = mysqli_query($conn, $statusQuery);

         }if($statusResult){

            $_SESSION['message'] = "Items Issued Succesfuly";
            header("Location: view-issued.php?id=$req_id");
            exit(0);

         }else{

         $_SESSION['message'] = "Item Issuance Failed";
         header("Location: request-issuance-management.php?id=$req_id");
         exit(0);

         }
   }else{
         $_SESSION['message'] = "Item Issuance Failed";
         header("Location: request-issuance-management.php?id=$req_id");
         exit(0);
   }
}


?>