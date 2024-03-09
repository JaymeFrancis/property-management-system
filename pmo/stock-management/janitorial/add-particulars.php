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
                        <h2>Add Janitorial Particular</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Stock Management</li>
                                <li class="breadcrumb-item"><a href="jtrl-particulars.php" style="text-decoration: none;">Janitorial Supplies</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Janitorial Particular</li>
                            </ol>
                        </nav>    
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="jtrl-particulars.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <div class="container">
            <form class="needs-validation" action="fn-jtrl.php" method="post" novalidate>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="validationCustom01">Particular</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="Particular" name="particulars" required>
                        <div class="invalid-feedback">Please Enter Particular</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Item Code</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Item Code" name="item_code" required>
                        <div class="invalid-feedback">Please Enter Item Code</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">Stock Type</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" name="stock_type" value="Janitorial" readonly="readonly">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom04">Unit</label>
                        <div class="unit-select">
                        <select class="form-control"  id="validationCustom04" name="unit" data-live-search="true" required>
                            <option value="" disabled selected>Choose Unit Type</option>
                            <option value="Cans">Cans</option>
                            <option value="Gals">Gallons</option>
                            <option value="Packs">Packs</option>
                            <option value="Pcs">Pieces</option>
                        </select>
                        </div>
                        <div class="invalid-feedback">Please Select Unit</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom05">Order Level</label>
                        <input type="number" class="form-control" id="validationCustom05" placeholder="Order Level" name="order_level" required>
                        <div class="invalid-feedback">Please Enter Order Level</div>
                    </div>
                </div>
            <button class="btn btn-primary float-end" type="submit" name="addParticular">Submit</button>
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