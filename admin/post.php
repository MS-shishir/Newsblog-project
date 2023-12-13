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
              <form action="post.php?do=insert" method="POST" enctype="multipart/form-data">
                <div class="beg p-lg-5 mb-4 shadow-lg">
                  <p class="h2 mt-0 TT"> Add New Post</p>
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Title name:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="title" placeholder="Title name" id="inputtext">
                    </div>
                  </div>
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Description:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="description" placeholder="Description:" id="inputtext">
                    </div>
                  </div>
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Category_id :</label>
                    <div class="col-sm-9">
                      <select class="form-select" aria-label="Default select example" name="category_type" id="">
                        <option value="">Select category name</option>
                        <?php
                        $sql = "SELECT* FROM category ";
                        $all_cat = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($all_cat)) {
                          $cat_id = $row['category_id'];
                          $category_name = $row['cat_name'];
                        ?>
                          <option value="<?php echo $category_name ?>">
                            <?php echo $category_name ?>
                          </option>
                        <?php
                        }
                        ?>
                      </select>
                      <!-- <input type="text" class="form-control" id="Mother" name="category_id" placeholder="Category_id " id="inputtext"> -->
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
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Author_id:</label>
                    <div class="col-sm-9">
                      <select class="form-select" aria-label="Default select example" name="author_name" id="">
                        <option value="">Select Users</option>
                        <?php
                        $sql = "SELECT* FROM users ";
                        $all_user = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($all_user)) {
                          // $users_id = $row['users_id'];
                          $user_nam = $row['user_nam'];
                        ?>
                          <option value="<?php echo $user_nam ?>">
                            <?php echo $user_nam ?>
                          </option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="mt-4 row">
                    <label for="inputtext" class="col-sm-3 col-form-label TT">Tag:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="btebroll" name="tag" placeholder="Tag" id="inputtext">
                    </div>
                  </div>
                  <!-- <div class="mt-4 row">
                <label for="inputtext" class="col-sm-3 col-form-label TT">Post_date:</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="btebroll" name="post_date" placeholder="Post_date"
                    id="inputtext">
                </div>
              </div> -->

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
        <?php
         }
        elseif ($do == "insert") {
        $imagename = '';
        $imageTmp = '';
        $title = '';
        $description = '';
        $category_type = '';
        $status = '';
        $user_nam = '';
        $tag = '';
        $post_date = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // isset($_POST['submit']
          $title = $_POST["title"];
          $description = $_POST["description"];
          $category_type = $_POST["category_type"];
          $status = $_POST["status"];
          $user_nam = $_POST["author_name"];
          $tag = $_POST["tag"];
          // $post_date = $_POST["post_date"];

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
          <a href="post.php?do=Addfrom">Try agine</a>
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
          header("Location:post.php?do=Addfrom");
          exit();
        }
        if (empty($fromerror)) {
          $image = rand(0, 999999) . '_' . $imagename;
          move_uploaded_file($imageTmp, "dist/post_image\\" . $image);


          $sql = "INSERT INTO `post` (`title`, `description`, `image`,`category_type`,`status`,`author_name`,`tag`,`post_date`) VALUES ('$title','$description','$image','$category_type','
       $status','$user_nam','$tag',now())";
          if ($conn->query($sql) === TRUE) {
            header("Location:post.php?do=Manage");
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
                <p class="ss">All Post</p>
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
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Image</th>
                      <th scope="col">Category_id</th>
                      <th scope="col">status</th>
                      <th scope="col">author_id</th>
                      <th scope="col">tag</th>
                      <th scope="col">post_date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT* FROM post ORDER BY post_id";
                    $result = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                      $post_id = $row["post_id"];
                      $title = $row["title"];
                      $description = $row["description"];
                      $image = $row["image"];
                      $category_id = $row["category_type"];
                      $status = $row["status"];
                      $author_id = $row["author_name"];
                      $tag = $row["tag"];
                      $post_date = $row["post_date"];
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
                        <td>
                          <?php echo substr($description, 0, 200) . "..." ?>
                        </td>
                        <td>
                          <img class="pro_img" src="dist/post_image/<?php echo $image ?>">
                        </td>
                        <td>
                          <?php echo "$category_id" ?>
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
                          <?php echo "$author_id" ?>
                        </td>
                        <td>
                          <?php echo "$tag" ?>
                        </td>
                        <td>
                          <?php echo "$post_date" ?>
                        </td>
                        <td>
                          <ul class="botton">
                            <!-- data-bs-toggle="modal" data-bs-target="#staticBackdrop" -->
                            <li class="ab bg-primary p-1 rounded-3"><a class="" href="post.php?do=edit&update=<?php echo $post_id ?>"><i class="fa-sharp fa-regular fa-pen-to-square text-light"></i></a></li>
                            <li class="ab bg-danger p-1 rounded-3 "> <a class="text-light" href="post.php?do=Delete&delete=<?php echo $post_id; ?>"> <i class="fas fa-trash"> </i></a></li>
                          </ul>
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
          $sql_update = "SELECT* FROM post WHERE post_id='$update_info'";
          $edit = mysqli_query($conn, $sql_update);
          while ($row = mysqli_fetch_assoc($edit)) {
            $ill = $row['post_id'];
            $title = $row['title'];
            $description = $row['description'];
            $image = $row['image'];
            $category_id = $row['category_type'];
            $status = $row['status'];
            $author_id = $row['author_name'];
            $tag = $row['tag'];
            // $post_date = $row['post_date'];
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
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Title Name :</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="title_name" value="<?php echo $title ?>" placeholder="Title Name">
                      </div>
                    </div>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Description:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="description_name" value="<?php echo $description ?>" placeholder="Description">
                      </div>
                    </div>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Category_id:</label>
                      <div class="col-sm-9">
                        <select class="form-select" aria-label="Default select example" name="category_id_num" id="">
                          <option value="<?php echo $category_id ?>">Select category name</option>
                          <?php
                          $sql = "SELECT* FROM category ";
                          $all_cat = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($all_cat)) {
                            $cat_id = $row['category_id'];
                            $category_name = $row['cat_name'];
                          ?>
                            <option value="<?php echo $category_name ?>">
                              <?php echo $category_name ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT">Status:</label>
                      <div class="col-sm-9">
                        <select class="form-select" name="status_num">
                          <option value="<?php echo $status ?>">---Please Select Status---</option>
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>
                        </select>
                      </div>
                    </div>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT">Author_id:</label>
                      <div class="col-sm-9">
                        <select class="form-select" aria-label="Default select example" name="Author_id_num" id="">
                          <option value="<?php echo $author_id ?>">Select Users</option>
                          <?php
                          $sql = "SELECT* FROM users";
                          $all_user = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($all_user)) {
                            $users_id = $row['users_id'];
                            $user_nam = $row['user_nam'];
                          ?>
                            <option value="<?php echo $user_nam ?>">
                              <?php echo $user_nam ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT">Tag:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="tag_name" value="<?php echo $tag ?>">
                      </div>
                    </div>
                    <!-- <div class="mt-4 row">
                  <label for="inputtext" class="col-sm-3 col-form-label TT">Post_date :</label>
                  <div class="col-sm-9 mb-4">
                    <input type="text" class="form-control" name="post_date" value="<?php //echo $post_date
                                                                                    ?>">
                  </div>
                </div> -->
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label">Updete image</label>
                      <div class="col-sm-9">
                        <?php
                        if (!empty($image)) {
                        ?>
                          <img class="pro_img" src="dist/post_image/<?php echo $image ?>" alt="" srcset="">
                        <?php
                        } else {
                          echo "No Image Uploded";
                        }
                        ?>
                        <input type="file" class="form-control" value="<?php echo $image ?>" name="image" id="inputtext">
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
          $title_name = $_POST['title_name'];
          $description_name = $_POST['description_name'];
          $category_id_num = $_POST['category_id_num'];
          $status_num = $_POST['status_num'];
          $Author_id_num = $_POST['Author_id_num'];
          $tag_name = $_POST['tag_name'];
          // $post_date = $_POST['post_date'];

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
            header("Location:post.php?do=Addfrom");
            exit();
          }
          if (empty($fromerror)) {
            $deleteImageSQL = "SELECT * FROM post WHERE post_id='$update_info'";
            $data = mysqli_query($conn, $deleteImageSQL);
            while ($row = mysqli_fetch_assoc($data)) {
              $existingImage = $row['image'];
              unlink('dist/post_image/' . $existingImage);
            }

            $image = rand(0, 999999) . '_' . $imagename;
            move_uploaded_file($imageTmp, "dist/post_image\\" . $image);
            // data update

            $update_sql = "UPDATE post SET title='$title_name',description='$description_name',
      image='$image',category_type='$category_id_num',status='$status_num',author_name='$Author_id_num',tag='$tag_name',post_date=now() WHERE post_id='$update_info'";

            $Update_entry = mysqli_query($conn, $update_sql);

            if ($Update_entry) {
              header("Location:post.php?do=Manage");
            } else {
              die("Mysqli Error" . mysqli_error($conn));
            }
          }
        }
      } else if ($do == 'Delete') {
        if (isset($_GET['delete'])) {
          $deleteid = $_GET['delete'];

          // Retrieve existing image name before deleting
          $getImageQuery = "SELECT image FROM post WHERE post_id='$deleteid'";
          $getImageResult = mysqli_query($conn, $getImageQuery);

          if ($getImageResult) {
            $row = mysqli_fetch_assoc($getImageResult);
            $existingImage = $row['image'];
            unlink('dist/post_image/' . $existingImage); // Delete the image file
          } else {
            die("Mysqli Error" . mysqli_error($conn));
          }

          // Delete the record from the database
          $deleteQuery = "DELETE FROM post WHERE post_id='$deleteid'";
          $deleteResult = mysqli_query($conn, $deleteQuery);

          if ($deleteResult) {
            header("location:post.php?do=Manage");
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
