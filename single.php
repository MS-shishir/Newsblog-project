  <!-- :::::::::: DB Section Start :::::::: -->
  <?php include "admin/inc/db.php" ?>
  <!-- ::::::::::: DB Section End ::::::::: -->

  <!-- :::::::::: Header Section Start :::::::: -->
  <?php include "inc/header.php" ?>
  <!-- ::::::::::: Header Section End ::::::::: -->


  <body>
      <!-- ::::::::::: Navber Start ::::::::: -->
      <?php include "inc/nav.php" ?>
      <!-- ::::::::::: Navber End ::::::::: -->

      <!-- :::::::::: Page Banner Section Start :::::::: -->
      <section class="blog-bg background-img">
          <div class="container">
              <!-- Row Start -->
              <div class="row">
                  <div class="col-md-12">
                      <h2 class="page-title">Single Blog Page</h2>
                      <!-- Page Heading Breadcrumb Start -->
                      <nav class="page-breadcrumb-item">
                          <ol>
                              <li><a href="index.php">Home <i class="fa fa-angle-double-right"></i></a></li>
                              <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                              <!-- Active Breadcrumb -->
                              <li class="active">Single Right Sidebar</li>
                          </ol>
                      </nav>
                      <!-- Page Heading Breadcrumb End -->
                  </div>

              </div>
              <!-- Row End -->
          </div>
      </section>
      <!-- ::::::::::: Page Banner Section End ::::::::: -->



      <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
      <section>
          <div class="container">
              <div class="row">
                  <!-- Blog Single Posts -->
                  <div class="col-md-8">
                      <?php
                        if (isset($_GET['post'])) {
                            $readpost = $_GET['post'];
                            $sql = "SELECT * FROM post WHERE post_id='$readpost'";
                            $all_posts = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($all_posts)) {
                                $post_id = $row['post_id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $image = $row['image'];
                                $category_id = $row['category_type'];
                                $author_id = $row['author_name'];
                                $status = $row['status'];
                                $meta = $row['tag'];
                                $post_date = $row['post_date'];
                                $i++;
                        ?>

                              <div class="blog-single">
                                  <!-- Blog Title -->
                                  <a href="#">
                                      <h3 class="post-title"><?php echo $title ?></h3>
                                  </a>

                                  <!-- Blog Categories -->
                                  <div class="single-categories">
                                      <span><?php echo  $category_id ?> </span>

                                  </div>

                                  <!-- Blog Thumbnail Image Start -->
                                  <div class="blog-banner">
                                      <a href="#">
                                          <img src="admin/dist/post_image/<?php echo $image ?>">
                                      </a>
                                  </div>
                                  <!-- Blog Thumbnail Image End -->

                                  <!-- Blog Description Start -->
                                  <p><?php echo $description ?></p>

                                  <!-- <div class="blog-description-quote">
                                      <p><i class="fa fa-quote-left"></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<i class="fa fa-quote-right"></i></p>
                                  </div>

                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est eserunt mollit anim id labor laborumlabor laborum est.
                                  </p> -->
                                  <!-- Blog Description End -->
                              </div>
                      <?php
                            }
                        } ?>

                      <!-- Single Comment Section Start -->
                      <div class="single-comments">
                          <!-- Comment Heading Start -->
                          <div class="row">
                              <div class="col-md-12">
                                  <h4>All Latest Comments (3)</h4>
                                  <div class="title-border"></div>
                                  
                              </div>
                          </div>
                          <!-- Comment Heading End -->
                          <?php
                            $sql = "SELECT * FROM comment ORDER BY comment_id DESC";
                            $all_posts = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($all_posts)) {
                                $comment_id = $row['comment_id'];
                                $cuser_name = $row['cuser_name'];
                                $cuser_mail = $row['cuser_mail'];
                                $subject = $row['subject'];
                                $coment = $row['coment'];
                                $status = $row['status'];
                                $cdate = $row['cdate'];

                                $i++;
                            ?>

                              <!-- Single Comment Post Start -->
                              <?php if ($status == 1) { ?>
                                  <div class="row each-comments">
                                      <div class="col-md-12 no-padding">
                                          <!-- Comment Box Start -->
                                          <div class="comment-box">
                                              <div class="comment-box-header">
                                                  <ul>
                                                      <li class="post-by-name"><?php
                                                                                echo  $cuser_name ?></li>
                                                      <li class="post-by-hour"><?php echo  $cdate ?></li>
                                                  </ul>
                                              </div>
                                              <p><?php echo  $coment ?></p>
                                          </div>
                                          <!-- Comment Box End -->
                                      </div>
                                  </div>
                                  <!-- Single Comment Post End -->
                          <?php }
                            }
                            ?>


                          <!-- Single Comment Post End -->
                      </div>
                      <!-- Single Comment Section End -->


                      <!-- Post New Comment Section Start -->
                      <div class="post-comments">
                          <h4>Post Your Comments</h4>
                          <div class="title-border"></div>
                         

                          <form action="" method="POST" class="contact-form">
                              <!-- Left Side Start -->
                              <div class="row">
                                  <div class="col-md-6">
                                      <!-- First Name Input Field -->
                                      <div class="form-group">
                                          <input type="text" name="user_name" placeholder="Your Name" class="form-input" autocomplete="off" required="required">
                                          <i class="fa fa-user-o"></i>
                                      </div>
                                  </div>
                                  <!-- Email Address Input Field -->
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off" required="required">
                                          <i class="fa fa-envelope-o"></i>
                                      </div>
                                  </div>
                              </div>
                              <!-- Left Side End -->

                              <!-- Right Side Start -->
                              <div class="row">
                                  <div class="col-md-12">
                                      <!-- Subject Input Field -->
                                      <div class="form-group">
                                          <input type="text" name="subject" placeholder="Subject" class="form-input" autocomplete="off" required="required">
                                          <i class="fa fa-diamond"></i>
                                      </div>
                                      <!-- Comments Textarea Field -->
                                      <div class="form-group">
                                          <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                          <i class="fa fa-pencil-square-o"></i>
                                      </div>
                                      <!-- Post Comment Button -->
                                      <button type="submit" name="submit" class="btn-main"><i class="fa fa-paper-plane-o"></i> Post Your Comments</button>
                                  </div>
                              </div>
                              <!-- Right Side End -->
                          </form>

                          <?php
                            if (isset($_POST['submit'])) {
                                // isset($_POST['submit']
                                $user_name = $_POST["user_name"];
                                $email = $_POST["email"];
                                $subject = $_POST["subject"];
                                $comments = $_POST["comments"];

                                $sql = "INSERT INTO `comment` (`cuser_name`, `cuser_mail`, `subject`,`coment`,`cdate`)
                               VALUES ('$user_name','$email','$subject','$comments',now())";
                                if ($conn->query($sql) === TRUE) {
                                    echo '<script>
                                            swal({
                                                title: "Thanks for Comment",
                                                text: "Enjoy this site!",
                                                icon: "success",
                                            }).then(function() {
                                                window.location.href = "comment.php";
                                            });
                                        </script>';
                                } else {
                                    die("Error" . mysqli_error($conn));
                                }
                            }
                            ?>
                          <!-- Form End -->
                      </div>
                      <!-- Post New Comment Section End -->
                  </div>




                  <!-- Blog Right Sidebar -->
                  <?php include "inc/sideber.php" ?>
                  <!-- Sidebar End -->
              </div>
          </div>
      </section>
      <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->




      <!-- :::::::::: Footer Buy Now Section Start :::::::: -->
      <section class="buy-now">
          <div class="container">
              <!-- But Now Row Start -->
              <div class="row">
                  <!-- Left Side Content -->
                  <div class="col-md-9">
                      <h4><span>Blue Chip</span> - Multipurpose Business Corporate Website Template</h4>
                  </div>
                  <!-- Right Side Button -->
                  <div class="col-md-3">
                      <button type="button" class="btn-main"><i class="fa fa-cart-plus"></i> Buy Now</button>
                  </div>
              </div>
              <!-- But Now Row End -->
          </div>
      </section>
      <!-- ::::::::::: Footer Buy Now Section End ::::::::: -->



      <!-- ::::::::::: Footer Section End ::::::::: -->
      <?php include "inc/footer.php" ?>