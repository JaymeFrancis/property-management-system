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
                        if(isset($_GET['ref'])){
                            $refid = $_GET['ref'];
                            $query = "SELECT particulars FROM tbl_particulars_janitorial WHERE id = '$refid'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo '<h2>'.$row['particulars'].' Stocks</h2>';
                        } 
                        ?>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Stock Management</li>
                                <li class="breadcrumb-item"><a href="jtrl-particulars.php" style="text-decoration: none;">Janitorial Supplies</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Stocks</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                            <?php
                            if(isset($_GET['ref'])){
                                $refid = $_GET['ref'];
                                echo '<a class="btn btn-primary float-end" href="add-stock.php?ref='.$refid.'" role="button">Add Stock</a>';
                            }
                            ?>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Issued <br> Quantity</th>
                            <th>Issued <br> Amount</th>
                            <th>Remaining <br> Quantity</th>
                            <th>Remaining <br> Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_GET['ref'])):
                    $refid = $_GET['ref'];
                    $query = "SELECT *, quantity*price AS amount, issuance_qty*price AS issuance_amt, rem_qty*price AS rem_amt FROM tbl_stock_janitorial WHERE id = '$refid' AND rem_qty > 0";
                    $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $stock){
                    ?>
                        <tr>
                            <td><?= $stock['item_code'] ?></td>
                            <td><?= $stock['quantity'] ?></td>
                            <td><?= $stock['unit'] ?></td>
                            <td>₱<?= number_format((float)$stock['price'], 2,'.',',') ?></td>
                            <td>₱<?= number_format((float)$stock['amount'], 2,'.',',') ?></td>
                            <td><?= $stock['issuance_qty'] ?></td>
                            <td>₱<?= number_format((float)$stock['issuance_amt'], 2,'.',',') ?></td>
                            <td><?= $stock['rem_qty'] ?></td>
                            <td>₱<?= number_format((float)$stock['rem_amt'], 2,'.',',') ?></td>
                            <td>
                                <a href="edit-stock.php?ref=<?= $stock['uid']; ?>" type="button" name="" class="btn btn-primary btn-sm">Update</a>
                            </td>
                        </tr>
                        <?php
                            }
                        endif;
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
        order: [[0, 'desc']]
    });
});
</script>

</body>
</html>