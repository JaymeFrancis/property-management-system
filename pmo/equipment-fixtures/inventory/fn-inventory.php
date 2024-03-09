<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
 }


 if(isset($_POST['add-equipment'])){
    $invoice = $_POST['invoice'];
    $po = $_POST['po'];
    $date = $_POST['date'];
    $particulars = $_POST['particulars'];
    $supplier = $_POST['supplier'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];

    $query = "INSERT INTO tbl_inventory (invoice, po, particulars, supplier, quantity, unit, price, date) VALUES ('$invoice', '$po', '$particulars', '$supplier', '$quantity', '$unit', '$price', '$date')";
    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION['alert'] = "New Equipment Added";
        $_SESSION['alertCode'] = "success";
        header("Location: inventory.php");
        exit(0);
    }else{
        $_SESSION['alert'] = "There was a problem adding the equipment!";
        $_SESSION['alertCode'] = "warning";
        header("Location: add-items.php");
        exit(0);
    }
 }


?>