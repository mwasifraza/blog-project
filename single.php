<?php include 'partials/header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                            if(isset($_GET['post']) && $_GET['post'] != ""){
                                $post_id = $_GET['post'];
                                $s1 = "UPDATE post SET post_views = post_views+1 WHERE post_id = $post_id";
                                $r1 = mysqli_query($conn, $s1);

                                $sql = "SELECT p.title,p.description,p.post_views,c.category_name,p.post_date,p.post_img,u.username FROM post p 
                                        LEFT JOIN category c ON p.category = c.category_id
                                        LEFT JOIN user u ON p.author = u.user_id
                                        WHERE p.post_id = $post_id";
                                $result = mysqli_query($conn, $sql) or die("Invalid!");
                                if(mysqli_num_rows($result) > 0){ 
                                    while($row = mysqli_fetch_assoc($result)){                            
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $row['category_name']; ?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $row['username']; ?>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                                <span>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <?php echo $row['post_views']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description']; ?>
                            </p>
                        </div>
                        <?php
                                    } // end while
                                }else{
                                    echo "<div class='text-center my-3'>
                                        <i class='text-muted fa fa-frown-o fa-3x'></i>
                                        <h1 class='text-muted'>There is no post to show!</h1>
                                    </div>";
                                }
                            }else{ header("Location: {$hostname}/index.php"); } // end if
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'partials/sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'partials/footer.php'; ?>
