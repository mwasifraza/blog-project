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
                  <h1 class="admin-heading">Registered Users</h1>
              </div>
              <div class="col-md-2">
                  <!-- <a class="add-new" href="add-user.php">add user</a> -->
              </div>
              <div class="offset-md-1 col-md-10">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
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
                            $sql = "SELECT user_id,first_name,last_name,username,role FROM user
                                    ORDER BY user_id DESC 
                                    LIMIT {$offset}, {$limit}";
                            $result = mysqli_query($conn, $sql) or die("Invalid!");
                            if(mysqli_num_rows($result) > 0){ 
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                              <td><?php echo $row['user_id']?></td>
                              <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo ( $row['role'] == 0 ) ? "User" : "Admin"; ?></td>
                              <td class='edit'>
                                <a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a>
                              </td>
                              <td class='delete'>
                                <a href='partials/delete-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash-o'></i></a>
                              </td>
                            </tr>
                        <?php
                                }
                            }else{
                                echo "<tr>
                                    <td colspan='6'><h1 class='text-muted'>There is no data to show!</h1></td>
                                </tr>";
                            }
                        ?>   
                      </tbody>
                  </table>
                  <div class="pagination-box">
                    <nav aria-label="Page navigation example">
                        <ul class='pagination'>
                        <?php                            
                            $sql1 = "SELECT * FROM user";
                            $result1 = mysqli_query($conn, $sql1) or die("Query fails!");
                            if(mysqli_num_rows($result1) > 0){
                                if($page > 1){
                                    echo '<li class="page-item"><a class="page-link" href="users.php?page='.($page-1).'"><i class="fa fa-chevron-left"></i></a></li>';
                                }
                                $total_records = mysqli_num_rows($result1);
                                $total_pages = ceil($total_records/$limit);
                                for( $i=1; $i<=$total_pages; $i++ ){
                                $active = ($i == $page) ? "active":"";
                        ?>  
                                <li class="page-item <?php echo $active; ?>">
                                    <a class="page-link" href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                        <?php
                                }
                                if($total_pages > $page){
                                    echo '<li class="page-item"><a class="page-link" href="users.php?page='.($page+1).'"><i class="fa fa-chevron-right"></i></a></li>';
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
