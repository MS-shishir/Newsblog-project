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
          <form action="category.php?do=insert" method="POST" enctype="multipart/form-data">
            <div class="beg p-lg-4 mb-4 shadow-lg">
              <p class="h2 mt-0 TT"> Add New Category</p>
              <div class="mt-4 row">
                <label for="inputtext" class="col-sm-3 col-form-label TT">Category name:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="cat_name" placeholder="Title name" id="inputtext">
                </div>
              </div>

              <div class="mt-4 row">
                <label for="inputtext" class="col-sm-3 col-form-label TT">Category Type :</label>
                <div class="col-sm-9">
                  <select class="form-select" aria-label="Default select example" name="is_parent"">
                    <option value="">Select category Type</option>
                    <?php
                    $query = "SELECT* FROM category where is_parent = '0' ";
                    $showparent = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($showparent)) {
                      $cat_id = $row['category_id'];
                      $cat_name = $row['cat_name'];
                      ?>
                    <option value=" <?php echo $cat_id ?>">
                      <?php echo $cat_name ?>
                    <?php } ?>
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
  <?php }
  elseif ($do == "insert") {

    $title = '';
    $status = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // isset($_POST['submit']
      $title = $_POST["cat_name"];
      $is_parent = $_POST["is_parent"];
      $status = $_POST["status"];
      ?>

      <?php
    }


    $sql = "INSERT INTO `category` (`cat_name`,`is_parent`,`status`)
       VALUES ('$title','$is_parent','$status')";
    if ($conn->query($sql) === TRUE) {
      header("Location:category.php?do=Manage");
    } else {
      die("Error" . mysqli_error($conn));
    }
  }
  elseif ($do == 'Manage') {
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="h1 text-center mt-5 tc fw-bold ">
            <p class="ss">All Category</p>
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
                  <th scope="col">Category Name</th>
                  <th scope="col">Category Type</th>
                  <th scope="col">status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $title = '';
                $cat_name = '';

                $sql = "SELECT* FROM category ORDER BY category_id";
                $result = mysqli_query($conn, $sql);
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                  $category_id = $row["category_id"];
                  $title = $row["cat_name"];
                  $is_parent = $row["is_parent"];
                  $status = $row["status"];
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
                      <?php
                      if ($is_parent == 0) { ?>
                        <div class="badge badge-primary">Primary Category</div>
                      <?php } else {
                        $query = "SELECT * FROM category where category_id='$is_parent'";
                        $showparent = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($showparent)) {
                          $cat_id = $row['category_id'];
                          $cat_name = $row['cat_name'];
                        }

                        ?>

                        <div class="badge badge-success">
                          <?php echo $cat_name ?>
                        </div>
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
                      <ul class="botton">
                        <!-- data-bs-toggle="modal" data-bs-target="#staticBackdrop" -->
                        <li class="ab bg-primary p-1 rounded-3"><a class=""
                            href="category.php?do=edit&update=<?php echo $category_id ?>"><i
                              class="fa-sharp fa-regular fa-pen-to-square text-light"></i></a></li>
                        <li class="ab bg-danger p-1 rounded-3 "> <a class="text-light"
                            href="category.php?do=Delete&delete=<?php echo $category_id; ?>"> <i class="fas fa-trash">
                            </i></a></li>
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
      $sql_update = "SELECT* FROM category WHERE category_id='$update_info'";
      $edit = mysqli_query($conn, $sql_update);
      while ($row = mysqli_fetch_assoc($edit)) {
        $ill = $row['category_id'];
        $title = $row['cat_name'];
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
              <div class=" p-sm-2 mb-2 shadow-lg rounded-3 beg p-lg-4">
                <p class="h2 mt-0 TT"> UPDATE STUDENT DATA</p>
                <div class="mt-4 row">
                  <label for="inputtext" class="col-sm-3 col-form-label TT ">Category Name :</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="cat_nam" value="<?php echo $title ?>"
                      placeholder="Title Name">
                  </div>
                </div>

                <div class="mt-4 row">
                  <label for="inputtext" class="col-sm-3 col-form-label TT">Category Type :</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="is_parents">
                      <option value="">Select category Type</option>
                      <?php
                      $query = "SELECT* FROM category where is_parent = '0' ";
                      $showparent = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($showparent)) {
                        $cat_id = $row['category_id'];
                        $cat_name = $row['cat_name'];
                        ?>
                        <option value=" <?php echo $cat_id ?>">
                          <?php echo $cat_name ?>
                        <?php } ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="Mother" name="category_id" placeholder="Category_id " id="inputtext"> -->
                  </div>
                </div>

                <div class="mt-4 row">
                  <label for="inputtext" class="col-sm-3 col-form-label TT">Status:</label>
                  <div class="col-sm-9">
                    <select class="form-select" name="status_num">
                      <option selected="">---Please Select Status---</option>
                      <option value="1">Publish</option>
                      <option value="0">Draft</option>
                    </select>
                    <!-- <input type="number" class="form-control" id="Regino" name="status" placeholder="status:" id="inputtext"> -->
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
        $title_name = $_POST['cat_nam'];
        $is_parents = $_POST['is_parents'];
        $status_num = $_POST['status_num'];





        $update_sql = "UPDATE category SET cat_name='$title_name', is_parent='$is_parents', status='$status_num' WHERE category_id='$update_info'";

        $Update_entry = mysqli_query($conn, $update_sql);

        if ($Update_entry) {
          header("Location:category.php?do=Manage");
        } else {
          die("Mysqli Error" . mysqli_error($conn));
        }
      }
  }
  else if ($do == 'Delete') {
    if (isset($_GET['delete'])) {
      $deleteid = $_GET['delete'];

      // Delete the record from the database
      $deleteQuery = "DELETE FROM category WHERE category_id='$deleteid'";
      $deleteResult = mysqli_query($conn, $deleteQuery);

      if ($deleteResult) {
        header("location:category.php?do=Manage");
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
