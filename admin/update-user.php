<?php include "partials/header.php"; ?>
<?php include "partials/config.php"; ?>
<?php
    if($_SESSION['role'] == '0'){
        header("Location: {$hostname}/admin/post.php");
    }

    if(isset($_POST['submit'])){
        $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        $query = "UPDATE user SET role = '$role' WHERE user_id = $userid";
        $fire = mysqli_query($conn, $query) or die("Update Query Failed!");
        if($fire){ 
            $msg = "user role updated";
            // $_SESSION['role'] = $role;
            header("Location: {$hostname}/admin/users.php?msg=".$msg); 
        }
    }
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <!-- <h1 class="admin-heading text-center">Modify User Roles</h1> -->
              </div>
              <div class="offset-md-4 col-md-4 bg-white mt-5 p-4">
                <h3 class="heading">Modify User Roles</h3><hr>
                <?php
                    if(isset($_GET['id']) && $_GET['id'] != "" && $_GET['id'] != $_SESSION['userid']){
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM user WHERE user_id = $id";
                        $result = mysqli_query($conn, $sql) or die("Invalid! ".mysqli_connect_error());
                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']?>">
                      </div>
                      <div class="form-group mb-3">
                          <label>Select User Role</label>
                          <select class="form-control form-select" name="role">
                              <option value="0" <?php echo ($row['role']==0) ? "selected":""; ?>>User</option>
                              <option value="1" <?php echo ($row['role']==1) ? "selected":""; ?>>Admin</option>
                          </select>
                      </div>
                      <div class="d-grid gap-2">
                          <input type="submit" name="submit" class="btn btn-primary" value="Update Role" required />
                      </div>
                      
                  </form>
                  <!-- /Form -->
                <?php
                        }else{ echo "<h2 class='text-muted text-center'>No user found!</h2>"; }
                    }else{ header("Location: {$hostname}/admin/users.php"); }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "partials/footer.php"; ?>
