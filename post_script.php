<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
if (($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['post'])) {
    require_once "./database/dbconnection.php";
    $post_user_id = $_SESSION['user_id'];
    $post_title = $_POST['post_title'];
    $post_data = $_POST['post_data'];
    $images_names = array();
    $images = null;

    if (isset($_FILES['files'])) {
        $myFile = $_FILES['files'];

        extract($_POST);
        $error = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["files"]["name"][$key];
            $file_tmp = $_FILES["files"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if (in_array($ext, $extension)) {
                if (!file_exists("./photo_gallery/" . $file_name)) {
                    if(move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], "./photo_gallery/" . $file_name)){
                        array_push($images_names, "./photo_gallery/".$file_name);
                    }
                } else {
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    if(move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], "./photo_gallery/" . $newFileName)){
                        array_push($images_names, "./photo_gallery/".$newFileName);
                    }
                }
            } else {
                array_push($error, "$file_name, ");
            }
        }
        $images = implode(';', $images_names);
    }

    $sql = "INSERT INTO `posts`(`users_id`, `post_title`, `post_data`, `post_date`, `post_time`) VALUES ({$post_user_id}, '{$post_title}', '{$post_data}', CURDATE(), CURTIME());";

    if($conn->query($sql)){
        if($images != null){
            $post_id = $conn->insert_id;
            $sql = "INSERT INTO `post_images`(`posts_id`, `images`) VALUES ({$post_id}, '{$images}');";
            if($conn->query($sql)){
                header('location:./post.php?post_id='.$post_id);
            } else {
                $sql = "DELETE FROM `posts` WHERE id={$post_id};";
                $conn->query($sql);
            }
        } else {
            header('location:./post.php?post_id='.$post_id);
        }
    }

}
