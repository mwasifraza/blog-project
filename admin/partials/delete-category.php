<?php include "config.php"; ?>
<?php
    session_start();
    if($_SESSION['role'] == '0'){
        header("Location: {$hostname}/admin/post.php");
    }else{
        if(isset($_GET['cid']) && $_GET['cid'] != ""){
            $cid = $_GET['cid'];
            $sql = "DELETE FROM category WHERE category_id = $cid";
            $result = mysqli_query($conn, $sql) or die("Invalid!");
            if($result){
                $msg = "category deleted";
                header("Location: {$hostname}/admin/category.php?msg=".$msg);
            }
        }else{ header("Location: {$hostname}/admin/category.php"); }
    }    
?>

