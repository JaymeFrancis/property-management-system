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
                        <h2>Add User</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Utilities</li>
                                <li class="breadcrumb-item"><a href="user-management.php" style="text-decoration: none;">User Management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add User</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="user-management.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <div class="container">
            <form class="needs-validation" action="fn_user.php" method="post" novalidate>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Employee ID</label>
                        <input type="text" class="form-control" id="validationCustom01"  name="particulars" required>
                        <div class="invalid-feedback">Please Enter ID</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">First Name</label>
                        <input type="text" class="form-control" id="validationCustom02"  name="item_code" required>
                        <div class="invalid-feedback">Please Enter First Name</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Middle Name</label>
                        <input type="text" class="form-control" id="validationCustom03"  name="item_code" required>
                        <div class="invalid-feedback">Please Enter Middle Name</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Last Name</label>
                        <input type="text" class="form-control" id="validationCustom04"  name="particulars" required>
                        <div class="invalid-feedback">Please Enter Last Name</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Position</label>
                        <select class="form-control" name="user_lvl" id="validationCustom05" required>
                        <option value="" selected disabled>Select Position</option>
                        <option value="Admin">Admin</option>
                        <option value="PMO">Property Management Officer</option>
                        </select>
                        <div class="invalid-feedback">Please Select Position</div>
                </div>
                </div> 
                <button class="btn btn-primary float-end" type="submit" name="add-user">Submit</button>
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