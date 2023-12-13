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
                      <h2 class="page-title">
                          <?php
                            if (isset($_GET['cat'])) {
                                $navcat = $_GET['cat'];
                                $query = "SELECT * FROM category WHERE cat_name='$navcat'";
                                $showparent = mysqli_query($conn, $query);
                                
                                while ($row = mysqli_fetch_assoc($showparent)) {
                                    $category_id = $row['cat_name'];

                                    echo $category_id;
                                }
                            }

                            ?>
                      </h2>
                      <!-- Page Heading Breadcrumb Start -->
                      <nav class="page-breadcrumb-item">
                          <ol>
                              <li><a href="index.php">Home <i class="fa fa-angle-double-right"></i></a></li>
                              <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                              <!-- Active Breadcrumb -->
                              <li class="active"><?php echo "$category_id"; ?></li>
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
                        if (isset($_GET['cat'])) {
                            $navcat = $_GET['cat'];
                            $sql = "SELECT * FROM post WHERE category_type= '$navcat' ORDER BY post_id DESC";
                            $all_posts = mysqli_query($conn, $sql);
                            $countpost = mysqli_num_rows($all_posts);
                            if ($countpost != 0)
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

                        ?>

                              <div class="blog-post"> <!-- Blog Banner Image -->
                                  <div class="blog-banner">
                                      <a href="single.php?post=<?php echo $post_id ?>">
                                          <img src="admin/dist/post_image/<?php echo $image ?>">
                                          <!-- Post Category Names -->
                                          <a href="category.php?cat=<?php echo $category_id; ?>">
                                              <div class="blog-category-name">

                                                  <?php
                                                    $query = "SELECT * FROM post where post_id='$post_id'";
                                                    $showparent = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($showparent)) {
                                                        $category_id = $row['category_type'];
                                                        //   $cat_name = $row['cat_name'];
                                                    ?>
                                                      <h6><?php echo $category_id ?></h6>
                                                  <?php
                                                    }

                                                    ?>

                                              </div>
                                          </a>

                                      </a>
                                  </div>
                                  <!-- Blog Title and Description -->
                                  <div class="blog-description">
                                      <a href="single.php?post=<?php echo $post_id ?>">
                                          <h3 class="post-title"><?php echo $title ?></h3>
                                      </a>
                                      <p><?php echo substr($description, 0, 350) . "..." ?></p>
                                      <!-- Blog Info, Date and Author -->
                                      <div class="row">
                                          <div class="col-md-8">
                                              <div class="blog-info">
                                                  <ul>
                                                      <li><i class="fa fa-calendar"></i><?php echo $post_date ?></li>
                                                      <li><i class="fa fa-user"></i><?php echo $author_id ?></li>
                                                      <li><i class="fa fa-heart"></i>(50)</li>
                                                  </ul>
                                              </div>
                                          </div>

                                          <div class="col-md-4 read-more-btn">
                                              <a href="single.php?post=<?php echo $post_id ?>">
                                                  <button type="button" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></button>
                                              </a>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <?php
                                }
                            else {
                            ?>
                              <h3>Opps!!! no post found in this category...</h3>
                      <?php
                            }
                        } ?>


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