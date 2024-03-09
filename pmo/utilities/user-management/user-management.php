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
                         <h2>User Management</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Utilities</li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                            <a class="btn btn-primary float-end" href="add-user.php" role="button" >Add User</a>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT * FROM tbl_users";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result) > 0){
                                foreach($result as $users){
                    ?>
                             <tr>
                                <td><?= $users['emp_id']; ?></td>
                                <td><?= $users['fname']; ?></td>
                                <td><?= $users['mname']; ?></td>
                                <td><?= $users['lname']; ?></td>
                                <td><?= $users['user_lvl']; ?></td>
                                <td>Active</td>
                                <td>
                                <button type="button" class="btn btn-primary btn-sm"> Details </button>
                                </td>
                            </tr>
                    <?php
                            }
                         }else{
                            echo "<h5> No Record Found </h5>";
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
    $('#example').DataTable();
});
</script>

</body>
</html>