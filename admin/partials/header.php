<?php 
    include "config.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: {$hostname}/admin/");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <!-- <link rel="stylesheet" href="../css/bootstrap.min.css" /> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
        <!-- <link rel="stylesheet" href="../css/font-awesome.css"> -->
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-6">
                        <a href="post.php"><img class="" src="images/news.jpg" width="250"></a>
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <h4 class="text-white">Hello, <?php echo $_SESSION['username']; ?></h4>
                        <!-- <a href="logout.php" class="admin-logout" >Logout</a> -->
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="d-flex justify-content-between admin-menu">
                            <div>
                                <li><a href="post.php">Post</a></li>
                                <?php if($_SESSION['role'] == '1'){ ?>
                                <li><a href="category.php">Category</a></li>
                                <li><a href="users.php">Users</a></li>
                                <?php } ?>
                            </div>
                            <div>
                                <li><a href="#">Settings</a></li>
                                <li><a href="partials/logout.php">Logout</a></li>
                            </div>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->
