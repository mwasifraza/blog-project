<?php include "partials/config.php"; ?>
<?php 
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: {$hostname}/admin/post.php");
    }
?>
<?php
    $msg = "";
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT user_id, username, role FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql) or die("Query fails.");
        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['userid'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: {$hostname}/admin/post.php?msg=login successfull");
        }else{
            $msg = "Username or password incorrect";
        }
    }
?>


<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
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
                            <h3 class="heading">Login acccount.</h3><hr>
                            <!-- Form Start -->
                            <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                                <div class="form-floating">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    <label>Username</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>                                    
                                    <label>Password</label>
                                    <div class="text-danger text-end"><?php echo $msg; ?></div>
                                </div>
                                <div class="d-grid gap-2">
                                    <input type="submit" name="login" class="btn btn-primary" value="Login" />
                                </div>
                            </form>
                            <!-- /Form  End -->
                            <div class="text-center mt-3">
                                <span>Don't have an account? <a href="signup.php">Sign up</a> here</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>
