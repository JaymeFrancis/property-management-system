<?php
session_start();
require '../../../config.php';

//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
}

if(isset($_POST['surrender-equipment'])){
    $id = $_POST['id'];
    $surr_by = $_POST['surr_by'];
    $status = $_POST['status'];

    $stmt = "UPDATE tbl_inventory SET locID = '', locations = 'Surrendered', recipient = '', status = '$status' WHERE id = '$id'";
    $query = mysqli_query($conn, $stmt);
    if($query){
        $_SESSION['alert'] = "Equipment successfuly surrendered!";
        $_SESSION['alertCode'] = "success";
        header("Location: ../assign-equipment/assign-item.php");
        exit(0);
    }else{
        $_SESSION['alert'] = "Equipment failed to surrender!";
        $_SESSION['alertCode'] = "warning";
        header("Location: surrender-form.php?ref=$id");
        exit(0);
    }
}
?>