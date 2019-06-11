<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
if (($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['post'])) {
    $post_title = $_POST['post_title'];
    $post_data = $_POST['post_data'];

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
                if (!file_exists("photo_gallery/" . $file_name)) {
                    move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], "photo_gallery/" . $file_name);
                } else {
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], "photo_gallery/" . $newFileName);
                }
            } else {
                array_push($error, "$file_name, ");
            }
        }
    }
}
