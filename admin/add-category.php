<?php include "partials/header.php"; ?>
<?php include "partials/config.php"; ?>
<?php
    if($_SESSION['role'] == '0'){
        header("Location: {$hostname}/admin/post.php");
    }

    if(isset($_POST['save'])){
        $category = mysqli_real_escape_string($conn, trim($_POST['cat']));

        $sql = "INSERT INTO category(category_name) VALUES('$category')";
        $result = mysqli_query($conn, $sql) or die("Query failed!");
        if($result){
            $msg = "category added";
            header("Location: {$hostname}/admin/category.php?msg=".$msg);
        }
    }
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <!-- <h1 class="admin-heading text-center">Add New Category</h1> -->
              </div>
              <div class="mx-auto col-md-5 bg-white mt-5 p-4">
                  <h3 class="heading">Add New Category</h3><hr>
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                      <div class="form-group mb-3">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Enter a valid Category Name" required>
                      </div>
                      <div class="d-grid gap-2">
                          <input type="submit" name="save" class="btn btn-primary" value="Add Category" required />
                      </div>
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "partials/footer.php"; ?>
