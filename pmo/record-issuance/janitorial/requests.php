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
                        <h2>Janitorial Issuance</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Record Issuance</li>
                                <li class="breadcrumb-item active" aria-current="page">Janitorial Issuance</li>
                            </ol>
                        </nav>     
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                            <a class="btn btn-primary float-end" href="new-issuance.php" role="button">New Issuance</a>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th>Issuance No.</th>
                            <th>Recipient</th>
                            <th>Office</th>
                            <th>Date of Request</th>
                            <th>Date Released</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_request_janitorial";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $issuance){
                        ?>
                        <tr>
                            <td><?= $issuance['iss_no'] ?></td>
                            <td><?= $issuance['recipient'] ?></td>
                            <td><?= $issuance['office'] ?></td>
                            <td><?= $issuance['req_date'] ?></td>
                            <td><?= $issuance['rcv_date'] ?></td>
                    <?php if($issuance['status'] == "Pending" ){
                        echo '<td style="color: tomato;">'.$issuance['status'].'</td>';
                        echo '<td>
                                <a href="edit-issuance.php?ref='.$issuance['iss_no'].'" type="button" name="editIssuance" class="btn btn-warning btn-sm">Update</a>
                                <a href="issued-items.php?ref='.$issuance['iss_no'].'" type="button" name="viewItems" class="btn btn-primary btn-sm">Add Items</a>
                            </td>';
                    }elseif($issuance['status'] == "Issued"){
                        echo '<td style="color: green;">'.$issuance['status'].'</td>';
                        echo '<td><a href="view-issued.php?ref='.$issuance['iss_no'].'" type="button" name="viewIssuance" class="btn btn-info btn-sm">View</a></td>';
                    } ?>
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
<script>
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
    $('#example').DataTable({
        order: [[6, 'asc']],
        order: [[0, 'desc']]
    });
});
</script>

</body>
</html>