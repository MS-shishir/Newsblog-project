<?php include "inc/hader.php" ?>

<!-- Navbar -->
<?php include "inc/nav.php" ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include "inc/menu.php" ?>

<body class="hold-transition sidebar-mini layout-fixed bg-dark ">
  <div class="wrapper">
    <div class="content-wrapper bg-dark">

      <?php
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
      if ($do == 'Manage') {
      ?>
        <div class="container">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="h1 text-center mt-5 tc fw-bold ">
                <p class="ss">All Comments</p>
              </div>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 mt-5">
              <div class="beg p-lg-5 mb-4 shadow-lg">
                <table class="table table-hover" id="data-table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">User_Name</th>
                      <th scope="col">User_Email</th>
                      <th scope="col">Subject</th>
                      <th scope="col">Comment</th>
                      <th scope="col">status</th>
                      <th scope="col">Date</th>
                      <!-- <th scope="col">tag</th> -->
                      <!-- <th scope="col">post_date</th>-->
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT* FROM comment ORDER BY comment_id";
                    $result = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                      $comment_id = $row["comment_id"];
                      $cuser_name = $row["cuser_name"];
                      $cuser_mail = $row["cuser_mail"];
                      $subject = $row["subject"];
                      $coment = $row["coment"];
                      $status = $row["status"];
                      $cdate = $row["cdate"];
                      // $tag = $row["tag"];
                      // $post_date = $row["post_date"];
                      // $post_id = $row["id"];
                      $i++;
                      if ($status == 2) {
                      } else {
                    ?>

                        <tr>
                          <td>
                            <?php echo "$i" ?>
                          </td>
                          <td class="text">
                            <?php echo "$cuser_name" ?>
                          </td>
                          <td>
                            <?php echo $cuser_mail ?>
                          </td>
                          <td>
                            <?php echo $subject ?>
                          </td>
                          <td>
                            <?php echo $coment ?>
                          </td>
                          <td>
                            <?php $stat = 1;
                            $mid = 2;
                            if ($status == $stat) { ?>
                              <p class="bg-success fw-bold p-1 stab">Publish</p>
                            <?php
                            } elseif ($status == $mid) {
                            ?>
                              <p class="fw-bold p-1 stab" style="color:#cc3300">suspend</p>
                            <?php
                            } else {
                            ?>
                              <p class="bg-danger fw-bold p-1 stab">Draft</p>
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo $cdate ?>
                          </td>
                          <td>
                            <ul class="botton">
                              <!-- data-bs-toggle="modal" data-bs-target="#staticBackdrop" -->
                              <li class="ab bg-primary p-1 rounded-3">
                                <a class="" href="comment.php?do=edit&update=<?php echo $comment_id ?>"><i class="fa-sharp fa-regular fa-pen-to-square text-light"></i></a>
                              </li>
                              <li class="ab bg-danger p-1 rounded-3 ">
                                <a class="text-light" href="comment.php?do=Delete&delete=<?php echo $comment_id; ?>"  data-bs-toggle="modal" data-bs-target="#delete<?php echo $comment_id ?>"> <i class="fas fa-trash"> </i></a>
                              </li>
                              <!-- Button trigger modal -->

                            </ul>
                          </td>
                        </tr>
                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Launch demo modal
                        </button> -->

                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $comment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-dark " id="exampleModalLabel">Alart</h5>
                                <button type="button" class="btn-close  btt"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body text-dark ">
                             Are You Sure Delete this comment
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger"><a style="text-decoration: none; color:aliceblue" href="comment.php?do=Delete&delete=<?php echo $comment_id ?>">Delete</a></button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php
                      }
                    } ?>
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
          $sql_update = "SELECT* FROM comment WHERE comment_id='$update_info'";
          $edit = mysqli_query($conn, $sql_update);
          while ($row = mysqli_fetch_assoc($edit)) {
            $ill = $row['comment_id'];
            $status = $row['status'];
            // $post_date = $row['post_date'];
          }
        }

        ?>

        <div class="  modal-body rounded-3">
          <div class="container">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8 mt-4">

                <form action="" method="POST" enctype="multipart/form-data">
                  <div class=" p-sm-2 mb-2 shadow-lg rounded-3 beg p-lg-5">
                    <p class="h2 mt-0 TT"> Update Comment</p>
                    <div class="mt-4 row">
                      <label for="inputtext" class="col-sm-3 col-form-label TT ">Status :</label>
                      <div class="col-sm-9">
                        <select class="form-select" name="status_num">
                          <option value=""><?php $stat = 1;
                                            if ($status == $stat) { ?>
                              <p class="">Publish</p>
                            <?php
                                            } else {
                            ?>
                              <p class="">Draft</p>
                            <?php
                                            }
                            ?>
                          </option>
                          <option value="0">Draft</option>
                          <option value="1">Publish</option>
                        </select>
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
          $status_num = $_POST['status_num'];


          $update_sql = "UPDATE comment SET status='$status_num' WHERE comment_id='$update_info'";

          $Update_entry = mysqli_query($conn, $update_sql);

          if ($Update_entry) {
            header("Location:comment.php?do=Manage");
          } else {
            die("Mysqli Error" . mysqli_error($conn));
          }
        }
      }
        ?>

        <?php
        if ($do == 'Delete') {
          if (isset($_GET['delete'])) {
            $deleteid = $_GET['delete'];
            // Delete the record from the database
            $deleteQuery = "UPDATE comment SET status='2' WHERE comment_id='$deleteid'";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if ($deleteResult) {
              header("location:comment.php?do=Manage");
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
