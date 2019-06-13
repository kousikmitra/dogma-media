<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
$data = array();

if (($_SERVER['REQUEST_METHOD'] == 'GET') and isset($_GET['user_id']) and isset($_GET['follow_id'])) {
    require_once "./database/dbconnection.php";
    $user_id = $_GET['user_id'];
    $follow_id = $_GET['follow_id'];

    $sql = "SELECT `users_id`, `follows` FROM `followers` WHERE users_id = {$user_id} AND follows = {$follow_id};";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        $sql = "INSERT INTO `followers`(`users_id`, `follows`) VALUES ({$user_id}, {$follow_id})";
        if($conn->query($sql)){
            $conn->query("UPDATE `profiles` SET `following`= following+1 WHERE users_id = {$user_id}");
            $conn->query("UPDATE `profiles` SET `followers`= followers+1 WHERE users_id = {$follow_id}");
            $data['status'] = 'followed';
        } else {
            $data['status'] = 'failed';
        }
    } else {
        $sql = "DELETE FROM `followers` WHERE users_id = {$user_id} AND follows = {$follow_id};";
        if($conn->query($sql)){
            $conn->query("UPDATE `profiles` SET `following`= following-1 WHERE users_id = {$user_id}");
            $conn->query("UPDATE `profiles` SET `followers`= followers-1 WHERE users_id = {$follow_id}");
            $data['status'] = 'unfollowed';
        } else {
            $data['status'] = 'failed';
        }
    }

    $sql = "SELECT `followers`, `following` FROM `profiles` WHERE users_id = {$follow_id};";
    $result = $conn->query($sql)->fetch_assoc();
    $data['followers'] = $result['followers'];
    $data['following'] = $result['following'];

} else {
    $data['error']=1;
}
echo json_encode($data, JSON_FORCE_OBJECT);
?>