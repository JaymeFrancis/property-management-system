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
                                <li class="breadcrumb-item"><a href="inventory.php" style="text-decoration:none;">Inventory</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Equipment Details</li>
                            </ol>
                        </nav>
                    </div> 
                    <div class="col-6 md-6 order-md-2 order-last">
                            <a class="btn btn-close float-end" href="inventory.php" role="button"></a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Equipment Details</h4>
                        </div>
                        <?php
                        if(isset($_GET['ref'])){
                            $inv_id = $_GET['ref'];
                            $stmt = "SELECT * FROM tbl_inventory WHERE id = '$inv_id'";
                            $query = mysqli_query($conn, $stmt);
                            $result = mysqli_fetch_assoc($query);
                        ?>
                        <div class="card-body" style="margin-bottom: 0;">
                            <div class="row" style="margin-bottom: 0;">
                                <div class="col-md-3">
                                    <p style="font-weight: bold; font-size:larger;">Memorandum Receipt No</p>
                                    <p style="font-weight: bold; font-size:larger;">Purchase Order No</p>
                                    <p style="font-weight: bold; font-size:larger;">Invoice No</p>
                                    <p style="font-weight: bold; font-size:larger;">Particulars</p>
                                    <p style="font-weight: bold; font-size:larger;">Quantity</p>
                                    <p style="font-weight: bold; font-size:larger;">Unit</p>
                                    <p style="font-weight: bold; font-size:larger;">Price</p>
                                    <p style="font-weight: bold; font-size:larger;">Supplier</p>
                                    <p style="font-weight: bold; font-size:larger;">Date of Purchase</p>
                                    <p style="font-weight: bold; font-size:larger;">Present Location</p>
                                    <p style="font-weight: bold; font-size:larger;">Status</p>
                                </div>
                                <div class="col-md-6">
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['mr_no']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['po']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['invoice']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['particulars']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['quantity']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['unit']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">: ₱<?= number_format((float)$result['price'], 2, '.', ','); ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['supplier']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?=date('F d, Y',strtotime($result['date'])) ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['locations']; ?></p>
                                    <p style="font-weight: bold; font-size:larger;">:  <?= $result['status']; ?></p>
                                </div>
                                <div class="class-md-6">
                                    
                                </div>
                            </div>
                        </div>
                        <?php
                        }else{
                            echo 'No Record Found';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                                <h4>Movement History</h4>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped " style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Previous Location</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $ref = $_GET['ref']; 
                                            $query = "SELECT * FROM `trans_history` WHERE trans_id = $ref ORDER BY id DESC";
                                            $result = mysqli_query($conn, $query);
                                            if(mysqli_num_rows($result) > 0):
                                                foreach($result as $rows){
                                        ?>
                                            <tr>
                                                <td><?= $rows['locations'];?></td>
                                                <td><?= date('M d, Y',strtotime($rows['trans_date'])); ?></td>
                                                <td><?= date('M d, Y',strtotime($rows['date_moved']));?></td>
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Surrender History</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped " style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Surrendered By</th>
                                                    <th>From</th>
                                                    <th>On Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $ref = $_GET['ref']; 
                                                $query = "SELECT * FROM `surrender_equip` WHERE surr_id = $ref";
                                                $result = mysqli_query($conn, $query);
                                                if(mysqli_num_rows($result) > 0):
                                                    foreach($result as $rows){
                                            ?>
                                                <tr>
                                                    <td><?= $rows['surrendered_by'];?></td>
                                                    <td><?= $rows['locations']; ?></td>
                                                    <td><?= date('M d, Y',strtotime($rows['date']));?></td>
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

<!--Datatable JS-->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- Datatable Script -->
<script>
$(document).ready(function () {
    $('#example').DataTable();
});

$('.rounded').text(function(i,curr){
    return parseFloat(curr).toFixed(2)
})
</script>           

</body>
</html>        