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
                        <h2>Supplies for Purchase Order</h2>
                        <nav aria-label="breadcrumb" class="float-start">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Purchase Order</li>
                                <li class="breadcrumb-item active" aria-current="page">For Purchase Order Items</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                        
                    </div>
                </div>
            </div>
    
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Stockroom Supplies</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Particulars</th>
                                        <th>Available Stocks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $date = date('F');  
                                    $query = "SELECT tbl_particulars_stockroom.*, (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) AS avail_stocks 
                                            FROM tbl_particulars_stockroom
                                            INNER JOIN tbl_stock_stockroom ON tbl_particulars_stockroom.particulars = tbl_stock_stockroom.particulars
                                            WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_stockroom WHERE tbl_particulars_stockroom.particulars = tbl_purchaseitems_stockroom.particulars AND tbl_purchaseitems_stockroom.month = '$date')
                                            GROUP BY particulars
                                            HAVING (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) <= tbl_particulars_stockroom.order_level";
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result) > 0):
                                        foreach($result as $particulars){
                                ?>
                                    <tr>
                                        <td><?= $particulars['particulars']; ?></td>
                                        <td><?= $particulars['avail_stocks'];?></td>
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
                <div class="col-md-6">
                <div class="card">
                    <div class="card-header" >
                        <h4>Janitorial Supplies</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="display:none;">id</th>
                                        <th>Particulars</th>
                                        <th>Available Stocks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $date = date('F'); 
                                    $query = "SELECT tbl_particulars_janitorial.*, (SUM(tbl_stock_janitorial.quantity) - SUM(tbl_stock_janitorial.issuance_qty)) AS avail_stocks 
                                            FROM tbl_particulars_janitorial
                                            INNER JOIN tbl_stock_janitorial ON tbl_particulars_janitorial.particulars = tbl_stock_janitorial.particulars
                                            WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_janitorial WHERE tbl_particulars_janitorial.particulars = tbl_purchaseitems_janitorial.particulars AND tbl_purchaseitems_janitorial.month = '$date')
                                            GROUP BY particulars
                                            HAVING (SUM(tbl_stock_janitorial.quantity) - SUM(tbl_stock_janitorial.issuance_qty)) <= tbl_particulars_janitorial.order_level";
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result) > 0):
                                        foreach($result as $particulars){
                                ?>
                                    <tr>
                                        <td style="display:none;"><?= $particulars['id']; ?></td>
                                        <td><?= $particulars['particulars']; ?></td>
                                        <td><?= $particulars['avail_stocks'];?></td>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>

</body>
</html>