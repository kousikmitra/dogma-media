<?php
session_start();
require_once "./includes/functions.php";
$data = array();
if (!auth()) {
    $data['error'] = 1;
    $data['error_text'] = 'Not Authenticated';
} else {
    if (($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['comment_text'])) {
        require_once "./database/dbconnection.php";
        $comment_user = $_SESSION['user_id'];
        $comment_id = $_POST['comment_id'];
        $comment_data = $_POST['comment_text'];

        $sql = "UPDATE `comments` SET `comment`='{$comment_data}' WHERE id = {$comment_id}";

        if ($conn->query($sql)) {
            $data['status'] = 'updated';
            $data['comment_text'] = $comment_data;
        } else {
            $data['status'] = 'failed';
            $data['reason'] = $conn->error();
        }
    } else {
        $data['error'] = 1;
        $data['error_text'] = 'Bad Request';
    }
}
echo json_encode($data, JSON_FORCE_OBJECT);
?>