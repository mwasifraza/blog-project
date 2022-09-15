<?php include "config.php"; ?>
<?php
    session_start();
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == '0'){
            header("Location: {$hostname}/admin/post.php");
        }else{
            if(isset($_GET['id']) && $_GET['id'] != "" && $_GET['id'] != $_SESSION['userid']){
                $id = $_GET['id'];
                $sql = "DELETE FROM user WHERE user_id = $id";
                $result = mysqli_query($conn, $sql) or die("Invalid!");
                if($result){
                    $msg = "user deleted";
                    header("Location: {$hostname}/admin/users.php?msg=".$msg);
                }
            }else{ header("Location: {$hostname}/admin/users.php"); }
        }
    }else{ header("Location: {$hostname}/index.php?msg=invalid url"); }
?>

