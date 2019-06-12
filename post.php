<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
require_once "./database/dbconnection.php";
if (($_SERVER['REQUEST_METHOD'] == 'GET') and isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $sql = "SELECT `id`, `users_id`, `post_title`, `post_data`, `post_date`, `post_time`, `total_likes`, `total_comments` FROM `posts` WHERE id={$post_id};";
    $result_posts = $conn->query($sql);
    if ($result_posts->num_rows == 1) {
        $post = $result_posts->fetch_assoc();
        $post_id = $post['id'];
        $user_post_id = $post['users_id'];
        $post_title = $post['post_title'];
        $post_data = $post['post_data'];
        $post_date = $post['post_date'];
        $post_time = $post['post_time'];
        $total_likes = $post['total_likes'];
        $total_comments = $post['total_comments'];
    } else {
        header('location:./info.php');
    }
} else {
    header('location:./info.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>This is a Post</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
    </style>
</head>

<body>
    <div class="container-main">
        <?php include_once "./includes/header.php"; ?>
        <div class="main" style="margin-top: 15vh;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vero repellendus debitis iure temporibus unde obcaecati, quidem illum inventore asperiores nam. Quos necessitatibus quam nemo vero perspiciatis est porro ab inventore!
                    </div>
                    <div class="col-8">
                        <div class="post-item card">
                            <div class="card-header d-flex align-items-center">
                                <?php
                                $sql = "SELECT users.id AS 'USERID', users.username AS 'USERNAME', users.name AS 'NAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM users, profiles WHERE users.id = profiles.users_id AND users.id={$user_post_id};";
                                $result = $conn->query($sql);
                                $result = $result->fetch_assoc();
                                ?>
                                <a class="d-flex align-items-center" href="http://"><img src="<?php echo $result['PROFILE_PHOTO']; ?>" class="profile-icon img-fluid rounded-circle" alt="">
                                    <h5 class="user-name font-weight-200 ml-3 mt-2"><?php echo $result['USERNAME']; ?></h5>
                                </a>
                                <small class="ml-auto"><?php echo get_time_difference("$post_date $post_time");; ?></small>
                            </div>
                            <div class="card-body p-0">
                                <div class="post-text mx-2 m-2">
                                    <h4 class="card-title"><?php echo $post_title; ?></h4>
                                    <p class="card-text">
                                        <?php echo $post_data; ?>
                                    </p>
                                </div>
                                <div class="post-images">
                                    <?php
                                    $sql = "SELECT `id`, `posts_id`, `images` FROM `post_images` WHERE posts_id={$post_id};";
                                    $post_images = $conn->query($sql);
                                    if ($post_images->num_rows == 1) {
                                        $images = $post_images->fetch_assoc();
                                        $images = explode(';', $images['images']);
                                        ?>
                                        <?php
                                        if (count($images) == 1) {
                                            ?>
                                            <img src="<?php echo $images[0]; ?>" class="post-img-1 card-img-bottom m-auto p-1" alt="">
                                        <?php
                                    }
                                    if (count($images) == 2) {
                                        foreach ($images as $image) {
                                            ?>
                                                <img src="<?php echo $image; ?>" class="post-img-2 card-img-bottom m-auto p-1" alt="">
                                            <?php
                                        }
                                    }
                                    if (count($images) == 3) {
                                        foreach ($images as $image) {
                                            ?>
                                                <img src="<?php echo $image; ?>" class="post-img-3 card-img-bottom m-auto p-1" alt="">
                                            <?php
                                        }
                                    }
                                    if (count($images) == 4) {
                                        foreach ($images as $image) {
                                            ?>
                                                <img src="<?php echo $image; ?>" class="post-img-4 card-img-bottom m-auto p-1" alt="">
                                            <?php
                                        }
                                    }
                                    if (count($images) > 4) {
                                        foreach ($images as $image) {
                                            ?>
                                                <img src="<?php echo $image; ?>" class="post-img-* card-img-bottom m-auto p-1" alt="">
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                }
                                ?>

                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row mb-3">
                                    <div class="col">
                                        <a href="#" class="ml-1"><span class="likes"><?php echo $total_likes; ?></span> peoples liked this</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <a href="" id="post-like" class="btn btn-outline-dark w-100">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            LIKE <span class="likes badge badge-primary"><?php echo $total_likes; ?></span>
                                        </a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="#comment-text" class="btn btn-outline-dark w-100">
                                            <i class="fa fa-align-center" aria-hidden="true"></i>
                                            Comment <span class="badge badge-primary"><?php echo $total_comments; ?></span>
                                        </a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="#" class="btn btn-outline-dark w-100">
                                            <i class="fa fa-share" aria-hidden="true"></i>
                                            Share <span class="badge badge-primary">0</span>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div id="post-comments" class="post-comments">
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                $sql = "SELECT comments.id AS 'COMMENT_ID', comments.users_id AS 'USER_ID', comments.comment AS 'COMMENT', comments.comment_date AS 'COMMENT_DATE', comments.comment_time AS 'COMMENT_TIME', users.username AS 'COMMENT_USERNAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM comments, users, profiles WHERE users.id = comments.users_id AND posts_id={$post_id};";
                                                $post_comments = $conn->query($sql);
                                                if ($post_comments->num_rows > 0) {
                                                    while ($comment = $post_comments->fetch_assoc()) {
                                                        ?>
                                                        <li class="list-group-item d-flex">
                                                            <img src="<?php echo $comment['PROFILE_PHOTO'] ?>" class="profile-icon mr-2" alt="">
                                                            <blockquote class="blockquote">
                                                                <p class="mb-0"><?php echo $comment['COMMENT']; ?></p>
                                                                <footer class="blockquote-footer">by <a href="./profile.php?<?php echo $comment['USER_ID']; ?>"><cite><?php echo $comment['COMMENT_USERNAME']; ?></cite></a></footer>
                                                            </blockquote>
                                                        </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </ul>
                                            <form action="./comment_script.php" method="post" class="form">
                                                <div class="form-inline d-flex">
                                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                                    <div class="input-group flex-fill">
                                                        <input type="text" name="comment_text" id="comment-text" class="form-control" placeholder="What's your thoughts?" required>
                                                    </div>
                                                    <div class="input-group ml-1">
                                                        <input type="submit" name="comment_submit" class="btn btn-primary fa" value="&#xf1d9; Comment">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-2 p-0">
                        <?php include "./includes/chat-section.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('#post-like').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            datatype: "json",
            url: "like_script.php",
            data: "post_id=<?php echo $post_id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>",
            cache: false,
            success: function(data) {
                data = JSON.parse(data);
                if(data.status == 1){
                    $('.likes').text(data.total_likes);
                    $('#post-like').removeClass('btn-outline-dark');
                    $('#post-like').addClass('btn-primary');
                }
            },
            error: function(jqXHR, exception) {
                alert('error: ' + eval(jqXHR.status));
            }
        });
    });
</script>

</html>