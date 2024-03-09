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
                        <h2>Back-up Database</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Utilities</li>
                                <li class="breadcrumb-item active" aria-current="page">Back-up</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
           
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Back-up Database</h4>
                  </div>
                  <div class="card-body ">
                      <a href="backup.php" type="button" class="btn btn-primary" id="back-up">Backup Database</a>
                      <p class="mt-3 px-2 fw-bold">Create a copy of data that can be recovered in the event of a primary data failure.</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<script>
  $('#back-up').on('click', function(event){
    event.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
        title: "Are you sure?",
        text: "You want to back up your data base?",
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>

  
  </body>
</html>