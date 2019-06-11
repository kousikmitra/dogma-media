<?php
require_once "./database/dbconnection.php";
if(isset($_POST['sign_up'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO `users`(`username`, `name`, `email`, `password`, `verified`) VALUES ('{$username}','{$name}','{$email}','{$password}',1);";

    if($conn->query($sql)){
        header('location:./login.php');
    } else {
        header('location:./signup.php');
    }
}
?>