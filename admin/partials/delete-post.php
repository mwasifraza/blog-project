<?php include "config.php"; ?>
<?php
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];

    $query = "SELECT * FROM post WHERE post_id = $pid";
    $fire = mysqli_query($conn, $query) or die("Query fails: Select");
    $row = mysqli_fetch_assoc($fire);
    unlink("../upload/".$row['post_img']);

    $sql = "DELETE FROM post WHERE post_id = $pid;";
    $sql .= "UPDATE category SET post = post-1 WHERE category_id = $cid";
    $result = mysqli_multi_query($conn, $sql) or die("Query fails: Delete");
    if($result){
        header("Location: {$hostname}/admin/post.php?msg=post deleted");
    }
?>