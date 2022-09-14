<?php include "partials/config.php"; ?>
<?php 
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: {$hostname}/admin/post.php");
    }
?>
<?php
    $msg = "";
    if(isset($_POST['signup'])){
        $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
        $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
        $user = mysqli_real_escape_string($conn, trim($_POST['user']));
        $password = mysqli_real_escape_string($conn, md5(trim($_POST['password'])));
        // $role = mysqli_real_escape_string($conn, trim($_POST['role']));
        $role = mysqli_real_escape_string($conn, '0');

        // $username_valid = false;
        $sql = "SELECT * FROM user WHERE username = '$user'";
        $fire = mysqli_query($conn, $sql) or die("Query failed!");
        if(mysqli_num_rows($fire) == 0){
            $query = "INSERT INTO user (first_name, last_name, username, password, role) VALUES ('$fname','$lname','$user','$password','$role')";
            $query_fire = mysqli_query($conn, $query);
            if($query_fire){
                header("Location: {$hostname}/admin/index.php");
            }
        }else{
            $msg = "Username is already taken";
        }

    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Register</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <div class="bg-white px-5 py-4">
                        <h3 class="heading">Create an acccount.</h3><hr>
                        <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-floating">
                                <input type="text" name="fname" class="form-control" placeholder="First Name" required>                                
                                <label>First Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" name="lname" class="form-control my-3" placeholder="Last Name" required>
                                <label>Last Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" name="user" class="form-control" placeholder="Username" required>
                                <label>Username</label>
                                <div class="text-danger text-end"><?php echo $msg; ?></div>
                            </div>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control my-3" placeholder="Password" required>
                                <label>Password</label>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" name="signup" class="btn btn-primary" value="Sign Up" />
                            </div>
                        </form>
                        <!-- /Form  End -->
                        <div class="text-center mt-3">
                            <span>Already have an account? <a href="index.php">Login</a> here</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
