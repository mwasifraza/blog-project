<?php include "partials/config.php"; ?>
<?php include "partials/header.php"; ?>

<?php
    if(isset($_POST['uploadpost'])){
        $title = mysqli_real_escape_string($conn, trim($_POST['post-title']));
        $postdesc = mysqli_real_escape_string($conn, trim($_POST['postdesc']));
        $postcat = mysqli_real_escape_string($conn, $_POST['postcat']);
        $postdate = date("d M, Y");
        $author = mysqli_real_escape_string($conn, $_SESSION['userid']);
        if(isset($_FILES['fileToUpload'])){
            $errors = array();
            $extensions = ["jpeg","jpg","png"];

            $file_name = $_FILES['fileToUpload']['name'];
            $file_size = $_FILES['fileToUpload']['size'];
            $file_tmp = $_FILES['fileToUpload']['tmp_name'];
            $file_type = $_FILES['fileToUpload']['type'];
            $get_ext = explode('.', $file_name);
            $file_ext = end($get_ext);

            if(in_array($file_ext, $extensions) === false){
                $errors[] = "Only images are allowed!";
            }
            if($file_size > 2097152){
                $errors[] = "File size must be 2MB or lower!";
            }
            if(empty($errors) == true){
                move_uploaded_file($file_tmp, "upload/".$file_name);
            }else{
                print_r($errors);
                die();
            }
        }
        $query = "INSERT INTO post(title,description,category,post_date,author,post_img) 
                  VALUES('{$title}','{$postdesc}',{$postcat},'{$postdate}',{$author},'{$file_name}');";
        $query .= "UPDATE category SET post = post + 1 WHERE category_id = {$postcat}";
        $fire = mysqli_multi_query($conn, $query) or die("Query fails: Insert");
        if($fire){
            header("Location: {$hostname}/admin/post.php?msg=post added");
        }
    }
?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <!-- <h1 class="admin-heading">Add New Post</h1> -->
             </div>
              <div class="mx-auto col-md-5 bg-white mt-3 p-4">
                  <h3 class="heading">Add a new post.</h3><hr>
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post-title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group my-3">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="10"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="postcat" class="form-control form-select" required>
                            <option value="">-- Select Category --</option>
                            <?php
                                $sql = "SELECT * FROM category";
                                $result = mysqli_query($conn, $sql) or die("Query fails");
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                            ?>
                              <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                            <?php
                                    }
                                }
                            ?>
                          </select>
                      </div>
                      <div class="form-group my-3">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" class="form-control" name="fileToUpload" required>
                      </div>
                      <div class="d-grid gap-2">
                          <input type="submit" name="uploadpost" class="btn btn-primary" value="Post" required />
                      </div>
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "partials/footer.php"; ?>
