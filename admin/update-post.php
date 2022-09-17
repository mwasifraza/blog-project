<?php include "partials/header.php"; ?>
<?php
    if(isset($_POST['update'])){
        if(empty($_FILES['new-image']['name'])){
            $file_name = mysqli_real_escape_string($conn, $_POST['old-image']);
        }else{
            $errors = array();
            $extensions = ["jpeg","jpg","png"];

            $file_name = $_FILES['new-image']['name'];
            $file_size = $_FILES['new-image']['size'];
            $file_tmp = $_FILES['new-image']['tmp_name'];
            $file_type = $_FILES['new-image']['type'];
            $get_name = explode('.', $file_name);
            $file_ext = end($get_name);

            if(in_array($file_ext, $extensions) === false){
                $errors[] = "Only images are allowed!";
            }
            if($file_size > 2097152){
                $errors[] = "File size must be 2MB or lower!";
            }
            if(empty($errors) == true){
                $img_name = $get_name[0].'_'.date("jmYHisu").'.'.$file_ext;
                move_uploaded_file($file_tmp, "upload/".$img_name);
            }else{
                print_r($errors);
                die();
            }
        }
        $pid = mysqli_real_escape_string($conn, $_POST['post_id']);
        $title = mysqli_real_escape_string($conn, trim($_POST['post-title']));
        $postdesc = mysqli_real_escape_string($conn, trim($_POST['postdesc']));
        $postcat = mysqli_real_escape_string($conn, $_POST['postcat']);

        $upd_sql = "UPDATE post SET title='$title', description='$postdesc', category=$postcat, post_img='$img_name' 
                    WHERE post_id=$pid";
        $run_sql = mysqli_query($conn, $upd_sql) or die("Query fails: Update");
        if($run_sql){
            header("Location: {$hostname}/admin/post.php?msg=post updated");
        }
    }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <!-- <h1 class="admin-heading">Update Post</h1> -->
    </div>
    <div class="mx-auto col-md-5 bg-white mt-3 p-4">
        <h3 class="heading">Update post details.</h3><hr>
        <?php
            if(isset($_GET['pid']) && $_GET['pid'] != ""){
                $user_check_test = false;
                $postid = $_GET['pid'];
                $sql = "SELECT p.post_id,p.title,p.description,p.category,p.post_img,p.author,c.category_name FROM post p 
                        LEFT JOIN category c ON  p.category = c.category_id
                        -- LEFT JOIN user u ON p.author = u.user_id
                        WHERE p.post_id = $postid";
                $result = mysqli_query($conn, $sql) or die("<p class='text-danger'>Invalid Value!</p>");
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    // checks users, so normal user cannot update others' post
                    if($_SESSION['role'] == 1){
                        $user_check_test = true;
                    }elseif($_SESSION['role'] == 0){
                        if($row['author'] === $_SESSION['userid']){
                            $user_check_test = true;
                        }
                    }
                    if($user_check_test){
        ?>
        <!-- Form for show edit-->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']?>">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="post-title" class="form-control" value="<?php echo $row['title']?>">
            </div>
            <div class="form-group my-3">
                <label> Description</label>
                <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description']?></textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control form-select" name="postcat">
                    <option value="<?php echo $row['category']?>"><?php echo $row['category_name']?></option>
                    <!-- below commented code is to fetch all categories from the table. -->
                    <!-- <option value="">-- Select Category --</option> -->
                    <?php
                        // $query = "SELECT * FROM category";
                        // $fire = mysqli_query($conn, $query) or die("Query fails");
                        // if(mysqli_num_rows($fire) > 0){
                        //     while($cat = mysqli_fetch_assoc($fire)){
                        //     $selected = ($row['category'] == $cat['category_id']) ? "selected":"";
                    ?>
                        <!-- <option <?php echo "value=".$cat['category_id']." ".$selected; ?>><?php echo $cat['category_name']; ?></option> -->
                    <?php
                        //     }
                        // }
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-md-7 form-middle">
                        <label>Post image</label>
                        <input type="file" class="form-control form-control-sm" name="new-image">
                    </div>
                    <div class="col-md-5 mt-3">
                        <img src="upload/<?php echo $row['post_img']?>" class="img-thumbnail" alt="">
                        <input type="hidden" name="old-image" value="<?php echo $row['post_img']?>">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" name="update" class="btn btn-primary" value="Update Post" />
            </div> 
        </form>
        <!-- Form End -->
        <?php
                    }else{ echo "<h2 class='text-muted text-center'>No post found!</h2>"; }
                }else{ echo "<h2 class='text-muted text-center'>No post found!</h2>"; }
            }else{ header("Location: {$hostname}/admin/post.php"); }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "partials/footer.php"; ?>
