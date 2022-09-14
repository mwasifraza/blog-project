<?php include 'partials/header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">                 
                    <?php
                        $limit = 4;
                        if(isset($_GET['page']) && $_GET['page'] != ""){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT p.post_id,p.title,p.description,p.post_views,c.category_name,p.category,p.author,p.post_date,p.post_img,u.username FROM post p 
                                LEFT JOIN category c ON  p.category = c.category_id
                                LEFT JOIN user u ON p.author = u.user_id
                                ORDER BY p.post_views DESC LIMIT {$offset}, {$limit}";
                        $result = mysqli_query($conn, $sql) or die("Invalid!");
                        if(mysqli_num_rows($result) > 0){ 
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?post=<?php echo $row['post_id']; ?>">
                                        <img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href="single.php?post=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cat=<?php echo $row['category']; ?>'>
                                                    <?php echo $row['category_name']; ?>
                                                </a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?auth=<?php echo $row['author']; ?>'>
                                                    <?php echo $row['username']; ?>
                                                </a>
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
                                        <p class="description">
                                        <?php echo substr($row['description'],0,150).'...'; ?>
                                        </p>
                                        <a class='read-more pull-right' href="single.php?post=<?php echo $row['post_id']; ?>">read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                            }
                        }else{
                            echo "<div class='text-center my-3'>
                                <h1 class='text-muted'>There is no post to show!</h1>
                                <a href='index.php'>Go Back</a>
                            </div>";
                        }
                    ?>
                        
                        
                        <div class="pagination-box">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                <?php                            
                                    $sql1 = "SELECT * FROM post";
                                    $result1 = mysqli_query($conn, $sql1) or die("Query fails!");
                                    if(mysqli_num_rows($result1) > 0){
                                        if($page > 1){
                                            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'">
                                            <i class="fa fa-chevron-left"></i></a></li>';
                                        }
                                        $total_records = mysqli_num_rows($result1);
                                        $total_pages = ceil($total_records/$limit);
                                        for( $i=1; $i<=$total_pages; $i++ ){
                                        $active = ($i == $page) ? "active":"";
                                ?>  
                                        <li class="page-item <?php echo $active; ?>">
                                            <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                <?php
                                        }
                                        if($total_pages > $page){
                                            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'">
                                            <i class="fa fa-chevron-right"></i></a></li>';
                                        }
                                    }
                                ?>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- /post-container -->
                </div>
                <?php include 'partials/sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'partials/footer.php'; ?>
