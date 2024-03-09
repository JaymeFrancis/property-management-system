<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Management System</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body class="dashboard">
<?php
  require 'config.php';
  session_start();
  include 'admin-nav.php';
?>

<!-- User List -->
<div class="container mt-4">
<?php include('message.php'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List of Users
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addUser">
            Add User
          </button>
          </h4>
        </div>
        <div class="card-body">
          <table class="table table-border table-striped">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Actions</th>
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
                        <button type="button" class="btn btn-warning btn-sm editbtn"> Edit </button>
                        <button type="button" class="btn btn-danger btn-sm deletebtn"> Delete </button>
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
</div>

<!-- Add User Form (Modal) -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>      
      <form action="function.php" method="POST">
      <div class="modal-body">
        <div class="mb-3">
            <label>Employee ID</label>
            <input type="number" name="emp_id" class="form-control">
        </div>
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="fname" class="form-control">
        </div>
        <div class="mb-3">
            <label>Middle Name</label>
            <input type="text" name="mname" class="form-control">
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control">
        </div>
        <div class="mb-3">
          <label>Position</label>
          <select class="form-select" name="user_lvl" aria-label="Default select example" class="mb-3">
              <option selected>Select User Position</option>
              <option value="Admin">Admin</option>
              <option value="PMO">Property Management Officer</option>
              <option value="Auditor">Auditor</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="add-user" class="btn btn-primary">Add User</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit User Form (Modal) -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit User Data </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="function.php" method="POST">
      <div class="modal-body">
          <div class="form-group">
            <label> Employee ID </label>
            <input type="number" name="update_id" id="update_id" class="form-control" placeholder="Enter Employee ID">
          </div>
          <div class="form-group">
            <label> First Name </label>
            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
          </div>
          <div class="form-group">
            <label> Middle Name </label>
            <input type="text" name="mname" id="mname" class="form-control" placeholder="Enter Middle Name">
          </div>
          <div class="form-group">
            <label> Last Name </label>
            <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="update-user" class="btn btn-primary">Update Data</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- DELETE USER FORM (MODAL) -->
    <div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <h4>Do you want to Delete this User?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete-user" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<!-- edit script -->
  <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#edit-user').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#fname').val(data[1]);
                $('#mname').val(data[2]);
                $('#lname').val(data[3]);
            });
        });
    </script>

<!-- delete script -->
    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#delete-user').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>