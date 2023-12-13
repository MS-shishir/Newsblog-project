
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link td">
    <img src="dist/img/world.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light ">NewsBlog</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/users_image/<?php echo $_SESSION['image'] ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block td"><?php echo $_SESSION['user_nam'] ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="dashboard.php" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Manage post
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right">6</span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="post.php?do=Manage" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All post</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="post.php?do=Addfrom" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Post</p>
              </a>
            </li>

          </ul>
        </li>
        <?php
        // $_SESSION['Role'] = $row["Role"];
        if($_SESSION['Role']==1){
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Manage Users
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right">6</span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="users.php?do=Manage" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="users.php?do=Addfrom" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Users</p>
              </a>
            </li>

          </ul>
        </li>
        <?php }?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Manage Category
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right">6</span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="Category.php?do=Manage" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> All Category</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="Category.php?do=Addfrom" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Add New Category</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="comment.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              All Comment
              <!-- <span class="badge badge-info right">6</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link" id="delete-button">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->

</aside>
<script src="dist/js/switealart.js"></script>
<script>
  // Function to display the SweetAlert dialog
  function confirmDelete() {
    swal({
      title: "Are you sure?",
      text: "Logout this site !!!",
      icon: "warning",
      buttons: true,
      dangerMode:true,
    }).then((willDelete) => {
      if (willDelete) {
        swal({
          title: "Logout Success",
          text: "You go to Login page",
          icon: "success",
          button: "OK",


        }).then(function() {
          window.location.href = "logout.php";
        });
      } else {
        swal("Logout Diend");
      }
    });
  }
  // Add an event listener to the button to trigger the confirmation dialog
  document.getElementById("delete-button").addEventListener("click", confirmDelete);
</script>
