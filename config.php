<?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "db_pms";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    date_default_timezone_set("Asia/manila");
?>