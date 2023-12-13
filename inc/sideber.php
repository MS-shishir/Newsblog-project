<div class="col-md-4">

    <!-- Latest News -->
    <div class="widget">
        <h4>Latest News</h4>
        <div class="title-border"></div>

        <!-- Sidebar Latest News Slider Start -->
        <div class="sidebar-latest-news owl-carousel owl-theme">
            <?php
            $sql = "SELECT * FROM post ORDER BY post_id DESC";
            $all_posts = mysqli_query($conn, $sql);
            $i = 0;
            while ($row = mysqli_fetch_assoc($all_posts)) {

                $title = $row['title'];
                $description = $row['description'];
                $image = $row['image'];
                $i++;
            ?>
                <!-- First Latest News Start -->
                <div class="item">
                    <div class="latest-news">
                        <!-- Latest News Slider Image -->
                        <div class="latest-news-image">
                            <a href="#">
                                <img src="admin/dist/post_image/<?php echo $image ?>">
                            </a>
                        </div>
                        <!-- Latest News Slider Heading -->
                        <h5> <?php echo substr($title, 0, 100) . "..." ?></h5>
                        <!-- Latest News Slider Paragraph -->
                        <p><?php echo substr($description, 0, 250) . "..." ?></p>
                    </div>
                </div>
                <!-- First Latest News End -->
            <?php } ?>

        </div>
        <!-- Sidebar Latest News Slider End -->
    </div>


    <!-- Search Bar Start -->
    <div class="widget">
        <!-- Search Bar -->
        <h4>Blog Search</h4>
        <div class="title-border"></div>
        <div class="search-bar">
            <!-- Search Form Start -->
            <form action="search.php" method="POST">
                <div class="form-group">
                    <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
                    <i class="fa fa-paper-plane-o"></i>
                    <input type="submit" name="searchbtn" class="btn-main" value="Search"></i></input>
                </div>
            </form>
            <!-- Search Form End -->
        </div>
    </div>
    <!-- Search Bar End -->

    <!-- Recent Post -->
    <div class="widget">
        <h4>Recent Posts</h4>
        <div class="title-border"></div>
        <div class="recent-post">
            <?php
            $sql = "SELECT * FROM post ORDER BY post_id DESC";
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
                <!-- Recent Post Item Content Start -->
                <div class="recent-post-item">
                    <div class="row">
                        <!-- Item Image -->
                        <div class="col-md-4">
                            <img src="admin/dist/post_image/<?php echo $image ?>">
                        </div>
                        <!-- Item Tite -->
                        <div class="col-md-8 no-padding">
                            <h5> <?php echo substr($title, 0, 100) . "..." ?></h5>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> <?php echo $post_date ?></li>
                                <li><i class="fa fa-comment-o"></i>15</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Recent Post Item Content End -->

            <?php } ?>

        </div>
    </div>

    <!-- All Category -->
    <div class="widget">
        <h4>Blog Categories</h4>
        <div class="title-border"></div>
        <!-- Blog Category Start -->

        <div class="blog-categories">
            <ul>
                <?php
                $cat_name = '';
                $sqlii = "SELECT * FROM category WHERE is_parent='0'";
                $all_post = mysqli_query($conn, $sqlii);
                while ($row = mysqli_fetch_assoc($all_post)) {

                    $cate_name = $row['cat_name'];
                ?>

                    <!-- Category Item -->
                    <a href="category.php?cat=<?php echo $cate_name; ?>">
                        <li>
                            <i class="fa fa-check"></i>
                            <?php echo  $cate_name;
                            ?>
                            <span>[<?php
                             $ssql = "SELECT * FROM post WHERE category_type= '$cate_name' ORDER BY post_id DESC";
                             $all = mysqli_query($conn, $ssql);
                             $countpost = mysqli_num_rows($all);
                            echo $countpost ?>]</span>
                        </li>
                    </a>

                    <!-- Category Item -->
                <?php
                } ?>
            </ul>
        </div>

        <!-- Blog Category End -->
    </div>

    <!-- Recent Comments -->
    <div class="widget">
        <h4>Recent Comments</h4>
        <div class="title-border"></div>
        <div class="recent-comments">
            <?php
            $sql = "SELECT * FROM comment ORDER BY comment_id DESC";
            $all_posts = mysqli_query($conn, $sql);
            $i = 0;
            while ($row = mysqli_fetch_assoc($all_posts)) {
                $cuser_name = $row['cuser_name'];
                $status = $row['status'];
                $cdate = $row['cdate'];

                $i++;
            ?>

                <!-- Single Comment Post Start -->
                <?php if ($status == 1) { ?>
                    <!-- Recent Comments Item Start -->
                    <div class="recent-comments-item">
                        <div class="row">
                            <!-- Comments Thumbnails -->
                            <div class="col-md-4">
                                <i class="fa fa-comments-o"></i>
                            </div>
                            <!-- Comments Content -->
                            <div class="col-md-8 no-padding">
                                <h5><?php echo  $cuser_name ?></h5>
                                <!-- Comments Date -->
                                <ul>
                                    <li>
                                        <i class="fa fa-clock-o"></i><?php echo  $cdate ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Comments Item End -->

            <?php }
            } ?>

        </div>
    </div>

    <!-- Meta Tag -->
    <div class="widget">
        <h4>Tags</h4>
        <div class="title-border"></div>
        <div class="meta-tags">
            <?php
            $sql = "SELECT * FROM post ORDER BY post_id DESC";
            $all_posts = mysqli_query($conn, $sql);
            
            while ($row = mysqli_fetch_assoc($all_posts)) {
             
                $meta = $row['tag'];
                $meta_tag=explode(' ',$meta);
                foreach($meta_tag AS $tag){
            ?>
                <a href="search.php?seartag=<?php echo $tag ?>">
                    <span><?php echo $tag ?></span>
                </a>

            <?php 
             }
        } ?>
        </div>
        <!-- Meta Tag List End -->
    </div>

</div>