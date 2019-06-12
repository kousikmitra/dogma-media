<?php
require_once "./database/dbconnection.php";
if(isset($_POST['sign_up'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO `users`(`username`, `name`, `email`, `password`, `verified`) VALUES ('{$username}','{$name}','{$email}','{$password}',1);";

    if($conn->query($sql)){
        $users_id = $conn->insert_id;
        $sql ="INSERT INTO `profiles`(`users_id`) VALUES ({$users_id});";
        if($conn->query($sql)){
            header('location:./login.php');
        } else {
            $sql = "DELETE FROM `users` WHERE id={$users_id};";
            $conn->query($sql);
            header('location:./info.php');
        }
        
    } else {
        header('location:./info.php');
    }
}
