<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
if (($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['comment_submit'])) {
    require_once "./database/dbconnection.php";
    $comment_user = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment_data = $_POST['comment_text'];

    $sql = "INSERT INTO `comments`(`posts_id`, `users_id`, `comment`, `comment_date`, `comment_time`) VALUES ({$post_id},{$comment_user},'{$comment_data}',CURDATE(),CURTIME());";

    if($conn->query($sql)){
        $comment_id = $conn->insert_id;
        if($conn->query("UPDATE `posts` SET `total_comments`= total_comments+1 WHERE id = {$post_id};")){
            header('location:./post.php?post_id='.$post_id);
        } else {
            $conn->query("DELETE FROM `comments` WHERE id = {$comment_id};");
            header('location:./info.php');
        }
    } else {
        header('location:./info.php');
    }

}
?>