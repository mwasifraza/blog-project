<?php include "partials/header.php"; ?>
<?php
    if($_SESSION['role'] == '0'){
        header("Location: {$hostname}/admin/post.php");
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="offset-md-1 col-md-8">
                <h1 class="admin-heading">Available Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="offset-md-1 col-md-10">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                            $limit = 7;
                            if(isset($_GET['page']) && $_GET['page'] != ""){
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $offset = ($page - 1) * $limit;
                            $sql ="SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset}, {$limit}";
                            $result = mysqli_query($conn, $sql) or die("Invalid!");
                            if(mysqli_num_rows($result) > 0){ 
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                              <td class='id'><?php echo $row['category_id']?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post']; ?></td>
                              <td class='edit'><a href='update-category.php?cid=<?php echo $row['category_id'] ?>'>
                              <i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='partials/delete-category.php?cid=<?php echo $row['category_id'] ?>'>
                              <i class='fa fa-trash-o'></i></a></td>
                            </tr>
                        <?php
                                }
                            }else{
                                echo "<tr>
                                    <td colspan='5'><h1 class='text-muted'>There is no data to show!</h1></td>
                                </tr>";
                            }
                        ?>   
                      </tbody>
                </table>

                <div class="pagination-box">
                    <nav aria-label="Page navigation example">
                        <ul class='pagination'>
                        <?php
                            $sql1 = "SELECT * FROM category";
                            $result1 = mysqli_query($conn, $sql1) or die("Query fails!");
                            if(mysqli_num_rows($result1) > 0){
                                if($page > 1){
                                    echo '<li class="page-item"><a class="page-link" href="category.php?page='.($page-1).'">
                                    <i class="fa fa-chevron-left"></i></a></li>';
                                }
                                $total_records = mysqli_num_rows($result1);
                                $total_pages = ceil($total_records/$limit);
                                for( $i=1; $i<=$total_pages; $i++ ){
                                $active = ($i == $page) ? "active":"";
                        ?>  
                                <li class="page-item <?php echo $active; ?>">
                                    <a class="page-link" href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                        <?php
                                }
                                if($total_pages > $page){
                                    echo '<li class="page-item"><a class="page-link" href="category.php?page='.($page+1).'">
                                    <i class="fa fa-chevron-right"></i></a></li>';
                                }
                            }                            
                        ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "partials/footer.php"; ?>
