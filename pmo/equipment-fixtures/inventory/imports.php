<?php
include '../../../config.php';
session_start();
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0){

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				
				$date = date("Y-m-d", strtotime("$emapData[4]")) ;
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into tbl_inventory (`invoice`,`po`, `particulars`,`supplier`, date, `quantity` , `unit`,`price`) 
	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$date','$emapData[5]','$emapData[6]','$emapData[7]')";
	            	
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysqli_query( $conn, $sql );
				if(! $result )
				{
					$_SESSION['alert'] = "Invalid File: Please Upload CSV File!";
					$_SESSION['alertCode'] = "warining";
					header("Location: inventory.php");
					exit(0);
				
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         		$_SESSION['alert'] = "CSV File has been successfuly Imported!";
					$_SESSION['alertCode'] = "success";
					header("Location: inventory.php");
					exit(0);
	        
			 

			 //close of connection
			mysqli_close($conn); 
				
		 	
			
		 }else{
			$_SESSION['alert'] = "Please upload a File!";
			$_SESSION['alertCode'] = "warning";
			header("Location: inventory.php");
			exit(0);
		 }
	}	 
?>		 