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
                        <h2>Inventory</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item active" aria-current="page">Inventory</li>
                            </ol>
                        </nav>
                    </div> 
                    <div class="col-6 md-6 order-md-2 order-last">
                        <div class="dropdown float-end">
                            <button class="btn btn-primary dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-items.php">Add Equipment</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#generateMR">Import CSV/Excel File</a></li>
                            </ul>
                        </div>   
                    </div>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">id</th>
                            <th>P.O. Number</th>
                            <th>Invoice</th>
                            <th>Supplier</th>
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th style="display:none;"><?= $inventory['locations']; ?></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT *, quantity*price AS amount  FROM tbl_inventory";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $inventory){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $inventory['id']; ?></td>
                            <td><?= $inventory['po'];?></td>
                            <td><?= $inventory['invoice']; ?></td>
                            <td><?= $inventory['supplier'];?></td>
                            <td><?= $inventory['particulars']; ?></td>
                            <td><?= $inventory['quantity']; ?></td>
                            <td><?= $inventory['unit']; ?></td>
                            <td>₱<?= number_format((float)$inventory['price'], 2, '.', ','); ?></td>
                            <td>₱<?= number_format((float)$inventory['amount'], 2, '.', ','); ?></td>
                            <td style="display:none;"><?= $inventory['locations']; ?></td>
                            <td><a href="details.php?ref=<?= $inventory['id']; ?>" class="btn btn-sm btn-info" type="button">Details</a></td>
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

<div class="modal fade" id="generateMR" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="imports.php" method="post" name="upload_excel" enctype="multipart/form-data">
        <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalLabel">Import CSV/Excel file</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?php
            $query = "SELECT * FROM tbl_location";
            $result = mysqli_query($conn, $query);
        ?>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="file" name="file" id="file" class="input-file" style="border-style:solid; border-radius:5px; border-color: #2a75d8">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading..." >Upload</button>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
        </div>
      </form>
    </div>
  </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<!--Datatable JS-->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- Datatable Script -->
<script>
$(document).ready(function () {
    $('#example').DataTable({
        order: [[0, 'desc']],
    });
});
</script>           

</body>
</html>        