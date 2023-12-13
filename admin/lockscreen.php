<?php
include "inc/db.php";
ob_flush();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Lockscreen</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .rph {
      border: 1px solid white !important;
    }

    .rph::placeholder {
      color: aliceblue !important;

    }
  </style>
</head>

<body class="hold-transition lockscreen bg-dark ">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper bg-dark ">
    <div class="lockscreen-logo">
      <a href="" class="text-light"><b>Admin</b>LTE</a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name"><?php echo $_SESSION['user_nam'] ?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item bg-dark ">
      <!-- lockscreen image -->
      <div class="lockscreen-image" style="background-color:black !important">
        <img src="dist/users_image/<?php echo $_SESSION['image'] ?>" alt="User Image">
      </div>
      <!-- /.lockscreen-image -->

      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials" action="" method="POST">
        <div class="input-group">
          <input type="password" class="form-control bg-dark rph" name="password" placeholder="password">

          <div class="input-group-append">
            <button type="submit" name="screenlogin" class="btn bg-dark  " style="border:1px solid white !important">
              <i class="fas fa-arrow-right  "></i>
            </button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->
      <?php

      $email = '';
      $password = '';
      if (isset($_POST['screenlogin'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $pass = sha1($password);


        if (
          $pass == $_SESSION['password']
        ) {
          // echo '<script>
          //     swal({
          //         title: "Successfully Login",
          //         text: "Welcome to the Dashboard!",
          //         icon: "success",
          //     }).then(function() {
          //         window.location.href = "dashboard.php";
          //     });
          // </script>';
          header("location:dashboard.php");
        } else {
          echo '<script>
                swal({
                    title: "Invalid Password",
                    text: "Please Enter curract Password",
                    icon: "error",
                }).then(function() {
                    window.location.href = "lockscreen.php";
                });
            </script>';
        }
      }

      ?>
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
      Enter your password to retrieve your session
    </div>
    <div class="text-center">
      <a href="index.php">Or sign in as a different user</a>
    </div>
    <div class="lockscreen-footer text-center">
      Copyright &copy; 2014-2020 <b><a href="#" class="text-black">AdminLTE.io</a></b><br>
      All rights reserved
    </div>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>
