<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
            // $limit = 4;
            // if(isset($_GET['page']) && $_GET['page'] != ""){
            //     $page = $_GET['page'];
            // }else{
            //     $page = 1;
            // }
            // $offset = ($page - 1) * $limit;
            $side_sql = "SELECT p.post_id,p.title,p.category,c.category_name,p.post_date,p.post_img FROM post p 
                        LEFT JOIN category c ON  p.category = c.category_id
                        -- LEFT JOIN user u ON p.author = u.user_id
                        ORDER BY p.post_id DESC LIMIT 0, 4";
            $side_result = mysqli_query($conn, $side_sql) or die("Invalid!");
            if(mysqli_num_rows($side_result) > 0){ 
                while($side_row = mysqli_fetch_assoc($side_result)){
        ?>
        <div class="recent-post">
            <a class="post-img" href="">
                <img src="admin/upload/<?php echo $side_row['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?post=<?php echo $side_row['post_id']; ?>">
                    <?php echo $side_row['title']; ?>
                </a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cat=<?php echo $side_row['category']; ?>'>
                        <?php echo $side_row['category_name']; ?>
                    </a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $side_row['post_date']; ?>
                </span>
                <a class="read-more" href="single.php?post=<?php echo $side_row['post_id']; ?>">read more</a>
            </div>
        </div>
        <?php
                }
            }else{
                echo "<div class='text-center my-3'>
                    <h3 class='text-muted'>No recent post!</h3>
                </div>";
            }
        ?>
    </div>
    <!-- /recent posts box -->
</div>
