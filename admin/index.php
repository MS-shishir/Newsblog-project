<?php
ob_start();
include "inc/db.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="dist/js/switealart.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>
  <link rel="icon" type="image/x-icon" href="dist/img/icon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
</head>


<body class="hold-transition bg-dark login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="color:#ffff !important;text-decoration: none;"><b>LogIn</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card text-white border-1 border-white">
      <div class="card-body login-card-body bg-dark">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control bg-dark sbs" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control bg-dark sbs" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>

            </div>
            <!-- /.col -->
          </div>
        </form>

        <?php

        $email = '';
        $password = '';
        if (isset($_POST['login'])) {
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $password = mysqli_real_escape_string($conn, $_POST['password']);
          $hassed = sha1($password);
          $sql = "SELECT * FROM users WHERE email='$email'";
          $connction = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($connction)) {
            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['user_nam'] = $row['user_nam'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            // $_SESSION['address'] = $row['address'];
            // $_SESSION['phone'] = $row['phone'];
            $_SESSION['Role'] = $row['Role'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['image'] = $row['image'];
            // $_SESSION['join_date'] = $row['join_date'];

            if (
              $email == $_SESSION['email'] && $hassed == $_SESSION['password'] && $_SESSION['status'] == 1
            ) {
              echo '<script>
                swal({
                    title: "Successfully Login",
                    text: "Welcome to the Dashboard!",
                    icon: "success",
                }).then(function() {
                    window.location.href = "dashboard.php";
                });
            </script>';
            } elseif ($email = $_SESSION['email'] && $hassed == $_SESSION['password'] && $_SESSION['status'] != 1) {
              echo '<script>
                swal({
                    title: "Diend Acsess",
                    text: "Please Wait for Acsess Permission",
                    icon: "info",
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>';
            } elseif ($email = $_SESSION['email'] && $hassed != $_SESSION['password'] && $_SESSION['status'] == 1) {
              echo '<script>
                swal({
                    title: "Invalid Password",
                    text: "Please enter correct Password",
                    icon: "warning",
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>';
            }
             else {
              echo '<script>
                swal({
                    title: "Invalid Login",
                    text: "Please Enter curract information",
                    icon: "error",
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>';
            }
          }
        }
        ?>


        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot.php" style="color:#ffff !important; text-decoration: none;">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.php?do=Addfrom" class="text-center" style="color:#ffff !important; text-decoration: none;">Register a
            new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</body>

</html>
<?php ob_end_flush() ?>
