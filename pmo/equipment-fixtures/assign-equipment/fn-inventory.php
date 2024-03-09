<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
}


//Assign Item Location
if(isset($_POST['assign-item'])){
    $locID = $_POST['locID'];
    $recipient = $_POST['recipient'];
    $position = $_POST['position'];
    $date = date('Y/m/d');

    if($_POST['id'] > 0){
        $loc = "SELECT * FROM tbl_location WHERE locID = '$locID'";
        $locRes = mysqli_query($conn, $loc);
        $location = mysqli_fetch_assoc($locRes);

        $checked_array = $_POST['id'];
        foreach($_POST['refid'] as $key => $value){
            if(in_array($_POST['refid'][$key], $checked_array)){
                $id = $_POST['refid'][$key];
                $quantity = $_POST['quantity'][$key];


                $stmtQty = "SELECT * FROM tbl_inventory WHERE id = '$id'";
                $queryQty = mysqli_query($conn, $stmtQty);
                $resultQty = mysqli_fetch_assoc($queryQty);

                if($quantity == $resultQty['quantity']){
                    if($resultQty['quantity'] == 1){
                        // echo 'Quantity = 1 <br>';
                        // echo  $id.'<br>';
                        // echo  $quantity.'<br><br>';
                        $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$date', '$recipient', '$position')";
                        $mr_result = mysqli_query($conn, $mr_query);
                        $lastMR = mysqli_insert_id($conn);
            
                        $queryEql = "UPDATE tbl_inventory SET mr_no = '$lastMR', locID = '$location[locID]', locations = '$location[locations]', recipient = '$recipient', date_moved = '$date' WHERE id = '$id'";
                        $resultEql = mysqli_query($conn, $queryEql);
            
                        $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                                    SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                                    FROM tbl_inventory WHERE mr_no = '$lastMR'";
                        $mrResult = mysqli_query($conn, $mrQuery);

                    }elseif($resultQty['quantity'] > 1){
                        // echo 'Quantity = && > 1 <br>';
                        // echo  $id.'<br>';
                        // echo  '1 <br><br>';
                        $mr_query1 = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$date', '$recipient', '$position')";
                        $mr_result1 = mysqli_query($conn, $mr_query1);
                        $lastMR1 = mysqli_insert_id($conn);
            
                        $queryEql1 = "UPDATE tbl_inventory SET mr_no = '$lastMR1', quantity = 1, locID = '$location[locID]', locations = '$location[locations]', recipient = '$recipient', date_moved = '$date' WHERE id = '$id'";
                        $resultEql1 = mysqli_query($conn, $queryEql1);
            
                        $mrQuery1 = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                                    SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                                    FROM tbl_inventory WHERE mr_no = '$lastMR'";
                        $mrResult1 = mysqli_query($conn, $mrQuery1);

                        for ($i = 0; $i < $quantity - 1; $i++ ) {
                            // echo 'Quantity = && > 1 <br>';
                            // echo  $id.'<br>';
                            // echo  $i.' <br><br>';
                            $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$date', '$recipient', '$position')";
                            $mr_result = mysqli_query($conn, $mr_query);
                            $lastMR = mysqli_insert_id($conn);
                
                            $queryEql = "INSERT INTO tbl_inventory (mr_no, invoice, po, particulars, supplier, date, quantity, unit, price, locID, locations, recipient, date_moved)
                                        VALUES ('$lastMR', '$resultQty[invoice]', '$resultQty[po]', '$resultQty[particulars]', '$resultQty[supplier]', '$resultQty[date]', 1, '$resultQty[unit]', '$resultQty[price]', '$location[locID]', '$location[locations]', '$recipient', '$date')";
                            $resultEql = mysqli_query($conn, $queryEql);
                
                            $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                                        SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                                        FROM tbl_inventory WHERE mr_no = '$lastMR'";
                            $mrResult = mysqli_query($conn, $mrQuery);
                        }
                    }

                }elseif($quantity < $resultQty['quantity']){
                    $queryDeduct = "UPDATE tbl_inventory SET quantity = ('$resultQty[quantity]' - '$quantity') WHERE id = '$id'";
                    $resultDeduct = mysqli_query($conn, $queryDeduct);
                        if($resultDeduct){
                            for ($i = 0; $i < $quantity; $i++ ){
                                // echo 'Quantity > 1 <br>';
                                // echo  $id.'<br>';
                                // echo  $i.' <br><br>';
                                $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$date', '$recipient', '$position')";
                                $mr_result = mysqli_query($conn, $mr_query);
                                $lastMR = mysqli_insert_id($conn);
            
                                $queryAssign = "INSERT INTO tbl_inventory (mr_no, invoice, po, particulars, supplier, date, quantity, unit, price, locID, locations, recipient, date_moved)
                                                VALUES ('$lastMR', '$resultQty[invoice]', '$resultQty[po]', '$resultQty[particulars]', '$resultQty[supplier]', '$resultQty[date]', 1, '$resultQty[unit]', '$resultQty[price]', '$location[locID]', '$location[locations]', '$recipient', '$date')";
                                $resultAssign = mysqli_query($conn, $queryAssign);
            
                                $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                                            SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                                            FROM tbl_inventory WHERE mr_no = '$lastMR'";
                                $mrResult = mysqli_query($conn, $mrQuery);
                            }
                        }
                }elseif($quantity > $resultQty['quantity']){
                    // echo 'More than Qty <br>';
                    // echo  $id.'<br>';
                    // echo  $quantity.'<br><br>';
                    $_SESSION['alert'] = "Please enter quantity not more than ".$resultQty['quantity']."!";
                    $_SESSION['alertCode'] = "warning";
                    header("Location: multi-assign.php");
                    exit(0);
                }
            }
        }if($mrResult){
            $_SESSION['alert'] = "Item Assigned!";
            $_SESSION['alertCode'] = "success";
            header("Location: ../inventory-locations/view-inventory.php?locID=$locID");
            exit(0);
        }
    }else{
        $_SESSION['alert'] = "Please Select Item to Assign!";
        $_SESSION['alertCode'] = "warning";
        header("Location: multi-assign.php");
        exit(0); 
    }

    /*if(!empty($locID) && !empty($recipient) && !empty($quantity) && !empty($position)){
        $stmtQty = "SELECT * FROM tbl_inventory WHERE id = '$id'";
        $queryQty = mysqli_query($conn, $stmtQty);
        $resultQty = mysqli_fetch_assoc($queryQty);

        $loc = "SELECT * FROM tbl_location WHERE locID = '$locID'";
        $locRes = mysqli_query($conn, $loc);
        $location = mysqli_fetch_assoc($locRes);

        if($quantity > $resultQty['quantity']){
            $_SESSION['alert'] = "Please enter quantity not more than ".$resultQty['quantity']."!";
            $_SESSION['alertCode'] = "warning";
            header("Location: assign-item.php");
            exit(0);

        }elseif($quantity == $resultQty['quantity']){
            $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$date', '$recipient', '$position')";
            $mr_result = mysqli_query($conn, $mr_query);
            $lastMR = mysqli_insert_id($conn);

            $queryEql = "UPDATE tbl_inventory SET mr_no = '$lastMR', locID = '$location[locID]', locations = '$location[locations]', recipient = '$recipient' WHERE id = '$id'";
            $resultEql = mysqli_query($conn, $queryEql);

            $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                        SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                        FROM tbl_inventory WHERE mr_no = '$lastMR'";
            $mrResult = mysqli_query($conn, $mrQuery);
            if($mrResult){
                $_SESSION['alert'] = "Item Assigned!";
                $_SESSION['alertCode'] = "success";
                header("Location: ../inventory-locations/view-inventory.php?locID=$locID");
                exit(0);
            }

        }elseif($quantity < $resultQty['quantity']){
            $queryDeduct = "UPDATE tbl_inventory SET quantity = ('$resultQty[quantity]' - '$quantity') WHERE id = '$id'";
            $resultDeduct = mysqli_query($conn, $queryDeduct);
                if($queryDeduct){
                    $mr_query = "INSERT INTO tbl_memo_receipt (date, recipient, position) VALUES ('$date', '$recipient', '$position')";
                    $mr_result = mysqli_query($conn, $mr_query);
                    $lastMR = mysqli_insert_id($conn);

                    $queryAssign = "INSERT INTO tbl_inventory (mr_no, invoice, po, particulars, supplier, date, quantity, unit, price, locID, locations, recipient)
                                    VALUES ('$lastMR', '$resultQty[invoice]', '$resultQty[po]', '$resultQty[particulars]', '$resultQty[supplier]', '$resultQty[date]', '$quantity', '$resultQty[unit]', '$resultQty[price]', '$location[locID]', '$location[locations]', '$recipient')";
                    $resultAssign = mysqli_query($conn, $queryAssign);

                    $mrQuery = "INSERT INTO memorandum_receipt (mr_no, particulars, quantity, unit, price, locID, locations, recipient, date)
                                SELECT mr_no, particulars, quantity, unit, price, locID, locations, recipient, date
                                FROM tbl_inventory WHERE mr_no = '$lastMR'";
                    $mrResult = mysqli_query($conn, $mrQuery);
                    if($mrResult){
                        $_SESSION['alert'] = "Item Assigned!";
                        $_SESSION['alertCode'] = "success";
                        header("Location: ../inventory-locations/view-inventory.php?locID=$locID");
                        exit(0);
                    }
                }
        }
    }else{
        $_SESSION['alert'] = "Please Enter Complete Details!";
        $_SESSION['alertCode'] = "warning";
        header("Location: assign-item.php");
        exit(0); 
    }*/
}
?>