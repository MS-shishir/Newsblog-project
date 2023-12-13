<header class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <nav class="navbar navbar-expand-1g navbar-light">
                          <a class="navbar-brand" href="index.php">Daly News</a>

                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                              <ul class="navbar-nav ml-auto">
                                  <?php
                                    $query = "SELECT cat_name AS 'navCategoryName', category_id AS 'navCategoryId' FROM category WHERE status = 1 AND is_parent = 0 ORDER BY cat_name ASC ";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        extract($row);
                                        $subCategoryQuery = "SELECT cat_name AS 'navSubCatName', category_id AS 'navSubCatId' FROM category WHERE is_parent='$navCategoryId' AND status = 1";
                                        $subCategoryResult = mysqli_query($conn, $subCategoryQuery);
                                        $countSubCategory = mysqli_num_rows($subCategoryResult); ?>
                                      <?php if ($countSubCategory == 0) { ?>
                                          <li class="nav-item">
                                              <a class="nav-link" href="category.php?cat=<?= $navCategoryId; ?>">
                                                  <?= $navCategoryName; ?></a>
                                              <?php //echo $navCategoryName 
                                                ?>

                                          </li>
                                      <?php } else { ?>
                                          <li class="nav-item dropdown">
                                              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <?= $navCategoryName; ?>
                                              </a>
                                              <div class="dropdown-menu bs-dropdown-menu" aria-labelledby="navbarDropdown">
                                                  <?php while ($row = mysqli_fetch_assoc($subCategoryResult)) {
                                                        extract($row); ?>
                                                      <a class="dropdown-item" href="category.php?cat=<?= str_replace(" ", "_", $navSubCatId); ?>">
                                                          <?= $navSubCatName; ?></a><?php } ?>
                                              </div>
                                          </li>
                                  <?php }
                                    } ?>
                              </ul>
                          </div>
                      </nav> -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">Daily News</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                            <ul class="navbar-nav ">
                                <?php
                                $query = "SELECT cat_name AS 'navCategoryName', category_id AS 'navCategoryId' FROM category WHERE status = 1 AND is_parent = 0 ORDER BY cat_name ASC ";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    extract($row);
                                    $subCategoryQuery = "SELECT cat_name AS 'navSubCatName', category_id AS 'navSubCatId' FROM category WHERE is_parent='$navCategoryId' AND status = 1";
                                    $subCategoryResult = mysqli_query($conn, $subCategoryQuery);
                                    $countSubCategory = mysqli_num_rows($subCategoryResult); ?>
                                    <?php if ($countSubCategory == 0) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="category.php?cat=<?= $navCategoryName; ?>">
                                                <?= $navCategoryName; ?></a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= $navCategoryName; ?>
                                            </a>
                                            <div class="dropdown-menu bs-dropdown-menu" aria-labelledby="navbarDropdown">
                                                <?php while ($row = mysqli_fetch_assoc($subCategoryResult)) {
                                                    extract($row); ?>
                                                    <a class="dropdown-item" href="category.php?cat=<?= str_replace(" ", "_", $navSubCatName); ?>">
                                                        <?= $navSubCatName; ?></a><?php } ?>
                                            </div>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>