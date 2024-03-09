<?php 
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  </head>
  <body class="index">
    <header>
      <nav class="nav-bar">
        <div class="nav">
        <img class="index-logo" src="assets/images/logo.png" alt="logo">
        <ul class="nav-text" style="padding-left: 5px; margin-top: 15px;">
          <h2 style="margin-bottom: 0;">Property Management System</h2>
          <h3 style="margin-bottom: 0;">Saint Louis College</h3>
          <p style="margin-bottom: 5px;">City of San Fernando, La Union</p>
          <hr style="border: 1px solid blue; margin: 0;">
        </ul>
        </div>
      </nav>
    </header>
    <div class="login-form">
        <h1>Account Login</h1>
        <hr>
        <form class="needs-validation" action="function.php" method="post" novalidate>
            <label>User Name</label>
            <input type="text" class="form-control" name="username" placeholder="User Name" required>
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          <button type="submit" name="login">Login</button>
        </form>
    </div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include 'message.php';
?>

<script>
(function() {
'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>