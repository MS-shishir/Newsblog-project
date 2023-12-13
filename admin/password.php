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
  <title>AdminLTE 3 | Recover Password</title>
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

<body class="hold-transition login-page bg-dark ">
  <div class="login-box">
    <div class="login-logo">
      <a href="" class="text-light "><b>Change password</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body bg-dark ">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <?php
        //  if($do=='edit'){

        if (isset($_SESSION['email'])) {
          $update_info = $_SESSION['email'];

          $sql_update = "SELECT* FROM users WHERE email='$update_info'";
          $edit = mysqli_query($conn, $sql_update);
          while ($row = mysqli_fetch_assoc($edit)) {
            $password = $row['password'];
            $status = $row['status'];
          }
        }

        ?>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="password" class="form-control rph bg-dark" name="user_pass" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control rph bg-dark" name="user_repass" placeholder="Confirm Password" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="Updated" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <?php
        if (isset($_POST['Updated'])) {
          // $user_name = $_POST['user_name'];
          // $user_mail = $_POST['user_mail'];
          $user_pass = sha1($_POST['user_pass']);

          $user_repass = sha1($_POST['user_repass']);
          if ($user_pass == $user_repass) {

            $update_sql = "UPDATE users SET password='$user_pass' WHERE email='$update_info'";

            $Update_entry = mysqli_query($conn, $update_sql);

            if ($Update_entry) {
              echo '<script>
                  swal({
                      title: "Your password is change",
                      text: "Login your Dashboard!",
                      icon: "success",
                  }).then(function() {
                      window.location.href = "index.php";
                  });
              </script>';
              // header("Location:index.php");
            }elseif($user_pass != $user_repass){
              echo '<script>
                  swal({
                      title: "Wrong password",
                      text: "Confurm password invalid!",
                      icon: "success",
                  }).then(function() {
                      window.location.href = "password.php";
                  });
              </script>';
            }
             else {
              die("Mysqli Error" . mysqli_error($conn));
            }
          }
        }

        ?>
        <p class="mt-3 mb-1">
          <a href="index.php " class="text-light">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <?php ob_end_flush(); ?>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
