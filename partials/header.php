<?php include 'admin/partials/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="offset-md-4 col-md-4">
                <a href="index.php" id="logo">
                    <img src="images/news.jpg">
                </a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <div>
                        <li><a href='index.php'>Home</a></li>
                    <?php
                        if(isset($_GET['cat'])){
                            $cat_id = $_GET['cat'];
                        }
                        $link_sql = "SELECT * FROM category WHERE post > 0 ORDER BY category_id";
                        $link_result = mysqli_query($conn, $link_sql) or die("Counldn't fetch data!");
                        if(mysqli_num_rows($link_result) > 0){
                            while($links = mysqli_fetch_assoc($link_result)){
                                if(isset($_GET['cat'])){
                                    $active = ($links['category_id'] == $cat_id) ? "active":"" ;
                                }
                    ?>
                        <li><a class="<?php echo $active; ?>" href="category.php?cat=<?php echo $links['category_id']; ?>">
                            <?php echo $links['category_name']; ?>
                        </a></li>
                    <?php
                            }
                        }
                    ?>                        
                    </div>
                    <div>
                        <li><a href='admin/index.php'>Login</a></li>
                        <!-- <li><a href='register-user.php'>Register</a></li> -->
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
