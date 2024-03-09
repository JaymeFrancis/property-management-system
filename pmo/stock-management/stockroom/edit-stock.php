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
                <?php
                 if(isset($_GET['ref'])){
                    $refid = $_GET['ref'];
                    $query = "SELECT id, particulars FROM tbl_stock_stockroom WHERE uid = '$refid'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                ?>
            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6 md-6 order-md-1 order-first">
                        <?php
                            echo '<h2>Add Stock for '.$row['particulars'].'</h2>';
                        ?>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Stock Management</li>
                                <li class="breadcrumb-item"><a href="stkrm-particulars.php" style="text-decoration: none;">Stockroom Supplies</a></li>
                                <li class="breadcrumb-item"><a href="stkrm-stocks.php?ref=<?=$row['id']?>" style="text-decoration: none;">Stocks</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Stock</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="stkrm-stocks.php?ref=<?=$row['id']?>" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>
                <?php
                } 
                ?>
            <div class="container">
                <?php
                if(isset($_GET['ref'])){
                    $refid = $_GET['ref'];
                    $query = "SELECT * FROM tbl_stock_stockroom WHERE uid = '$refid'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                ?>
            <form class="needs-validation" action="fn-stkrm.php" method="post" novalidate>
                    <input type="hidden" class="form-control" value="<?= $row['uid'] ?>" name="uid" readonly="readonly">
                    <input type="hidden" class="form-control" value="<?= $row['id']?>" name="refid" readonly="readonly">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="validationCustom01">Particular</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="validationCustom01" value="<?= $row['particulars'] ?>" name="particulars" readonly="readonly">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Item Code</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="validationCustom02" value="<?= $row['item_code'] ?>" name="item_code" readonly="readonly">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">Stock Type</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="validationCustom03" value="<?= $row['stock_type'] ?>" name="stock_type" readonly="readonly">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom04">Unit</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="validationCustom04" value="<?= $row['unit'] ?>" name="unit" readonly="readonly">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom05">Quantity</label>
                        <input type="number" class="form-control" id="validationCustom05" placeholder="Quantity" value="<?= $row['quantity'] ?>" name="quantity" required>
                        <div class="invalid-feedback">Please Enter Quantity</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom06">Price</label>
                        <input type="number" class="form-control" id="validationCustom06" placeholder="Price" value="<?= $row['price'] ?>" name="price" step=".01" required>
                        <div class="invalid-feedback">Please Enter Price</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom07">Date of Purchase</label>
                        <input type="date" class="form-control" id="validationCustom07" value="<?= $row['date'] ?>" name="date" required>
                        <div class="invalid-feedback">Please Choose a Date</div>
                    </div>
                </div>
                <?php
                    }
                ?>
            <button class="btn btn-primary float-end" type="submit" style="border-radius: 0;" name="editStock">Submit</button>
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