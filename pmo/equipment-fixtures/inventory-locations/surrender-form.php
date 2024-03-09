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
                    <?php
                    if(isset($_GET['ref'])){
                        $locID = $_GET['ref'];
                        $query = "SELECT * FROM  tbl_inventory WHERE id = '$locID'";
                        $result = mysqli_query($conn, $query);
                        $location = mysqli_fetch_assoc($result);
                    ?>
                        <h2>Surrender Form</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item"><a href="inventory-locations.php" style="text-decoration:none;">Inventory Locations</a></li>
                                <li class="breadcrumb-item"><a href="view-inventory.php?locID=<?= $location['locID']; ?>" style="text-decoration:none;"><?= $location['locations']; ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Surrender Equipment</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-second">
                        <a href="view-inventory.php?locID=<?= $location['locID']; ?>" role="button" class="btn btn-close float-end"></a>
                    </div>
                    <?php
                        }
                    ?> 
                </div>
            </div>

            <div class="container">
            <?php
            if(isset($_GET['ref'])){
                $id = $_GET['ref'];

                $stmt = "SELECT * FROM tbl_inventory WHERE id = '$id'";
                $query = mysqli_query($conn, $stmt);
                $result = mysqli_fetch_assoc($query);
            ?>
            <form class="needs-validation" action="fn-inventory.php" method="post" novalidate>
                    <input type="hidden" value="<?= $result['id'] ?>" name="id" class="form-control" readonly>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for=>Surrendered By</label>
                        <input type="text" class="form-control" name="surr_by" placeholder="Enter Name" required>
                        <div class="invalid-feedback">Please Enter Name</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="Surrendered">OK</option>
                            <option value="For Repair">For Repair</option>
                            <option value="For Disposal">For Disposal</option>
                        </select>
                        <div class="invalid-feedback">Please Select Status</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for=>Date Surrendered</label>
                        <input type="date" class="form-control" id="datepicker" name="date_surr" required>
                        <div class="invalid-feedback">Please Choose a Date</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Particulars</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $result['particulars'] ?>" name="particulars" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Office/Department</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $result['locations'] ?>" name="location" readonly>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-4 mb-3">
                        <label>MR Number</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $result['mr_no'] ?>" name="mr_no" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Quantity</label>
                        <input type="number" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $result['quantity'] ?>" name="quantity" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Unit</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $result['unit'] ?>" name="unit" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="surrender-equipment" class="btn btn-primary">Submit</button>
                </div>
                <?php
                }
                ?>
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