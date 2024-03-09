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
                        <h2>List of Purchase Orders for Stockroom Supplies</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Purchase Order</li>
                                <li class="breadcrumb-item active" aria-current="page">List of Orders</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                        <form action="fn-stkrm.php" method="post">
                            <button type="submit" name="generateItems" class="btn btn-primary float-end">Generate <br> Purchase Order</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT * FROM tbl_purchase_stockroom";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $purchase){
                    ?>
                        <tr>
                            <td><?= $purchase['id']; ?></td>
                            <td><?= $purchase['month']; ?></td>
                            <td><?= $purchase['year']; ?></td>
                            <td>
                                <a href="print.php?print=<?= $purchase['id']; ?>" target="_blank" type="button" name="printOrder" class="btn btn-info"><i class="fa fa-print"></i></a>
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

<!--Sweet Alert-->
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
        order: [[0,'desc']],
    });
});
</script>

</body>
</html>