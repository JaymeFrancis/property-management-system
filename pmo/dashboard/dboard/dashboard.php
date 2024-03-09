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
                    <div class="col-6">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Stocks For <br> Purchase Order</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                            $date = date('F');  
                                            $queryStkrm = "SELECT tbl_particulars_stockroom.*, (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) AS avail_stocks 
                                                    FROM tbl_particulars_stockroom
                                                    INNER JOIN tbl_stock_stockroom ON tbl_particulars_stockroom.particulars = tbl_stock_stockroom.particulars
                                                    WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_stockroom WHERE tbl_particulars_stockroom.particulars = tbl_purchaseitems_stockroom.particulars AND tbl_purchaseitems_stockroom.month = '$date')
                                                    GROUP BY particulars
                                                    HAVING (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) <= tbl_particulars_stockroom.order_level";
                                            $resultstkrm = mysqli_query($conn, $queryStkrm);
                                            $stkrm = mysqli_num_rows($resultstkrm);

                                            $queryJtrl = "SELECT tbl_particulars_janitorial.*, (SUM(tbl_stock_janitorial.quantity) - SUM(tbl_stock_janitorial.issuance_qty)) AS avail_stocks 
                                                    FROM tbl_particulars_janitorial
                                                    INNER JOIN tbl_stock_janitorial ON tbl_particulars_janitorial.particulars = tbl_stock_janitorial.particulars
                                                    WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_janitorial WHERE tbl_particulars_janitorial.particulars = tbl_purchaseitems_janitorial.particulars AND tbl_purchaseitems_janitorial.month = '$date')
                                                    GROUP BY particulars
                                                    HAVING (SUM(tbl_stock_janitorial.quantity) - SUM(tbl_stock_janitorial.issuance_qty)) <= tbl_particulars_janitorial.order_level";
                                            $resultjtrl = mysqli_query($conn, $queryJtrl);
                                            $jtrl = mysqli_num_rows($resultjtrl);
                                            echo $stkrm + $jtrl;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-shopping-cart fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        For Purchase Order <br> (Stockroom Supplies)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $date = date('F');  
                                        $queryStkrm = "SELECT tbl_particulars_stockroom.*, (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) AS avail_stocks 
                                                FROM tbl_particulars_stockroom
                                                INNER JOIN tbl_stock_stockroom ON tbl_particulars_stockroom.particulars = tbl_stock_stockroom.particulars
                                                WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_stockroom WHERE tbl_particulars_stockroom.particulars = tbl_purchaseitems_stockroom.particulars AND tbl_purchaseitems_stockroom.month = '$date')
                                                GROUP BY particulars
                                                HAVING (SUM(tbl_stock_stockroom.quantity) - SUM(tbl_stock_stockroom.issuance_qty)) <= tbl_particulars_stockroom.order_level";
                                        $resultstkrm = mysqli_query($conn, $queryStkrm);
                                        $stkrm = mysqli_num_rows($resultstkrm);
                                        echo $stkrm;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-shopping-cart fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    For Purchase Order <br> (Janitorial Supplies)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $date = date('F');  
                                        $queryJtrl = "SELECT tbl_particulars_janitorial.*, (SUM(tbl_stock_janitorial.quantity) - SUM(tbl_stock_janitorial.issuance_qty)) AS avail_stocks 
                                                    FROM tbl_particulars_janitorial
                                                    INNER JOIN tbl_stock_janitorial ON tbl_particulars_janitorial.particulars = tbl_stock_janitorial.particulars
                                                    WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_janitorial WHERE tbl_particulars_janitorial.particulars = tbl_purchaseitems_janitorial.particulars AND tbl_purchaseitems_janitorial.month = '$date')
                                                    GROUP BY particulars
                                                    HAVING (SUM(tbl_stock_janitorial.quantity) - SUM(tbl_stock_janitorial.issuance_qty)) <= tbl_particulars_janitorial.order_level";
                                            $resultjtrl = mysqli_query($conn, $queryJtrl);
                                        $jtrl = mysqli_num_rows($resultjtrl);
                                        echo $jtrl;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-shopping-cart fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Surrendered Equipment</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $query = "SELECT * FROM tbl_inventory WHERE status != 'OK'";
                                        $result = mysqli_query($conn, $query);
                                        $rows = mysqli_num_rows($result);

                                        echo $rows;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-cogs fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        For Repair</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $query = "SELECT * FROM tbl_inventory WHERE status = 'For Repair'";
                                        $result = mysqli_query($conn, $query);
                                        $rows = mysqli_num_rows($result);

                                        echo $rows;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-gavel fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        For Disposal</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $query = "SELECT * FROM tbl_inventory WHERE status = 'For Disposal'";
                                        $result = mysqli_query($conn, $query);
                                        $rows = mysqli_num_rows($result);

                                        echo $rows;
                                    ?>
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-trash fa-3x text-gray-300"></i>
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

</body>
</html>