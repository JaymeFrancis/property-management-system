<!DOCTYPE html>
<html lang="en">

<?php include '../../../head.php'; ?>   
<head>
    <style>
  body {
    overflow-x:hidden;
  }
  * {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #2a75d8;
  border-radius: 5px;
  border-color:#2a75d8;
  margin-bottom: 12px;
  font-family:Bahnschrift
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}


#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  border-radius: 5px;
  border-color:#2a75d8;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color:#2a75d8;
  display: block;
  font-family:Bahnschrift
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>

</head>
<body>

<?php
session_start(); 
require '../../../config.php'; 
?>

<div class="wrapper">
<?php include '../../pmo-nav.php'; ?>
    <div class="main_content">
    <?php include '../../../navbar.php'; ?>   
        <div class="info" > 

            <div class="row">
                <div class="col-md-8 offset-md-2"> 
                    <div class="card-body">
                    <p style="text-align:center;font-family:Bahnschrift;font-size:25px;color:#2a75d8;"><b>Need help?</b></p>
                    <p style="text-align:center;font-family:Bahnschrift;">This option will provide help with regards to the functionality of the system.</p>

                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter a keyword" title="Type in to search">

                    <!-- /Group 1/Help PDF/Login.pdf -->
                    <ul id="myUL">
                    
                        <li><h5><a href="help-pdf/HowtoLogin.pdf" target="_blank"> <i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp How to Log in?</a></p></h5></li>
                        <li><h5><a href="help-pdf/NavigationBar.pdf" target="_blank"><i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Navigation Bar/Sidebar</a></p></h5></li>
                        <li><h5><a href="help-pdf/StockManagement.pdf" target="_blank"><i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Stock Management</a></p></h5></li>
                        <li><h5><a href="help-pdf/RecordIssuance.pdf" target="_blank"> <i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Record Issuance</a></p></h5></li>
                        <li><h5><a href="help-pdf/EquipmentandFixture.pdf" target="_blank"> <i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Equipment and Fixtures</a></p></h5></li>
                        <li><h5><a href="help-pdf/PurchaseOrder.pdf" target="_blank"> <i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Purchase Order</a></p></h5></li>
                        <li><h5><a href="help-pdf/Reports.pdf" target="_blank"> <i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Reports</a></p></h5></li>
                        <li><h5><a href="help-pdf/Backup-Restore.pdf" target="_blank"> <i class="fa fa-info-circle"></i>&nbsp&nbsp&nbsp Backup and Restore</a></p></h5></li>
                    </ul>

                        <script>
                        function myFunction() {
                            var input, filter, ul, li, a, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            ul = document.getElementById("myUL");
                            li = ul.getElementsByTagName("li");
                            for (i = 0; i < li.length; i++) {
                                a = li[i].getElementsByTagName("a")[0];
                                txtValue = a.textContent || a.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    li[i].style.display = "";
                                } else {
                                    li[i].style.display = "none";
                                }
                            }
                        }
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>
  </body>
</html>