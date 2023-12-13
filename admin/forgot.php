<?php
include "inc/db.php";
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Forgot Password</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .rph::placeholder {
      color: aliceblue !important;
    }
  </style>
</head>

<body class="hold-transition login-page bg-dark">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="color:aliceblue"><b>Forgot Password</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body bg-dark">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control bg-dark rph" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="reqst" class="btn btn-primary btn-block">Request new password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <?php
        $email = '';
        $password = '';
        if (isset($_POST['reqst'])) {
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $sql = "SELECT * FROM users WHERE email='$email'";
          $connction = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($connction)) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['status'] = $row['status'];
            if (
              $email == $_SESSION['email'] && $_SESSION['status'] == 1
            ) {
                echo '<script>
                  swal({
                      title: "Successfully Resset",
                      text: "Enter your new password!",
                      icon: "success",
                  }).then(function() {
                      window.location.href = "password.php";
                  });
              </script>';
              //header("location:password.php");
            } else {
              header("location:forgot.php");
            }
          }
        }
        ?>
        <p class="mt-3 mb-1">
          <a href="index.php" style="color:aliceblue">Login</a>
        </p>
        <p class="mb-0">
          <a href="register.php?do=Addfrom" style="color:aliceblue" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>
