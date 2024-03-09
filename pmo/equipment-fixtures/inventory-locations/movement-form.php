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
                        <h2>Movement Form</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item"><a href="inventory-locations.php" style="text-decoration:none;">Inventory Locations</a></li>
                                <li class="breadcrumb-item"><a href="view-inventory.php?locID=<?= $location['locID']; ?>" style="text-decoration:none;"><?= $location['locations']; ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Move Equipment</li>
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
            <form class="needs-validation" action="fn-inventory.php" method="post" novalidate>
                <?php
                if(isset($_GET['ref'])){
                    $ref = $_GET['ref'];

                    $query = "SELECT * FROM tbl_inventory WHERE id = '$ref'";
                    $result = mysqli_query($conn, $query);
                    $equipment = mysqli_fetch_assoc($result);
                    if(mysqli_num_rows($result)>0){
                ?>
                    <input type="hidden" class="form-control" name="id" value="<?= $equipment['id']; ?>">
                    <input type="hidden" class="form-control" name="oldLoc" value="<?= $equipment['locID']; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Office Transferred From</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['locations']; ?>" name="trans_loc" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Office Transferred To</label>
                        <select name="newLoc" class="form-control" required>
                            <option value="" selected disabled>Select New Location</option>
                            <?php
                            $query1 = "SELECT * FROM tbl_location WHERE locID != '$equipment[locID]'";
                            $result1 = mysqli_query($conn, $query1);
                            if(mysqli_num_rows($result1)>0){
                                foreach($result1 as $location){
                                    echo '<option value="'.$location['locID'].'">'.$location['locations'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Please Select New Location</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-2 mb-3">
                        <label for=>Date of Transfer</label>
                        <input type="date" class="form-control" id="datepicker" name="date" required>
                        <div class="invalid-feedback">Please Choose a Date</div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label>Recipient</label>
                        <input type="text" class="form-control" name="recipient" placeholder="Enter Recipient Name" required>
                        <div class="invalid-feedback">Please Enter Recipient</div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label>Position</label>
                        <input type="text" class="form-control" name="position" placeholder="Enter Recipient Position" required>
                        <div class="invalid-feedback">Please Enter Postion</div>
                    </div>
                </div>
                <div class="row">   
                    <div class="col-md-3 mb-3">
                        <label>M.R. Number</label>
                        <input type="number" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['mr_no']; ?>" name="mr_no" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Invoice</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['invoice']; ?>" name="invoice" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>P.O. Number</label>
                        <input type="number" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['po']; ?>" name="po" readonly="readonly">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Supplier</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['supplier']; ?>" name="supplier" readonly="readonly">
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Particulars</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['particulars']; ?>" name="particulars" readonly="readonly">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Quantity</label>
                        <input type="number" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?= $equipment['quantity']; ?>" name="quantity" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Unit</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" name="unit" value="<?= $equipment['unit']; ?>" readonly="readonly">
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                <div class="form-buttons float-end">
                <input type="reset" role="button" value="Clear" class="btn btn-warning">
                <button type="submit" name="move-item" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include '../../../message.php';?>

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
        }form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

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

</body>
</html>