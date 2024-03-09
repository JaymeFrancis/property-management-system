<!DOCTYPE html>
<html lang="en">
<?php include '../../../head.php'; ?>
<body>

<?php 
session_start();
require '../../../config.php'; 
?>

<div class="wrapper">
<?php include '../../auditor-nav.php'; ?>
    <div class="main_content">
    <?php include '../../../navbar.php'; ?>

        <div class="info">
            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6 md-6 order-md-1 order-first">
                        <h2>Janitorial Issuance Report</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Reports</li>
                                <li class="breadcrumb-item active" aria-current="page">Janitorial Issuance</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                            
                    </div>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">Order Id</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT * FROM janitorial_issuance_report";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $purchase){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $purchase['id']; ?></td>
                            <td><?= $purchase['month']; ?></td>
                            <td><?= $purchase['year']; ?></td>
                            <td>
                                <a href="printSIR.php?ref=<?= $purchase['id']; ?>" target="_blank" type="button" name="printOrder" class="btn btn-info"><i class="fa fa-print"></i></a>
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

<div class="modal fade" id="generateSIR" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="fn-report.php" method="POST" novalidate>
        <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalLabel">Select Report Month</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8 md-8 mb-3">
                    <label> Month </label>
                    <select class="form-control" id="validationCustom01" name="month" required>
                    <option value="<?php echo date('F'); ?>" selected><?php echo date('F'); ?></option>
                    <?php
                    array_reduce(range(1,12),function($rslt,$m){ $rslt[$m] = date('F',mktime(0,0,0,$m,10)); 
                    echo '<option value"'.$rslt[$m].'">'.$rslt[$m].'</option>';
                    return $rslt; })
                    ?>
                    </select>
                </div>
                <div class="col-md-4 md-4 mb-3">
                    <label>Year</label>
                    <input type="number" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" value="<?php echo date('Y'); ?>" name="year" readonly>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="generateWJI" class="btn btn-primary">Submit</button>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

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
    $('#example').DataTable();
});
</script>

</body>
</html>