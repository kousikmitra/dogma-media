<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
$likes = array();
if (($_SERVER['REQUEST_METHOD'] == 'GET') and isset($_GET['post_id'])) {
    require_once "./database/dbconnection.php";
    $like_user = $_SESSION['user_id'];
    $post_id = $_GET['post_id'];

    $sql = "SELECT `id` FROM `likes` WHERE posts_id={$post_id} AND users_id={$like_user};";
    if ($conn->query($sql)->num_rows == 0) {
        $sql = "INSERT INTO `likes`(`posts_id`, `users_id`) VALUES ({$post_id},{$like_user});";

        if ($conn->query($sql)) {
            $like_id = $conn->insert_id;
            if ($conn->query("UPDATE `posts` SET `total_likes`= total_likes+1 WHERE id = {$post_id};")) {
                $likes['status'] = 'liked';
            } else {
                $conn->query("DELETE FROM `likes` WHERE id = {$like_id};");
                $likes['status'] = 'failed';
            }
        } else {
            $likes['status'] = 'failed';
        }
    } else {
        $sql = "UPDATE `posts` SET `total_likes`= total_likes-1 WHERE id = {$post_id};";
        if ($conn->query($sql)) {
            if ($conn->query("DELETE FROM `likes` WHERE posts_id = {$post_id} AND users_id = {$like_user};")) {
                $likes['status'] = 'unliked';
            } else {
                $conn->query("UPDATE `posts` SET `total_likes`= total_likes+1 WHERE id = {$post_id};");
                $likes['status'] = 'failed';
            }
        } else {
            $likes['status'] = 'failed';
        }
    }

    $sql = "SELECT total_likes FROM posts WHERE id = {$post_id};";
    $result = $conn->query($sql)->fetch_assoc();
    $likes['total_likes'] = $result['total_likes'];

} else {
    $likes['error']=1;
}
echo json_encode($likes, JSON_FORCE_OBJECT);
?>