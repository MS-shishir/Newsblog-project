<?php
ob_start();
include "inc/db.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>
  <link rel="icon" type="image/x-icon" href="dist/img/icon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    .td {
      text-decoration: none;
    }

    .rph::placeholder {
      color: aliceblue !important;
    }
  </style>
</head>

<body class="hold-transition register-page bg-dark">
  <?php
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  if ($do == 'Addfrom') {
  ?>
    <div class="register-box">
      <div class="register-logo">
        <a href="#" style=" color:#ffff !important;text-decoration: none;"><b>Register</b></a>
      </div>

      <div class="card">
        <div class="card-body register-card-body bg-dark">
          <p class="login-box-msg">Register a new membership</p>

          <form action="register.php?do=insert" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
              <input type="text" class="form-control bg-dark rph" name="user" placeholder="Full name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control bg-dark rph" name="mail" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control  bg-dark rph" name="pass" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control bg-dark rph" name="re_pass" placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                  <label for="agreeTerms">
                    I agree to the <a href="#">terms</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i>
              Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Sign up using Google+
            </a>
          </div>
          <a href="index.php" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>

    <?php } elseif ($do == "insert") {
    // $imagename = '';
    // $imageTmp = '';
    $user = '';
    // $status = '';
    // $role = '';
    $re_pass = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // isset($_POST['submit']
      $user = $_POST["user"];
      $email = $_POST["mail"];
      $password = sha1($_POST["pass"]);
      $re_pass = sha1($_POST['re_pass']);
      // $status = $_POST["status"];
      // $role = $_POST["role"];

    //   $imagename = $_FILES['image']['name'];
    //   $imageSize = $_FILES['image']['size'];
    //   $imageTmp = $_FILES['image']['tmp_name'];
    //   $exploded = explode('.', $_FILES['image']['name']);
    //   $lastElement = end($exploded);
    //   $imageExtention = strtolower($lastElement);
    //   $imageAllowExtantion = array('jpg', 'jpeg', 'png');
    //   $fromerror = array();
    // ?>

       <?php
    // }
    // if (!empty($imagename)) {
    //   if (!empty($imagename) && !in_array($imageExtention, $imageAllowExtantion)) {
    //     $fromerror = "Invlid Image";
    //   }
    //   if (!empty($imageSize) && $imageSize > 2097152) {
    //     $fromerror = "Invlid Image size. Allow size 2 MB";
    //   }
    // }
    // if (!empty($fromerror)) {
    //   header("Location:users.php?do=Addfrom");
    //   exit();
    // }
    // if (empty($fromerror)) {
    //   $image = rand(0, 999999) . '_' . $imagename;
    //   move_uploaded_file($imageTmp, "dist/users_image\\" . $image);

     if (strlen($user) > 3 && strlen($password) >= 8 && $password == $re_pass) {

        $sql = "INSERT INTO `users` (`user_nam`,`email`,`password`)
       VALUES ('$user','$email','$password')";
         if ($conn->query($sql) === TRUE) {
          ?>
               <script>
                    swal({
                        title: "Success",
                        text: "User added successfully!",
                        icon: "success",
                    }).then(function() {
                        window.location.href = "index.php";
                    });
                </script>';
                <?php

            } else {
                die("Error" . mysqli_error($conn));
            }
        } else {
          ?>
            <script>
                swal({
                    title: "Error",
                    text: "Invalid user data",
                    icon: "error",
                }).then(function() {
                    window.location.href = "register.php?do=Addfrom";
                });
            </script>';
            <?php
        }
    //}
}
    }
?>

  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>




</body>

</html>
<?php ob_end_flush() ?>
