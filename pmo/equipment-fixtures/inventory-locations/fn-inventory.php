<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
}

if(isset($_POST['move-item'])){
    $id = $_POST['id'];
    $dot = $_POST['date'];
    $newLoc = $_POST['newLoc'];
    $recipient = $_POST['recipient'];
    $quantity = $_POST['quantity'];
    $position = $_POST['position'];
    $trans_loc = $_POST['trans_loc'];

    $loc = "SELECT * FROM tbl_location WHERE locID = '$newLoc'";
    $locRes = mysqli_query($conn, $loc);
    $location = mysqli_fetch_assoc($locRes);

    $stmtQty = "SELECT * FROM tbl_inventory WHERE id = '$id'";
    $queryQty = mysqli_query($conn, $stmtQty);
    $resultQty = mysqli_fetch_assoc($queryQty);


    if($quantity > $resultQty['quantity']){
        $_SESSION['alert'] = "Please enter quantity not more than ".$resultQty['quantity']."!";
        $_SESSION['alertCode'] = "warning";
        header("Location: multi-assign.php");
        exit(0);
    }elseif($quantity == $resultQty['quantity']){
        $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$dot', '$recipient', '$position')";
        $mr_result = mysqli_query($conn, $mr_query);
        $lastMR = mysqli_insert_id($conn);

        $queryEql = "UPDATE tbl_inventory SET mr_no = '$lastMR', locID = '$location[locID]', locations = '$location[locations]', recipient = '$recipient', date_moved = '$dot' WHERE id = '$id'";
        $resultEql = mysqli_query($conn, $queryEql);

        $transQuery = "INSERT INTO `trans_history`( `trans_id`, `mr_no`, `particulars`, `quantity`, `unit`, `trans_date`, `date_moved`, `locations`) 
                        VALUES ('$id','$lastMR','$resultQty[particulars]','$resultQty[quantity]','$resultQty[unit]','$resultQty[date_moved]','$dot','$resultQty[locations]')";
        $transResult = mysqli_query($conn, $transQuery);

        $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                    SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                    FROM tbl_inventory WHERE mr_no = '$lastMR'";
        $mrResult = mysqli_query($conn, $mrQuery);
        if($mrResult){
            $_SESSION['alert'] = "Equipment Successfuly Transferred!";
            $_SESSION['alertCode'] = "success";
            header("Location: ../inventory-locations/view-inventory.php?locID=$newLoc");
            exit(0);
        }
    }elseif($quantity < $resultQty['quantity']){
        $queryDeduct = "UPDATE tbl_inventory SET quantity = ('$resultQty[quantity]' - '$quantity') WHERE id = '$id'";
        $resultDeduct = mysqli_query($conn, $queryDeduct);
        if($queryDeduct){
            $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$dot', '$recipient', '$position')";
            $mr_result = mysqli_query($conn, $mr_query);
            $lastMR = mysqli_insert_id($conn);

            $queryMove = "INSERT INTO tbl_inventory (mr_no, invoice, po, particulars, supplier, date, quantity, unit, price, locID, locations, recipient, date_moved)
                            VALUES ('$lastMR', '$resultQty[invoice]', '$resultQty[po]', '$resultQty[particulars]', '$resultQty[supplier]', '$resultQty[date]', '$quantity', '$resultQty[unit]', '$resultQty[price]', '$location[locID]', '$location[locations]', '$recipient', '$dot')";
            $resultMove = mysqli_query($conn, $queryMove);
            $lastID = mysqli_insert_id($conn);

            $transQuery = "INSERT INTO `trans_history`( `trans_id`, `mr_no`, `particulars`, `quantity`, `unit`, `trans_date`, `date_moved`, `locations`) 
                        VALUES ('$lastID','$lastMR','$resultQty[particulars]','$resultQty[quantity]','$resultQty[unit]','$resultQty[date_moved]','$dot','$resultQty[locations]')";
            $transResult = mysqli_query($conn, $transQuery);

            $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                        SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                        FROM tbl_inventory WHERE mr_no = '$lastMR'";
            $mrResult = mysqli_query($conn, $mrQuery);
            if($mrResult){
                $_SESSION['alert'] = "Equipment Successfuly Transferred!";
                $_SESSION['alertCode'] = "success";
                header("Location: ../inventory-locations/view-inventory.php?locID=$newLoc");
                exit(0);
            }
        }
    }
}

if(isset($_POST['surrender-equipment'])){
    $id = $_POST['id'];
    $mr_no = $_POST['mr_no'];
    $particulars = $_POST['particulars'];
    $surr_by = $_POST['surr_by'];
    $status = $_POST['status'];
    $date_surr = $_POST['date_surr'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];


    $stmtQty = "SELECT * FROM tbl_inventory WHERE id = '$id'";
    $queryQty = mysqli_query($conn, $stmtQty);
    $resultQty = mysqli_fetch_assoc($queryQty);

    if($quantity > $resultQty['quantity']){
        $_SESSION['alert'] = "Please enter quantity not more than ".$resultQty['quantity']."!";
        $_SESSION['alertCode'] = "warning";
        header("Location: surrender-form.php?ref=$id");
        exit(0);
    }elseif($quantity == $resultQty['quantity']){

        $queryEql = "UPDATE tbl_inventory SET status = '$status', locID = '', locations = '', recipient = '$surr_by', date_moved = '$date_surr' WHERE id = '$id'";
        $resultEql = mysqli_query($conn, $queryEql);

        $surrQuery = "INSERT INTO `surrender_equip`( `surr_id`, `mr_no`, `particulars`, `quantity`, `unit`, `date`, `surrendered_by`, `locations`, `status`) 
                    VALUES ('$id','$mr_no','$particulars','$quantity','$unit','$date_surr','$surr_by','$location','$status')";
        $surrResult = mysqli_query($conn, $surrQuery);
        if($surrResult){
            $_SESSION['alert'] = "Equipment Surrendered!";
            $_SESSION['alertCode'] = "success";
            header("Location: ../surrender-form/surrender.php");
            exit(0);
        }
    }elseif($quantity < $resultQty['quantity']){
        $queryDeduct = "UPDATE tbl_inventory SET quantity = ('$resultQty[quantity]' - '$quantity') WHERE id = '$id'";
        $resultDeduct = mysqli_query($conn, $queryDeduct);
        if($queryDeduct){

            $queryMove = "INSERT INTO tbl_inventory (mr_no, invoice, po, particulars, supplier, date, quantity, unit, price, locID, locations, recipient, status, date_moved)
                            VALUES ('$resultQty[mr_no]', '$resultQty[invoice]', '$resultQty[po]', '$resultQty[particulars]', '$resultQty[supplier]', '$resultQty[date]', '$quantity', '$resultQty[unit]', '$resultQty[price]', '', '', '$surr_by', '$status', '$date_surr')";
            $resultMove = mysqli_query($conn, $queryMove);
            $lastID = mysqli_insert_id($conn);

            $surrQuery = "INSERT INTO `surrender_equip`(`surr_id`, `mr_no`, `particulars`, `quantity`, `unit`, `date`, `surrendered_by`, `locations`, `status`) 
                    VALUES ('$lastID','$mr_no','$particulars','$quantity','$unit','$date_surr','$surr_by','$location','$status')";
            $surrResult = mysqli_query($conn, $surrQuery);
            if($surrResult){
                $_SESSION['alert'] = "Equipment Successfuly Transferred!";
                $_SESSION['alertCode'] = "success";
                header("Location: ../surrender-form/surrender.php");
                exit(0);
            }
        }
    }
}
?>