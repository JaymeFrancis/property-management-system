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
                        <h2>Surrender Of Surplus Property</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Equipment and Fixtures</li>
                                <li class="breadcrumb-item active" aria-current="page">Surrender</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">
                        <div class="dropdown float-end">
                            <button class="btn btn-primary dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="printSE.php"  target="_blank">Print</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#forrepair">For Repair</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#fordisposal">For Disposal</a></li>
                            </ul>
                        </div>   
                    </div>
                </div>
            </div>

          <!-- View Items -->           
            <div class="row">
              <div class="col-md-12">
                <div class="card overflow-hidden">
                  <div class="card-header">
                    <h4>List of Surrendered Equipment</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive text-nowrap">
                          <table id="example" class="table table-striped " style="width:100%;">
                              <thead>
                                  <tr>
                                      <th style="display:none;">id</th>
                                      <th>MR Number</th>
                                      <th>Particulars</th>
                                      <th>Quantity</th>
                                      <th>Unit</th>
                                      <th>Price</th>
                                      <th>Amount</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php 
                                  $query = "SELECT *, quantity*price AS amount  FROM tbl_inventory WHERE status != 'OK'";
                                  $result = mysqli_query($conn, $query);
                                  if(mysqli_num_rows($result) > 0):
                                      foreach($result as $inventory){
                              ?>
                                  <tr>
                                      <td style="display:none;"><?= $inventory['id']; ?></td>
                                      <td><?= $inventory['mr_no']; ?></td>
                                      <td><?= $inventory['particulars']; ?></td>
                                      <td><?= $inventory['quantity']; ?></td>
                                      <td><?= $inventory['unit']; ?></td>
                                      <td>₱<?= number_format((float)$inventory['price'], 2, '.', ','); ?></td>
                                      <td>₱<?= number_format((float)$inventory['amount'], 2, '.', ','); ?></td>
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
            </div>
          </div>


<div class="modal fade" id="forrepair" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalLabel">For Repair Equipment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">id</th>
                            <th>MR Number</th>
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT *  FROM tbl_inventory WHERE status = 'For Repair'";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $inventory){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $inventory['id']; ?></td>
                            <td><?= $inventory['mr_no']; ?></td>
                            <td><?= $inventory['particulars']; ?></td>
                            <td><?= $inventory['quantity']; ?></td>
                            <td><?= $inventory['unit']; ?></td>
                        </tr>
                    <?php
                        }
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="printEFR.php" target="_blank" type="submit" id="submit" name="repairPrint" class="btn btn-primary">Print</a>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="fordisposal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalLabel">For Disposal Equipment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped " style="width:100%;">
                    <thead>
                        <tr>
                            <th style="display:none;">id</th>
                            <th>MR Number</th>
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT *  FROM tbl_inventory WHERE status = 'For Disposal'";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0):
                            foreach($result as $inventory){
                    ?>
                        <tr>
                            <td style="display:none;"><?= $inventory['id']; ?></td>
                            <td><?= $inventory['mr_no']; ?></td>
                            <td><?= $inventory['particulars']; ?></td>
                            <td><?= $inventory['quantity']; ?></td>
                            <td><?= $inventory['unit']; ?></td>
                        </tr>
                    <?php
                        }
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="printEFD.php" target="_blank" type="submit" id="submit" name="repairPrint" class="btn btn-primary">Print</a>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>