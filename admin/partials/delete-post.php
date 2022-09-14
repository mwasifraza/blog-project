<?php include "config.php"; ?>
<?php
    session_start();
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];
    $user_check_test = false;

    $query = "SELECT * FROM post WHERE post_id = $pid";
    $fire = mysqli_query($conn, $query) or die("Query fails: Select");
    $row = mysqli_fetch_assoc($fire);

    if($_SESSION['role'] == 1){
        $user_check_test = true;
    }elseif($_SESSION['role'] == 0){
        if($row['author'] === $_SESSION['userid']){
            $user_check_test = true;
        }
    }

    if($user_check_test){
        unlink("../upload/".$row['post_img']);

        $sql = "DELETE FROM post WHERE post_id = $pid;";
        $sql .= "UPDATE category SET post = post-1 WHERE category_id = $cid";
        $result = mysqli_multi_query($conn, $sql) or die("Query fails: Delete");
        if($result){
            header("Location: {$hostname}/admin/post.php?msg=post deleted");
        }
    }else{ 
        header("Location: {$hostname}/admin/post.php?msg=no post found");
    }
?>