<?php
session_start(); 
require '../../../config.php'; 

// Add User
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
        header("Location: user-management.php");
        exit(0);
    }else{
        $_SESSION['message'] = "User Account Creation Failed";
        header("Location: user-management.php");
        exit(0);
    }
}




?>

