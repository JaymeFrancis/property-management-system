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
                                <li class="breadcrumb-item active" aria-current="page">List of Equipment</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                        <a href="multi-assign.php" role="button" type="button" class="btn btn-primary float-end">Assign Equipment</a>
                    </div> 
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">id</th>
                            <th>Invoice</th>
                            <th>P.O. Number</th>
                            <th>Supplier</th>
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT *, quantity*price AS amount  FROM tbl_inventory WHERE locID = '' AND recipient = '' AND status = 'OK'";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $inventory){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $inventory['id']; ?></td>
                            <td><?= $inventory['invoice']; ?></td>
                            <td><?= $inventory['po'];?></td>
                            <td><?= $inventory['supplier'];?></td>
                            <td><?= $inventory['particulars']; ?></td>
                            <td><?= $inventory['quantity']; ?></td>
                            <td><?= $inventory['unit']; ?></td>
                            <td>₱<?= number_format((float)$inventory['price'], 2, '.', ','); ?></td>
                            <td>₱<?= number_format((float)$inventory['amount'], 2, '.', ','); ?></td>
                        </tr>
                    <?php
                        }
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="assign-item" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form action="fn-inventory.php" method="POST" novalidate>
        <div class="modal-header">
            <h1 class="modal-title fs-4 text-uppercase" id="exampleModalLabel">Location and Recipient Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <input type="hidden" name="id"  id="id" class="form-control">
            <div class="row">
                <div class="col-md-7 mb-3">
                    <label> Recipient </label>
                    <input type="text" name="recipient" placeholder="Enter Recipient" class="form-control" required>
                </div>
                <div class="col-md-5 mb-3">
                    <label> Position </label>
                    <input type="text" name="position" placeholder="Enter Position" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label> Location </label>
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
                </div>
                <div class="col-md-4">
                    <label> Quantity </label>
                    <input type="number" name="quantity" id="quantity" min="1" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="assign-item" class="btn btn-primary">Submit</button>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
        </div>
      </form>
    </div>
  </div>
</div>


<!--Modal-->
<script>
    $(document).ready(function () {

        $('.assign-item').on('click', function () {

            $('#assign-item').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            
            $('#id').val(data[0]);
            $('#quantity').val(data[5]);
        });
    });
</script>

<!-- Data Table -->
<script>
$(document).ready(function () {
    $('#example').DataTable();
});

$('.rounded').text(function(i,curr){
  return parseFloat(curr).toFixed(2)
})
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include '../../../message.php';?>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>