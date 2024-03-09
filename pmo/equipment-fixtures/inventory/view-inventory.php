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
                        $query = "SELECT *,  SUM(quantity) AS total_qty ,quantity*price AS amount  FROM tbl_inventory GROUP BY particulars";
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
                            <td><?= $inventory['total_qty']; ?></td>
                            <td><?= $inventory['unit']; ?></td>
                            <td>₱<?= number_format((float)$inventory['price'], 2, '.', ','); ?></td>
                            <td>₱<?= number_format((float)$inventory['amount'], 2, '.', ','); ?></td>
                            <td style="display:none;"><?= $inventory['locations']; ?></td>
                            <td><a href="details.php?ref=<?= $inventory['id']; ?>" class="btn btn-sm btn-info" type="button">View</a></td>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>


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