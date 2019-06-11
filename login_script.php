<?php
require_once "./database/dbconnection.php";
if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT `id`, `username`, `name`, `email` FROM `users` WHERE (username='{$username}' OR email='{$username}') AND password='{$password}';";

    $result = $conn->query($sql);

    if($result->num_rows == 1){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        header('location:./home.php');
    } else {
        header('location:./signup.php');
    }
}
?>