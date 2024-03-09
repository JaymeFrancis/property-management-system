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
                        if(isset($_GET['locID'])){
                            $locID = $_GET['locID'];
                            $query = "SELECT * FROM tbl_location WHERE locID = '$locID'";
                            $result = mysqli_query($conn, $query);
                            $location = mysqli_fetch_assoc($result);
                        ?>
                        <h2><?= $location['locations']; ?> Inventory</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item"><a href="inventory-locations.php" style="text-decoration:none;">Inventory Locations</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $location['locations']; ?></li>
                            </ol>
                        </nav>
                    </div> 
                    <div class="col-6 md-6 order-md-2 order-last">
                            <a class="btn btn-close float-end" href="inventory-locations.php" role="button"></a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">id</th>
                            <th>M.R No.</th>
                            <th>Invoice</th>
                            <th>P.O. No.</th>
                            <th>Supplier</th>
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th style="display:none;">locID</th>
                            <th style="display:none;">location</th>
                            <th>Recipient</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($_GET['locID'])){
                        $locID = $_GET['locID'];    
                        $query = "SELECT *, quantity*price AS amount  FROM tbl_inventory WHERE locID = '$locID'";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $inventory){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $inventory['id']; ?></td>
                            <td><?= $inventory['mr_no'] ?></td>
                            <td><?= $inventory['invoice']; ?></td>
                            <td><?= $inventory['po'];?></td>
                            <td><?= $inventory['supplier'];?></td>
                            <td><?= $inventory['particulars']; ?></td>
                            <td><?= $inventory['quantity']; ?></td>
                            <td><?= $inventory['unit']; ?></td>
                            <td>₱<?= number_format((float)$inventory['price'], 2, '.', ','); ?></td>
                            <td>₱<?= number_format((float)$inventory['amount'], 2, '.', ','); ?></td>
                            <td style="display:none;"><?= $inventory['locID']; ?></td>
                            <td style="display:none;"><?= $inventory['location']; ?></td>
                            <td><?= $inventory['recipient']; ?></td>
                            <td>
                            <div class="btn-group dropstart m-0">
                                <button class="btn btn-primary dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="movement-form.php?ref=<?=$inventory['id'];?>">Move Location</a></li>
                                    <li><a class="dropdown-item" href="surrender-form.php?ref=<?=$inventory['id'];?>">Surrender Equipment</a></li>
                                </ul>
                            </div> 
                            </td>
                        </tr>
                    <?php
                        }
                    endif;
                    }
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<!--Datatable JS-->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- Datatable Script -->
<script>
$(document).ready(function () {
    $('#example').DataTable({
        order: [[1, 'desc']]
    });
});
</script>           

</body>
</html>        