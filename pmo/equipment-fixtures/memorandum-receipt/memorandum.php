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
                        <h2>Memorandum Receipt</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Memorandum Receipt</li>
                                <li class="breadcrumb-item active" aria-current="page">Generated Memorandum Receipt</li>
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
                            <th>Memorandum Receipt</th>
                            <th>Recipient</th>
                            <th>Date Generated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT * FROM tbl_memo_receipt";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $memo){
                    ?>
                        <tr>
                            <td><?= $memo['mr_number']; ?></td>
                            <td><?= $memo['recipient'] ?></td>
                            <td><?= $memo['date']; ?></td>
                            <td><a href="printMR.php?mr=<?= $memo['mr_number']; ?>" target="_blank" type="button" class="btn btn-info btn-sm">View</a></td>
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
        order: [[0, 'desc']]
    });
});
</script>           

</body>
</html>        