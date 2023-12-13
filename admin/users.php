<?php include "inc/hader.php" ?>


<!-- Navbar -->
<?php include "inc/nav.php" ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include "inc/menu.php" ?>

<!-- Content Wrapper. Contains page content -->

<body class="hold-transition sidebar-mini layout-fixed bg-dark ">
  <div class="wrapper">
    <div class="content-wrapper bg-dark">
      <!-- Content Header (Page header) -->
      <?php
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

      if ($do == 'Addfrom') {
      ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
              <form action="users.php?do=insert" method="POST" enctype="multipart/form-data">
                <div class="beg p-lg-5 mb-4 shadow-lg">
                  <p class="h2 mt-0 TT"> Add New Users</p>
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">User name:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="user" placeholder="User name" id="inputtext">
                    </div>
                  </div>

                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Email:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="mail" placeholder="Email" id="inputtext">
                    </div>
                  </div>
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Password:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="pass" placeholder="Password" id="inputtext">
                    </div>
                  </div>

                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Role :</label>
                    <div class="col-sm-9">
                      <select class="form-select" name="role" id="Department" aria-label="Default select example">
                        <option selected>---Please Select A Role---</option>
                        <option value="1">Administrator</option>
                        <option value="2">Editor</option>
                      </select>
                    </div>
                  </div>

                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Status:</label>
                    <div class="col-sm-9">
                      <select class="form-select" name="status">
                        <option selected="">---Please Select Status---</option>
                        <option value="1">Publish</option>
                        <option value="0">Draft</option>
                      </select>
                      <!-- <input type="number" class="form-control" id="Regino" name="status" placeholder="status:" id="inputtext"> -->
                    </div>
                  </div>


                  <div class="row mt-3">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Uplode image :</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="image" id="inputtext">
                    </div>
                  </div>

                  <div class=" mt-4 row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                      <button class=" button fw-bold " name="submit" type="submit" id="submit">SUBMIT</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">

                </div>
              </form>
            </div>
          </div>
        </div>
        <?php } elseif ($do == "insert") {
        $imagename = '';
        $imageTmp = '';
        $user = '';
        $status = '';
        $role = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // isset($_POST['submit']
          $user = $_POST["user"];
          $email = $_POST["mail"];
          $password = sha1($_POST["pass"]);
          $status = $_POST["status"];
          $role = $_POST["role"];

          $imagename = $_FILES['image']['name'];
          $imageSize = $_FILES['image']['size'];
          $imageTmp = $_FILES['image']['tmp_name'];
          $exploded = explode('.', $_FILES['image']['name']);
          $lastElement = end($exploded);
          $imageExtention = strtolower($lastElement);
          $imageAllowExtantion = array('jpg', 'jpeg', 'png');
          $fromerror = array();
          // if(strlen($name)<3){
          //   $fromerror="plase enter name 4 character";
          //   echo $fromerror;
        ?>

          <?php
        }
        if (!empty($imagename)) {
          if (!empty($imagename) && !in_array($imageExtention, $imageAllowExtantion)) {
            $fromerror = "Invlid Image";
          }
          if (!empty($imageSize) && $imageSize > 2097152) {
            $fromerror = "Invlid Image size. Allow size 2 MB";
          }
        }
        if (!empty($fromerror)) {
          header("Location:users.php?do=Addfrom");
          exit();
        }
        if (empty($fromerror)) {
          $image = rand(0, 999999) . '_' . $imagename;
          move_uploaded_file($imageTmp, "dist/users_image\\" . $image);


          $sql = "INSERT INTO `users` (`user_nam`,`email`,`password`, `image`,`Role`,`status`)
       VALUES ('$user','$email','$password','$image','$role','$status')";
          if ($conn->query($sql) === TRUE) {
          ?>
            <script>
              swal({
                title: "Success",
                text: "User added successfully!",
                icon: "success",
              }).then(function() {
                window.location.href = "users.php?do=Manage";
              });
            </script>';
        <?php

          } else {
            die("Error" . mysqli_error($conn));
          }
        }
      }
      // }
      elseif ($do == 'Manage') {
        ?>
        <div class="container">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="h1 text-center mt-5 tc fw-bold ">
                <p class="ss">All Users</p>
              </div>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 mt-5">
              <div class="beg p-lg-5 mb-4 shadow-lg">
                <table class="table table-hover" id="data-table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">User Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Image</th>
                      <th scope="col">Role</th>
                      <th scope="col">status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT* FROM users ORDER BY users_id";
                    $result = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                      $users_id = $row["users_id"];
                      $title = $row["user_nam"];
                      $email = $row["email"];
                      $Role = $row["Role"];
                      // $password = $row["password"];
                      $image = $row["image"];
                      $status = $row["status"];
                      // $post_id = $row["id"];
                      $i++;
                    ?>
                      <tr>
                        <td>
                          <?php echo "$i" ?>
                        </td>

                        <td class="text">
                          <?php echo "$title" ?>
                        </td>
                        <td class="text">
                          <?php echo "$email" ?>
                        </td>
                        <!-- <td class="text">
                          <?php echo "$password" ?>
                        </td> -->
                        <td>
                          <img class="pro_img" src="dist/users_image/<?php echo $image ?>">
                        </td>
                        <td>
                          <?php
                          $Administrator = 1;
                          if ($Role == $Administrator) { ?>
                            <p class="ab bg-primary  p-1 rounded-3 ico">Administrator</p>

                          <?php } else {
                          ?>

                            <p class="ab bg-success p-1 rounded-3 ico">Editor</p>
                          <?php } ?>
                        </td>
                        <td>
                          <?php $stat = 1;
                          if ($status == $stat) { ?>
                            <p class="bg-success fw-bold p-1 stab">Publish</p>
                          <?php
                          } else {
                          ?>
                            <p class="bg-danger fw-bold p-1 stab">Draft</p>
                          <?php
                          }
                          ?>
                        </td>
                        <td>
                          <?php if ($Role == 1) {
                          ?>
                            <p class="bg-info fw-bold p-1 stab">Admin</p>
                          <?php

                          }else{ ?>
                          <ul class="botton">
                            <!-- data-bs-toggle="modal" data-bs-target="#staticBackdrop" -->
                            <li class="ab bg-primary p-1 rounded-3"><a class="" href="users.php?do=edit&update=<?php echo $users_id ?>"><i class="fa-sharp fa-regular fa-pen-to-square text-light"></i></a></li>
                            <li class="ab bg-danger p-1 rounded-3 "> <a class="text-light" href="users.php?do=Delete&delete=<?php echo $users_id; ?>"> <i class="fas fa-trash">
                                </i></a>
                            </li>
                          </ul>
                          <?php }?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- end -->
      <?php }

      if ($do == 'edit') {
      ?>

        <!-- Update modal -->
        <?php
        //  if($do=='edit'){

        if (isset($_GET['update'])) {
          $update_info = $_GET['update'];
          $sql_update = "SELECT* FROM users WHERE users_id='$update_info'";
          $edit = mysqli_query($conn, $sql_update);
          while ($row = mysqli_fetch_assoc($edit)) {
            $ill = $row['users_id'];
            $user_nam = $row['user_nam'];
            $email = $row['email'];
            // $password = $row['password'];
            $image = $row['image'];
            $role = $row["Role"];
            $status = $row['status'];
          }
        }

        ?>
        <!-- Modal -->

        <!-- <div class="modal fade  " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="header text-center">
        </div> -->
        <div class="  modal-body rounded-3">
          <div class="container">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8 mt-4">

                <form action="" method="POST" enctype="multipart/form-data">
                  <div class=" p-sm-2 mb-2 shadow-lg rounded-3 beg p-lg-5">
                    <p class="h2 mt-0 TT"> UPDATE STUDENT DATA</p>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Users Name :</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="user_name" value="<?php echo $user_nam ?>" placeholder="Users Name">
                      </div>
                    </div>

                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Email:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="user_mail" value="<?php echo $email ?>" placeholder="Email">
                      </div>
                    </div>

                    <!-- <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Password :</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="user_pass" value="<?php echo $password ?>"
                          placeholder="password">
                      </div>
                    </div> -->
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT">Role :</label>
                      <div class="col-sm-9">
                        <select class="form-select" name="up_role" id="Department" aria-label="Default select example">
                          <option value=""><?php echo  $role  ?></option>
                          <option value="1">Administrator</option>
                          <option value="2">Editor</option>
                        </select>
                      </div>
                    </div>

                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT">Status:</label>
                      <div class="col-sm-9">
                        <select class="form-select" name="status_num">
                          <option selected=""><?php echo  $status  ?></option>
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>
                        </select>
                      </div>
                    </div>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label ">Updete image</label>
                      <div class="col-sm-9">
                        <?php
                        if (!empty($image)) {
                        ?>
                          <img class="pro_img" src="dist/users_image/<?php echo $image ?>" alt="" srcset="">
                        <?php
                        } else {
                          echo "No Image Uploded";
                        }
                        ?>
                        <input type="file" class="form-control" name="image" value="<?php echo $image ?>" placeholder="Users Name">
                      </div>
                    </div>

                    <div class="">
                      <button class=" button fw-bold " id="upd" name="Updated" type="submit">UPDATE
                      </button>
                      <!-- <button type="submit " class="button f fw-bolder m-ba text-danger" data-bs-dismiss="modal" aria-label="Close">Cencel</button> -->
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
          <!-- </div> -->

          <!-- modal -->
        <?php
        if (isset($_POST['Updated'])) {
          $user_name = $_POST['user_name'];
          $user_mail = $_POST['user_mail'];
          // $user_pass = $_POST['user_pass'];
          $status_num = $_POST['status_num'];
          $role = $_POST["up_role"];

          $imagename = $_FILES['image']['name'];
          $imageSize = $_FILES['image']['size'];
          $imageTmp = $_FILES['image']['tmp_name'];
          $exploded = explode('.', $_FILES['image']['name']);
          $lastElement = end($exploded);
          $imageExtention = strtolower($lastElement);
          $imageAllowExtantion = array('jpg', 'jpeg', 'png');
          $fromerror = array();

          if (!empty($imagename)) {
            if (!empty($imagename) && !in_array($imageExtention, $imageAllowExtantion)) {
              $fromerror = "Invlid Image";
            }
            if (!empty($imageSize) && $imageSize > 2097152) {
              $fromerror = "Invlid Image size. Allow size 2 MB";
            }
          }
          if (!empty($fromerror)) {
            header("Location:users.php?do=Addfrom");
            exit();
          }
          if (empty($fromerror)) {
            $deleteImageSQL = "SELECT * FROM users WHERE users_id='$update_info'";
            $data = mysqli_query($conn, $deleteImageSQL);
            while ($row = mysqli_fetch_assoc($data)) {
              $existingImage = $row['image'];
              unlink('dist/users_image/' . $existingImage);
            }

            $image = rand(0, 999999) . '_' . $imagename;
            move_uploaded_file($imageTmp, "dist/users_image\\" . $image);
            // data update

            $update_sql = "UPDATE users SET user_nam='$user_name',email='$user_mail',image='$image',Role='$role',status='$status_num' WHERE users_id='$update_info'";

            $Update_entry = mysqli_query($conn, $update_sql);

            if ($Update_entry) {
              header("Location:users.php?do=Manage");
            } else {
              die("Mysqli Error" . mysqli_error($conn));
            }
          }
        }
      } else if ($do == 'Delete') {
        if (isset($_GET['delete'])) {
          $deleteid = $_GET['delete'];

          // Retrieve existing image name before deleting
          $getImageQuery = "SELECT image FROM users WHERE users_id='$deleteid'";
          $getImageResult = mysqli_query($conn, $getImageQuery);

          if ($getImageResult) {
            $row = mysqli_fetch_assoc($getImageResult);
            $existingImage = $row['image'];
            unlink('dist/users_image/' . $existingImage); // Delete the image file
          } else {
            die("Mysqli Error" . mysqli_error($conn));
          }

          // Delete the record from the database
          $deleteQuery = "DELETE FROM users WHERE users_id='$deleteid'";
          $deleteResult = mysqli_query($conn, $deleteQuery);

          if ($deleteResult) {

            header("location:users.php?do=Manage");
          } else {
            die("Mysqli Error" . mysqli_error($conn));
          }
        }
      }

        ?>

        </div>
    </div>
  </div>

  <?php include "inc/footer.php" ?>
