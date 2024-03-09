<!DOCTYPE html>
<html lang="en">
<?php include '../../../head.php'; ?> 
<body>

<?php 
session_start();
require '../../../config.php'; 
?>

<div class="wrapper">
<?php include '../../pmo-nav.php'; ?>
    <div class="main_content">
    <?php include '../../../navbar.php'; ?>  

        <div class="info">

            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6 md-6 order-md-1 order-first">
                        <h2>Add New Issuance</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Record Issuance</li>
                                <li class="breadcrumb-item"><a href="requests.php" style="text-decoration: none;">Janitorial Issuance</a></li>
                                <li class="breadcrumb-item active" aria-current="page">New Issuance</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="requests.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <div class="container">
            <form class="needs-validation" action="fn-jtrl.php" method="post" novalidate>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Recipient</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="Recipient" name="recipient" required>
                        <div class="invalid-feedback">Please Enter Recipient</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom06">Office or Department</label>
                        <select name="locID" class="form-control" required>
                            <option value="" selected disabled>Select Location</option>
                            <?php
                            $query = "SELECT * FROM tbl_location";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0){
                                foreach($result as $location){
                                    echo '<option value="'.$location['locID'].'">'.$location['locations'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Please Enter Office or Department</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom07">Date of Request</label>
                        <input type="date" class="form-control" id="datepicker" name="req_date" required>
                        <div class="invalid-feedback">Please Choose a Date</div>
                    </div>
                </div>
            <button class="btn btn-primary float-end" type="submit" name="newIssuance">Submit</button>
            </form>
            </div>
            
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>

<script>
    var todayDate = new Date();
    var month = todayDate.getMonth() +1 ; //04 - current month
    var year = todayDate.getUTCFullYear(); //2021 - current year
    var tdate = todayDate.getDate(); // 27 - current date 
    var maxDate = year + "-" + month + "-" + tdate;
    document.getElementById("datepicker").setAttribute("max", maxDate);
    $("#datepicker").attr("value", maxDate);
    console.log(maxDate);
</script>

<script>
(function() {
'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>



</body>
</html>