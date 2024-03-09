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
                        <h2>Janitorial Supplies</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Stock Management</li>
                                <li class="breadcrumb-item active" aria-current="page">Janitorial Supplies</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                            <a class="btn btn-primary float-end" href="add-particulars.php" role="button">Add Particulars</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">id</th>
                            <th style="display:none;">id</th>
                            <th>Particulars</th>
                            <th>Item Code</th>
                            <th>Available Stocks</th>
                            <th>Order Level</th>
                            <th style="display:none;">Stock Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT tbl_particulars_janitorial.*, SUM(tbl_stock_janitorial.rem_qty) AS avail_stocks 
                                  FROM tbl_particulars_janitorial
                                  INNER JOIN tbl_stock_janitorial ON tbl_particulars_janitorial.particulars = tbl_stock_janitorial.particulars
                                  GROUP BY particulars";
                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $particulars){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $particulars['uid']; ?></td>
                            <td style="display:none;"><?= $particulars['id']; ?></td>
                            <td><?= $particulars['particulars']; ?></td>
                            <td><?= $particulars['item_code']; ?></td>
                            <td><?= $particulars['avail_stocks']; ?></td>
                            <td><?= $particulars['order_level']; ?></td>
                            <td style="display:none;"><?= $particulars['stock_type']; ?></td>
                            <td>
                                <a href="edit-particulars.php?ref=<?= $particulars['id']; ?>" type="button" name="editParticulars" class="btn btn-warning btn-sm">Update</a>
                                <a href="jtrl-stocks.php?ref=<?= $particulars['id']; ?>" type="button" name="viewParticulars" class="btn btn-primary btn-sm">View</a>
                            </td>
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
    $('#example').DataTable();
});
</script>

</body>
</html>