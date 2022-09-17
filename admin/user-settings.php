<?php include "partials/header.php"; ?>
<?php include "partials/config.php"; ?>
<?php
    $msg = "";
    $id = $_SESSION['userid'];
    if(isset($_POST['update'])){
        $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
        $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
        $user = mysqli_real_escape_string($conn, trim($_POST['user']));
        // $password = mysqli_real_escape_string($conn, md5(trim($_POST['password'])));
        $username_check = false;

        if($user == $_SESSION['username']){
            $username_check = true;
        }else{
            $sql = "SELECT * FROM user WHERE username = '$user'";
            $fire = mysqli_query($conn, $sql) or die("Query failed!");
            if(mysqli_num_rows($fire) == 0){
                $username_check = true;
            }
        }
        if($username_check){
            $query = "UPDATE user SET first_name = '$fname', last_name = '$lname', username = '$user' WHERE user_id = $id";
            $query_fire = mysqli_query($conn, $query);
            if($query_fire){
                $_SESSION['username'] = $user;
                header("Location: {$hostname}/admin/users.php");
            }
        }else{
            $msg = "Username is already taken";
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
                <h3 class="heading">My Settings</h3><hr>
                <?php
                    $sql = "SELECT * FROM user WHERE user_id = $id";
                    $result = mysqli_query($conn, $sql) or die("Invalid! ".mysqli_connect_error());
                    $row = mysqli_fetch_assoc($result);
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                        <div class="form-group">
                            <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'];  ?>">
                        </div>
                        <div class="form-floating">
                            <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $row['first_name'];  ?>" required>                                
                            <label>First Name</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="lname" class="form-control my-3" placeholder="Last Name" value="<?php echo $row['last_name'];  ?>" required>
                            <label>Last Name</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="user" class="form-control" placeholder="Username" value="<?php echo $row['username'];  ?>" required>
                            <label>Username</label>
                            <div class="text-danger text-end"><?php echo $msg; ?></div>
                        </div>
                        <!-- <div class="form-floating">
                            <input type="password" name="password" class="form-control my-3" placeholder="Password" required>
                            <label>Password</label>
                        </div> -->
                        <div class="d-grid gap-2">
                            <input type="submit" name="update" class="btn btn-primary my-3" value="Update" />
                        </div>
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "partials/footer.php"; ?>
