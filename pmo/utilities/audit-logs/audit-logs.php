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
                         <h2>Audit Logs</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Utilities</li>
                                <li class="breadcrumb-item active" aria-current="page">Audit Logs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display: none;">id</th>
                            <th class="col-md-4" style="text-align: center">Date</th>
                            <th class="col-md-4" style="text-align: center">Activity</th>
                            <th class="col-md-4" style="text-align: center">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `audit_logs`";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result)>0){
                            foreach($result as $rows){
                        ?>
                        <tr>
                            <td style="display: none;"><?= $rows['id'] ?></td>
                            <td class="col-md-4" style="text-align: center"><?= date('F d, Y',strtotime($rows['date'])) ?></td>
                            <td class="col-md-4" style="text-align: center"><?= $rows['activity'] ?></td>
                            <td class="col-md-4" style="text-align: center"><?= $rows['user'] ?></td>
                        </tr>
                        <?php
                                }
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