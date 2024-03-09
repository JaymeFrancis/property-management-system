<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
 }


//Generate Items
if(isset($_POST['generateItems'])){
    $remove = "TRUNCATE TABLE sample_order";
    $removeItems = mysqli_query($conn, $remove);
        if($removeItems){
        $date = date('F');  
        $query = "SELECT tbl_particulars_stockroom.*, (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) AS avail_stocks 
                FROM tbl_particulars_stockroom
                INNER JOIN tbl_stock_stockroom ON tbl_particulars_stockroom.particulars = tbl_stock_stockroom.particulars
                WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_stockroom WHERE tbl_particulars_stockroom.particulars = tbl_purchaseitems_stockroom.particulars AND tbl_purchaseitems_stockroom.month = '$date')
                GROUP BY particulars
                HAVING (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) <= tbl_particulars_stockroom.order_level";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            foreach($result as $items){
                $itemsQuery = "INSERT INTO sample_order (particulars, unit) VALUES ('$items[particulars]', '$items[unit]')";
                $itemsResult = mysqli_query($conn, $itemsQuery);
            }if($itemsResult){
                header("Location: generate-order.php");
                exit(0);
            }else{
                $_SESSION['alert'] = "There was a problem occured in generating purchase order!";
                $_SESSION['alertCode'] = "warning";
                header("Location: orders.php");
                exit(0);
            }
        }else{
            $_SESSION['alert'] = "There are no items to be generated!";
            $_SESSION['alertCode'] = "warning";
            header("Location: orders.php");
            exit(0);
        }
    }
}

 //AJAX Fill Form
 if(isset($_GET['p'])){
     $ref = $_GET['p'];
     $query = "SELECT unit FROM tbl_particulars_stockroom WHERE particulars = ?";
     
     $stmt = $conn->prepare($query);
     $stmt->bind_param("s", $ref);
     $stmt->execute();
     $stmt->store_result();
     $stmt->bind_result($unit);
     $stmt->fetch();
     $stmt->close();
     
     echo $unit;
}

//Add Item
if(isset($_POST['addItem'])){
    $particulars = $_POST['particulars'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];

    if(!empty($particulars) && !empty($quantity)){
        $query = "INSERT INTO sample_order (particulars, quantity, unit) VALUES ('$particulars', '$quantity', '$unit')";
        $result = mysqli_query($conn, $query);
        if($result){
            header("Location: generate-order.php");
            exit(0);
        }else{
            $_SESSION['alert'] = "There was a problem occured in adding item!";
            $_SESSION['alertCode'] = "warning";
            header("Location: generate-order.php");
            exit(0);
        }
    }else{
        $_SESSION['alert'] = "Please Enter Item Details!";
        $_SESSION['alertCode'] = "warning";
        header("Location: generate-order.php");
        exit(0);  
    }
}

//Remove Item
if(isset($_GET['remove'])){
    $id = $_GET['remove'];

    $query = "DELETE FROM sample_order WHERE id = '$id'";
    $result  = mysqli_query($conn, $query);
    if($result){
        header("Location: generate-order.php");
        exit(0);
    }else{
        $_SESSION['alert'] = "There was a problem in removing the item!";
        $_SESSION['alertCode'] = "warning";
        header("Location: generate-order.php");
        exit(0); 
    }
}

//Update Quantity
if(isset($_POST['update-item'])){
    $id = $_POST['id'];
    $particulars = $_POST['particulars'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];

    if(!empty($quantity) && $quantity != 0){
        $query = "UPDATE sample_order SET quantity = '$quantity' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if($result){
            header("Location: generate-order.php");
            exit(0);
        }else{
            $_SESSION['alert'] = "There was a problem in updating the quantity!";
            $_SESSION['alertCode'] = "warning";
            header("Location: generate-order.php");
            exit(0); 
        }
    }else{
        $_SESSION['alert'] = "Please Enter Quantity!";
        $_SESSION['alertCode'] = "warning";
        header("Location: generate-order.php");
        exit(0); 
    }
    
}

 //Generate Purchase Order
 if(isset($_GET['generateOrder'])){
    $month = date("F");
    $year = date("Y");

    $valItems = "SELECT quantity FROM sample_order WHERE quantity = 0 AND quantity = ''";
    $valResult = mysqli_query($conn, $valItems);
    if(mysqli_num_rows($valResult) > 0){
        $_SESSION['alert'] = "Please make sure you have filled all items with quantity!";
        $_SESSION['alertCode'] = "warning";
        header("Location: generate-order.php");
        exit(0);
    }else{
        $queryOrder = "SELECT * FROM sample_order";
        $row = mysqli_query($conn, $queryOrder);
        if(mysqli_num_rows($row) > 0){
            $query = "INSERT INTO tbl_purchase_stockroom (month, year) VALUES ('$month', '$year')";
            $result = mysqli_query($conn, $query);
            $lastID = mysqli_insert_id($conn);
            if($result){
                foreach($row as $rows){
                    $queryItems = "INSERT INTO tbl_purchaseitems_stockroom (id, particulars, quantity, unit, month, year) VALUES ('$lastID', '$rows[particulars]', '$rows[quantity]', '$rows[unit]', '$month', '$year')";
                    $resultItems = mysqli_query($conn, $queryItems);

                    $auditDate = date('Y/m/d');
                    $auditQuery = "INSERT INTO `audit_logs`(`date`, `activity`, `user`) 
                                    VALUES ('$auditDate','Generated Purchase Order for Stockroom Supplies','$_SESSION[user_lvl]')";
                    $auditResult = mysqli_query($conn, $auditQuery);
                    }if($resultItems){
                        $_SESSION['alert'] = "Purchase order items are generated successfuly!";
                        $_SESSION['alertCode'] = "success";
                        header("Location: orders.php");
                        exit(0);
                    }else{
                        $_SESSION['alert'] = "There was a problem occured in generating purchase order!";
                        $_SESSION['alertCode'] = "warning";
                        header("Location: orders.php");
                        exit(0);
                    }
            }else{
                $_SESSION['alert'] = "There was a problem occured in generating purchase orders!";
                $_SESSION['alertCode'] = "warning";
                header("Location: generate-order.php");
                exit(0);
            }
        }else{
            $_SESSION['alert'] = "There there are no items to be generated!";
            $_SESSION['alertCode'] = "warning";
            header("Location: generate-order.php");
            exit(0);
        }
    }
    
 }
?>