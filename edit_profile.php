<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
require_once "./database/dbconnection.php";
if (!empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT users.username AS 'USERNAME', users.name AS 'NAME', users.email AS 'EMAIL', profiles.dob AS 'DOB', profiles.phone AS 'PHONE', profiles.profile_photo AS 'PROFILE_PHOTO', profiles.bio AS 'BIO', profiles.works AS 'WORKS', profiles.address AS 'ADDRESS', profiles.followers AS 'FOLLOWERS', profiles.following AS 'FOLLOWING' FROM users, profiles WHERE users.id = profiles.users_id AND users.id = {$user_id};";
    $user_result = $conn->query($sql);
    if ($user_result->num_rows != 1) {
        header('location:./info.php');
    } else {
        $user_info = $user_result->fetch_assoc();
        $username = $user_info['USERNAME'];
        $name = $user_info['NAME'];
        $email = $user_info['EMAIL'];
        $dob = $user_info['DOB'];
        $phone = $user_info['PHONE'];
        $profile_photo = $user_info['PROFILE_PHOTO'];
        $bio = $user_info['BIO'];
        $works = $user_info['WORKS'];
        $address = $user_info['ADDRESS'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile - <?php echo $username; ?></title>
    <?php require_once "./includes/links.php" ?>
</head>

<body>
    <div class="container-main">
        <?php include_once "./includes/header.php"; ?>
        <div class="main" style="margin-top:15vh;">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="col-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nemo nisi, laudantium corporis deleniti quasi labore quisquam hic voluptas blanditiis cumque excepturi? Error recusandae quidem assumenda aliquam quas dolor autem!
                    </div> -->
                    <div class="col-9 offset-2">
                        <div class="container bootstrap snippet">
                            <h1 class="text-primary"><i class="fa fa-user mr-2"></i>Edit Profile</h1>
                            <hr>
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <img src="<?php echo get_dir_url() . "profile_images/" . $profile_photo; ?>" width="100" class="img-circle rounded-circle mb-2" alt="avatar">
                                        <h6>Upload a different photo...</h6>
                                        <form role="form" action="./edit_profile_script.php" method="post" enctype="multipart/form-data">
                                            <input type="file" class="form-control">
                                    </div>
                                </div>

                                <!-- edit form column -->
                                <div class="col-md-8 personal-info">
                                    <div class="alert alert-info alert-dismissable">
                                        <a class="panel-close close pointer-event" style="cursor:pointer;" data-dismiss="alert">×</a>
                                        <i class="fa fa-coffee"></i>
                                        <strong>Hey!</strong> Here you can update your profile.
                                    </div>
                                    <h3 class="my-3 ml-5">Edit Your Details</h3>

                                    <div class="form-horizontal ml-5">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Name:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Username:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Email:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Phone:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Bio:</label>
                                            <div class="col-lg-8">
                                                <textarea style="height:10vh; max-height:10vh; min-height:10vh;" class="form-control" name="bio"><?php echo $bio; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Work:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="works" value="<?php echo $works; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Address:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-4 offset-2 mb-5">
                                                <input class="form-control" type="submit" name="address" value="Update Profile">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
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