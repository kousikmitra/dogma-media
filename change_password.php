<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Your Password</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .input-group-prepend {
            width: 40%;
            /*adjust as needed*/
        }

        .input-group-text {
            width: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-main">
        <?php include "./includes/header.php"; ?>
        <div class="main" style="margin-top:15vh;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 offset-4 col-centered">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="display4">Change Your Password</h3>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputCurrentPassword">Current Password</span>
                                        </div>
                                        <input type="text" name="current_password" id="current-password" class="form-control" placeholder="" aria-describedby="inputCurrentPassword">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputNewPassword">New Password</span>
                                        </div>
                                        <input type="text" name="new_password" id="new-password" class="form-control" placeholder="" aria-describedby="inputNewPassword">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputConfirmPassword">Confirm New Pssword</span>
                                        </div>
                                        <input type="text" name="confirm_password" id="confirm-password" class="form-control" placeholder="" aria-describedby="inputConfirmPassword">
                                    </div>

                                    <div class="input-group-lg">
                                        <input type="submit" class="btn btn-primary w-100 mt-3" name="change_password" value="Change Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>