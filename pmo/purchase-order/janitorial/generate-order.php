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
                        <h2>Generate Purchase Order</h2> 
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Purchase Order</li>
                                <li class="breadcrumb-item"><a href="orders.php" style="text-decoration: none;">List of Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Generate Purchase Order</li>
                            </ol>
                        </nav>      
                    </div>
                    <div class="col-6 md-6 order-md-2 order-last">  
                        <a class="btn btn-close float-end" href="orders.php" role="button" style="border-radius: 0;"></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Janitorial Supplies</h4>
                        </div>
                        <div class="card-body ">
                            <table class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Particulars</th>
                                        <th>Quantity</th>
                                        <th>Units</th>
                                        <th class="col-1"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addItem">Add Item</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM sample_order";
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result) > 0){
                                        foreach($result as $orders){
                                    ?>
                                    <tr>
                                        <td style="display: none;"><?= $orders['id'] ?></td>
                                        <td><?= $orders['particulars'] ?></td>
                                        <td><?= $orders['quantity'] ?></td>
                                        <td><?= $orders['unit'] ?></td>
                                        <td class="col-1">
                                            <button type="button" name="update-item" class="btn btn-warning update-item"><i class="fa fa-edit"></i></button>
                                            <a href="fn-jtrl.php?remove=<?= $orders['id'] ?>" class="btn btn-danger remove-item"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <a href="fn-jtrl.php?generateOrder=generateOrder" type="button" class="btn btn-primary float-end" id="generateOrder" name="generateOrder">Generate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Add Item-->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="fn-jtrl.php" method="POST" novalidate>
        <div class="modal-header">
            <h1 class="modal-title fs-4 text-uppercase" id="exampleModalLabel">Enter Item Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?php
            $date = date('F');
            $query = "SELECT particulars 
                    FROM tbl_particulars_janitorial 
                    WHERE NOT EXISTS (SELECT particulars FROM tbl_purchaseitems_janitorial 
                    WHERE tbl_particulars_janitorial.particulars = tbl_purchaseitems_janitorial.particulars 
                    AND tbl_purchaseitems_janitorial.month = '$date')
                    AND NOT EXISTS (SELECT particulars FROM sample_order
                    WHERE tbl_particulars_janitorial.particulars = sample_order.particulars)";
            $result = mysqli_query($conn, $query);
        ?>
        <div class="modal-body row">
            <div class="col-md-6 md-6 md-3">
                <label> Particulars </label>
                <select class="form-control" id="validationCustom01" name="particulars" onchange="showParticulars(this.value)" required>
                <option value="" selected disabled>Select Item</option>
                <?php
                while(list($particulars) = mysqli_fetch_row($result)){
                    echo '<option value="'.$particulars.'">'.$particulars.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="col-md-6 md-6 md-3">
                <label> Quantity </label>
                <input type="number" name="quantity" placeholder="Enter Quantity" class="form-control">
            </div>
                <input type="hidden" name="unit"  id="fetch-unit" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="submit" name="addItem" class="btn btn-primary">Add</button>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update-item" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="fn-jtrl.php" method="POST" novalidate>
        <div class="modal-header">
            <h1 class="modal-title fs-4 text-uppercase" id="exampleModalLabel">Enter Item Quantity</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">
                <input type="hidden" name="id"  id="id" class="form-control">
            <div class="col-md-6 md-6 md-3">
                <label> Particulars </label>
                <input type="text" name="particulars" id="particulars" class="form-control bg-secondary bg-opacity-10" onfocus="this.blur()" readonly="readonly">
            </div>
            <div class="col-md-6 md-6 md-3">
                <label> Quantity </label>
                <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity" class="form-control">
            </div>
                <input type="hidden" name="unit"  id="unit" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="submit" name="update-item" class="btn btn-primary">OK</button>
            <input type="reset" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {

        $('.update-item').on('click', function () {

            $('#update-item').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            
            $('#id').val(data[0]);
            $('#particulars').val(data[1])
            $('#quantity').val(data[2]);
            $('#unit').val(data[3]);
        });
    });
</script>

<!--Modal Script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include '../../../message.php';?>

<script>
//Item Code
function showParticulars(str) {
if (str == "") {
  document.getElementById("fetch-unit").innerHTML = "";
  return;
}
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
  document.getElementById("fetch-unit").value = this.responseText;
}
xhttp.open("GET", "fn-jtrl.php?p="+str);
xhttp.send();
}

//Remove Item
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


//Generate Purchase Order
$('#generateOrder').on('click', function(event){
    event.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
        title: "Are you sure?",
        text: "Generate these items for purchase order?",
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

</body>
</html>