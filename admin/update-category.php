<?php include "partials/header.php"; ?>
<?php include "partials/config.php"; ?>
<?php
    if($_SESSION['role'] == '0'){
        header("Location: {$hostname}/admin/post.php");
    }

    if(isset($_POST['update'])){
        $catid = mysqli_real_escape_string($conn, $_POST['catid']);
        $catname = mysqli_real_escape_string($conn, $_POST['catname']);

        $query = "UPDATE category SET category_name = '$catname' WHERE category_id = $catid";
        $fire = mysqli_query($conn, $query) or die("Update Query Failed!");
        if($fire){ 
            $msg = "category updated";
            header("Location: {$hostname}/admin/category.php?msg=".$msg); 
        }
    }
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1 class="adin-heading"> Update Category</h1> -->
            </div>
            <div class="mx-auto col-md-5 bg-white mt-5 p-4">
                <h3 class="heading">Update Category</h3><hr>
                <?php
                    if(isset($_GET['cid']) && $_GET['cid'] != ""){
                        $cid = $_GET['cid'];
                        $sql = "SELECT * FROM category WHERE category_id = $cid";
                        $result = mysqli_query($conn, $sql) or die("Invalid! ".mysqli_connect_error());
                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                ?>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                        <div class="form-group">
                            <input type="hidden" name="catid" class="form-control" value="<?php echo $row['category_id'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label>Category Name</label>
                            <input type="text" name="catname" class="form-control" value="<?php echo $row['category_name'] ?>" required>
                        </div>
                        <div class="d-grid gap-2">
                          <input type="submit" name="update" class="btn btn-primary" value="Update Category" required />
                        </div>
                    </form>
                    <!-- /Form -->
                <?php
                        }else{ echo "<h2 class='text-muted text-center'>No category found!</h2>"; }
                    }else{ header("Location: {$hostname}/admin/category.php"); }
                ?>


                  
            </div>
        </div>
    </div>
</div>
<?php include "partials/footer.php"; ?>
