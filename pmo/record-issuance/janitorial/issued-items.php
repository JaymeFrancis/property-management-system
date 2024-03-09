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
        <?php
        if(isset($_GET['ref'])){
            $refid = $_GET['ref'];
        ?>
            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6 md-6 order-md-1 order-first">
                        <h2>Issuance No. <?= $refid ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Record Issuance</li>
                                <li class="breadcrumb-item"><a href="requests.php" style="text-decoration: none;">Janitorial Issuance</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Issued Items</li>
                            </ol>
                        </nav>                
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                        <a class="btn btn-close float-end" href="requests.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Issued Items</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <?php
                                    if(isset($_GET['ref'])):
                                        $refid = $_GET['ref'];
                                        $query = "SELECT * FROM tbl_ris_janitorial WHERE iss_no = '$refid'";
                                        $result = mysqli_query($conn, $query);
                                    ?>
                                        <tr>
                                            <td style="display: none;">ID</td>
                                            <th style="display: none;">Issuance No.</th>
                                            <th>Particulars</th>
                                            <th>Item Code</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>
                                                <a class="btn btn-success btn-sm" href="add-items.php?ref=<?= $refid ?>" role="button">Add Items</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                    <?php
                                        if(mysqli_num_rows($result) > 0):
                                            foreach($result as $items){
                                    ?>
                                        <tr>
                                            <td style="display: none;"><?= $items['id']; ?></td>
                                            <td style="display: none;"><?= $items['iss_no']; ?></td>
                                            <td><?= $items['particulars']; ?></td>
                                            <td><?= $items['item_code'] ?></td>
                                            <td><?= $items['quantityReq']; ?></td>
                                            <td><?= $items['unit']; ?></td>
                                            <td>
                                                <a href="fn-jtrl.php?remove=<?= $items['id']; ?>" type="button" name="removeItem" class="btn btn-danger btn-sm px-3 remove-item">Remove</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                                <a href="fn-jtrl.php?releaseID=<?=$refid?>" type="button" name="releaseIssuance" class="btn btn-primary float-end release-issuance">Release</a>
                                <?php
                                endif;
                                ?>
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

<!-- Remove Item -->
<script>
$('.remove-item').on('click', function(event){
    event.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
        text: "Do you really want to remove this item?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        confirmButtonColor: 'blue',
        focusCancel: true,
        returnFocus: false,
    }).then((result) => {
        if(result.value){
            document.location.href = href;
        }
    })
})

$('.release-issuance').on('click', function(event){
    event.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
        text: "Do you really want to release this issuance?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        confirmButtonColor: 'blue',
        focusCancel: true,
        returnFocus: false,
    }).then((result) => {
        if(result.value){
            document.location.href = href;
        }
    })
})
</script>

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