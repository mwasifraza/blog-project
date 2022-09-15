<?php include "config.php"; ?>
<?php
    session_start();
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == '0'){
            header("Location: {$hostname}/admin/post.php");
        }else{
            if(isset($_GET['cid']) && $_GET['cid'] != ""){
                $cid = $_GET['cid'];
                $q = "SELECT post FROM category WHERE category_id = $cid";
                $f = mysqli_query($conn, $q);
                $r = mysqli_fetch_assoc($f);
                if($r['post'] == 0){
                    $sql = "DELETE FROM category WHERE category_id = $cid";
                    $result = mysqli_query($conn, $sql) or die("Invalid!");
                    if($result){
                        $msg = "category deleted";
                        header("Location: {$hostname}/admin/category.php?msg=".$msg);
                    }
                }else{
                    header("Location: {$hostname}/admin/category.php?msg=something went wrong");
                }
            }else{ header("Location: {$hostname}/admin/category.php"); }
        }
    }else{
        header("Location: {$hostname}/index.php?msg=invalid url");
    }
?>

