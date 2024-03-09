<?php
session_start();
require '../../../config.php';
//Log Out
if (isset($_POST['logout'])){
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_lvl"]);
    header("location:../../../index.php");
}

if(isset($_POST['generateWJI'])){
    $month = $_POST['month'];
    $year = $_POST['year'];

    $stmt = "INSERT INTO janitorial_report (month, year) VALUES ('$month', '$year') ";
    $query = mysqli_query($conn, $stmt);
    
    if($query){
        $_SESSION['alert'] = "Issuance Report Successfuly Generated!";
        $_SESSION['alertCode'] = "success";
        header("Location: janitorial-position.php");
        exit(0);
    }else{
        $_SESSION['alert'] = "Failed to Generate Issuance Report!";
        $_SESSION['alertCode'] = "success";
        header("Location: janitorial-position.php");
        exit(0);
    }
}
?>