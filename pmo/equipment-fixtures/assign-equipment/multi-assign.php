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
                        <h2>Assign Equipment</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item"><a href="assign-item.php" style="text-decoration: none;">List of Equipment</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assign Equipment</li>
                            </ol>
                        </nav>                   
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="assign-item.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <!-- Add Item -->
            <div class="row">
                <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <h4>Details for Assigning Equipment</h4>
                  </div>
                  <div class="card-body ">
                        <form class="needs-validation" action="fn-inventory.php" method="post" novalidate>
                            
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="mb-2"> Location </label>
                                        <select name="locID" class="form-control" required >
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
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2"> Recipient </label>
                                        <input type="text" name="recipient" placeholder="Enter Recipient" class="form-control" required >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2"> Position </label>
                                        <input type="text" name="position" placeholder="Enter Position" class="form-control" required >
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <table class="table align-middle table-bordered" id="example">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Select</th>
                                            <th class="col-md-7">Particulars</th>
                                            <th class="col-md-4">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $query = "SELECT * FROM tbl_inventory WHERE locID = '' AND recipient = '' AND status = 'OK'";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result) > 0):
                                            foreach($result as $inventory){
                                    ?>
                                        <tr>
                                            <td class="col-md-1">
                                                <input type="checkbox" class="form-check-input" name="id[]" value="<?= $inventory['id']; ?>">
                                            </td>
                                            <td class="col-md-7"><?= $inventory['particulars']; ?>
                                                <input type="hidden" class="form-control" name="refid[]" value="<?= $inventory['id']; ?>">
                                            </td>
                                            <td class="col-md-4">
                                                <input type="number" class="form-control" name="quantity[]"  min="1" max="<?= $inventory['quantity']; ?>" value="<?= $inventory['quantity']; ?>">
                                            </td>
                                        </tr>
                                    <?php } endif;?>
                                    </tbody>
                                </table>
                            </div>  
                            <button type="submit" name="assign-item" class="btn btn-primary float-end">Submit</button>
                        </form>
                  </div>
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