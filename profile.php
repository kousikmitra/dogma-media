<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
require_once "./database/dbconnection.php";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = "SELECT users.username AS 'USERNAME', users.name AS 'NAME', profiles.profile_photo AS 'PROFILE_PHOTO', profiles.bio AS 'BIO', profiles.works AS 'WORKS', profiles.address AS 'ADDRESS', profiles.followers AS 'FOLLOWERS', profiles.following AS 'FOLLOWING' FROM users, profiles WHERE users.id = profiles.users_id AND users.id = {$user_id};";
    $user_result = $conn->query($sql);
    if ($user_result->num_rows != 1) {
        header('location:./info.php');
    } else {
        $user_info = $user_result->fetch_assoc();
        $username = $user_info['USERNAME'];
        $name = $user_info['NAME'];
        $profile_photo = $user_info['PROFILE_PHOTO'];
        $bio = $user_info['BIO'];
        $works = $user_info['WORKS'];
        $address = $user_info['ADDRESS'];
        $followers = $user_info['FOLLOWERS'];
        $following = $user_info['FOLLOWING'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>
    <?php require_once "./includes/links.php"; ?>
    <link rel="stylesheet" href="./css/my_photos.css">
    <style>
        .post-img {
            max-height: 70vh !important;
        }
    </style>
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
                    <div class="col-8 offset-2">
                        <div class="container-fluid" style="background:background: rgba(238, 236, 236, 0.705);">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-3 text-center">
                                            <img src="<?php echo $profile_photo; ?>" alt="" class="profile-photo rounded-circle">
                                        </div>
                                        <div class="col-9">
                                            <div class="row mt-4">
                                                <div class="col-8">
                                                    <h1 class="full-name"><?php echo $name; ?></h1>
                                                    <h5 class="user-name"><?php echo $username; ?></h5>

                                                    <?php
                                                    if ($bio!=null) {
                                                        ?>
                                                    <h4 class="bio mt-3"><?php echo $bio; ?></h4>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($works!=null) {
                                                        ?>
                                                    <p class="small work mt-3"><i class="fa fa-briefcase small"></i> <?php echo $works; ?></p>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                    <?php
                                                    if ($address!=null) {
                                                        ?>
                                                    <p class="address mt-1">
                                                        <i class="fa fa-map-marker"></i> <?php echo $address ?>
                                                    </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-4">
                                                    <a href="" class="btn btn-primary float-right">Send Message</a>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="" class="btn btn-outline-dark w-100">Followers
                                                                <span class="badge badge-primary"><?php echo $followers; ?></span>
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <a href="" class="btn btn-outline-dark w-100">Foolowing
                                                                <span class="badge badge-primary"><?php echo $following; ?></span>
                                                            </a>
                                                        </div>
                                                        <div class="col-5">
                                                            <a href="" class="btn btn-primary w-100 fa font-weight-bold"> Follow</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="profile-tabs mt-3 mb-3">
                                                <ul class="nav nav-tabs justify-content-around" role="tablist">
                                                    <li class="nav-item text-center w-25">
                                                        <a class="nav-link active font-weight-bold" data-toggle="tab" href="#tabs-1" role="tab">Thoughts</a>
                                                    </li>
                                                    <li class="nav-item text-center w-25">
                                                        <a class="nav-link font-weight-bold" data-toggle="tab" href="#tabs-2" role="tab">About</a>
                                                    </li>
                                                    <li class="nav-item text-center w-25">
                                                        <a class="nav-link font-weight-bold" data-toggle="tab" href="#tabs-3" role="tab">Photos</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Tab panes -->
                                            <div class="tab-content tab-page">
                                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                                    <?php include "./thoughts.php"; ?>
                                                </div>
                                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                                    <?php include "./about_me.php"; ?>
                                                </div>
                                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                                    <?php include "./my_photos.php" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <?php include "./includes/chat-section.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).on('click', '.like', function(e) {
        var this_elem = $(this);
        e.preventDefault();
        post_id = $(this).attr('href');
        user_id = <?php echo $_SESSION['user_id']; ?>;
        $.ajax({
            type: "GET",
            datatype: "json",
            url: "like_script.php",
            data: "post_id=" + post_id + "&user_id=" + user_id,
            cache: false,
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 'liked') {
                    this_elem.parent().parent().prev().find('.likes').text(data.total_likes);
                    this_elem.find('.likes').text(data.total_likes);
                    this_elem.find('#like-text').text('Unlike');
                    this_elem.find('.unliked').addClass('liked').removeClass('unliked');
                } else if (data.status == 'unliked') {
                    this_elem.parent().parent().prev().find('.likes').text(data.total_likes);
                    this_elem.find('.likes').text(data.total_likes);
                    this_elem.find('#like-text').text('Like');
                    this_elem.find('.liked').addClass('unliked').removeClass('liked');
                } else {
                    alert(data.status);
                }
            },
            error: function(jqXHR, exception) {
                alert('error: ' + eval(jqXHR.status));
            }
        });
    });
</script>

</html>