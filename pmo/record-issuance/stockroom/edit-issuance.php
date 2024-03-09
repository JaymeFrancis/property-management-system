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
                        <h2>Update Issuance</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Record Issuance</li>
                                <li class="breadcrumb-item"><a href="requests.php" style="text-decoration: none;">Stockroom Issuance</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Issuance</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="requests.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <div class="container">
            <?php
            if(isset($_GET['ref'])){
                $refid = $_GET['ref'];
                $query = "SELECT * FROM tbl_request_stockroom WHERE iss_no = '$refid'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
            ?>
            <form class="needs-validation" action="fn-stkrm.php" method="post" novalidate>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom01">Issuance Number</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="validationCustom01" value="<?= $row['iss_no'] ?>" name="iss_no" readonly="readonly">
                    </div>
                    <div class="col-md-9 mb-3">
                        <label for="validationCustom02">Recipient</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Recipient" value="<?= $row['recipient'] ?>" name="recipient" required>
                        <div class="invalid-feedback">Please Enter Recipient</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">Office or Department</label>
                        <input type="text" class="form-control" id="validationCustom03" placeholder="Office or Department"  value="<?= $row['office'] ?>" name="office" required>
                        <div class="invalid-feedback">Please Enter Office or Department</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom04">Date of Issuance</label>
                        <input type="date" class="form-control" id="validationCustom04" value="<?= $row['req_date'] ?>" name="req_date" required>
                        <div class="invalid-feedback">Please Choose a Date</div>
                    </div>
                </div>
            <button class="btn btn-primary float-end" type="submit" name="editIssuance">Submit</button>
            </form>
            <?php
                }
            ?>
            </div>
            
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>

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