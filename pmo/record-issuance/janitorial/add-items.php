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
        if(isset($_GET['ref'])):
            $refid = $_GET['ref'];
        ?>
            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6 md-6 order-md-1 order-first">
                        <h2>Add New Item for Issuance No. <?= $refid ?></h2> 
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Record Issuance</li>
                                <li class="breadcrumb-item"><a href="requests.php" style="text-decoration: none;">Janitorial Issuance</a></li>
                                <li class="breadcrumb-item"><a href="issued-items.php?ref=<?= $refid ?>" style="text-decoration: none;">Issued Items</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Items</li>
                            </ol>
                        </nav>                     
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="issued-items.php?ref=<?= $refid ?>" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>
            <div class="container">
            <form class="needs-validation" action="fn-jtrl.php" method="post" onsubmit="return submitForm(this);" novalidate>
                <?php
                if(isset($_GET['ref'])):
                    $refid = $_GET['ref'];
                    echo '<input type="hidden" value="'.$refid.'" name="refid" class="form-control">';
                endif;
                ?>
                <div class="row" >
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Particulars</label>
                        <select class="form-control" id="validationCustom01" name="particulars" onchange="showParticulars(this.value)" required>
                        <option value="" selected>Select Item</option>
                        <?php
                        $query = "SELECT particulars FROM tbl_particulars_janitorial";
                        $result = mysqli_query($conn, $query);
                        while(list($particulars) = mysqli_fetch_row($result)){
                            echo '<option value="'.$particulars.'">'.$particulars.'</option>';
                          }
                        ?>
                        </select>
                        <div class="invalid-feedback">Please Choose Particulars</div>
                    </div>  
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Item Code</label>
                        <select class="form-control"  name="item_code"  id="fetch-id" onchange="showItemCode(this.value)" required>
                        <option value="" selected>Select Item Code</option>
                        </select>
                        <div class="invalid-feedback">Please Choose Item Code</div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" class="form-control" id="price" name="price">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom06">Available Stocks</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="quantity" name="quantity" placeholder="Available Quantity" readonly="readonly">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom07">Unit</label>
                        <input type="text" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" id="unit" name="unit" placeholder="Unit" readonly="readonly">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom08">Quantity</label>
                        <input type="number" class="form-control" id="validationCustom08" placeholder="Quantity" name="quantityReq" required>
                        <div class="invalid-feedback">Please Enter Quantity</div>
                    </div>
                </div>
                <div class="float-end" role="group" aria-label="Basic example">
                    <input type="reset" class="btn btn-warning"  value="Clear">
                    <button class="btn btn-primary" type="submit"  name="addItem">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>
<!-- Fetch Details of Issuance -->
<script>

//Item Code
function showParticulars(str) {

  if (str == "") {
    document.getElementById("fetch-id").innerHTML = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("fetch-id").innerHTML = this.responseText;
  }
  xhttp.open("GET", "fn-jtrl.php?p="+str);
  xhttp.send();
}
 
//Quantity and Unit
function showItemCode(str) {
  if (str == "") {
    document.getElementById("quantity").value = "";
    document.getElementById("unit").value = "";
    document.getElementById("price").value = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    var response = this.responseText;
    var val = new Array();
    if (response.indexOf('|'!=-1)){
      val = response.split('|');
    document.getElementById("quantity").value = val[0];
    document.getElementById("unit").value = val[1];
    document.getElementById("price").value = val[2];
    }
  }
  xhttp.open("GET", "fn-jtrl.php?q="+str);
  xhttp.send();
}
</script>

<!-- Form Validation -->
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