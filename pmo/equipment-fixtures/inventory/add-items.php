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
                        <h2>Add Equipment</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item"><a href="inventory.php" style="text-decoration: none;">Inventory</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Items</li>
                            </ol>
                        </nav>                   
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="inventory.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <!-- Add Item -->
            <div class="container">
                <form class="needs-validation" action="fn-inventory.php" method="post" novalidate>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Purchase Order Number</label>
                            <input type="number" class="form-control" name="po" placeholder="Enter Purchase Order Number" required>
                            <div class="invalid-feedback">Please Enter Purchase Order Number</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Invoice</label>
                            <input type="text" class="form-control" name="invoice" placeholder="Enter Invoice" required>
                            <div class="invalid-feedback">Please Enter Invoice</div>
                        </div>
                        <div class="col-md-4 mb-1S">
                            <label>Date of Purchase</label>
                            <input type="date" class="form-control" id="datepicker" name="date" required>
                            <div class="invalid-feedback">Please Choose a Date</div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-6 mb-3">
                            <label>Particulars</label>
                            <input type="text" class="form-control" name="particulars" placeholder="Enter Particulars" required>
                            <div class="invalid-feedback">Please Enter Particulars</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" name="supplier" placeholder="Enter Supplier Name" required>
                            <div class="invalid-feedback">Please Enter Supplier</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" required>
                                <div class="invalid-feedback">Please Enter Quantity</div>
                            </div>
                        <div class="col-md-4 mb-3">
                                <label>Unit</label>
                                <select class="form-select" name="unit" aria-label="Default select example" class="mb-3" required>
                                <option value="" selected>Select Unit</option>
                                <option value="Unit">Unit</option>
                                <option value="Set">Set</option>
                                <option value="Pcs">Pieces</option>
                        </select>
                        <div class="invalid-feedback">Please Select Unit</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" step=".01" placeholder="₱ 0.00" required>
                            <div class="invalid-feedback">Please Enter Price</div>
                        </div>
                    </div>
                    <button type="submit" name="add-equipment" class="btn btn-primary float-end">Submit</button>
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