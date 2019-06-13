<?php
session_start();
require_once "./includes/functions.php";
if (!auth()) {
    header('location:./login.php');
}
require_once "./database/dbconnection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <?php require_once "./includes/links.php"; ?>
    <style>
        .liked:before {
            content: "\f004";
        }

        .unliked:before {
            content: "\f08a";
        }
    </style>
</head>

<body>
    <div class="container-main">
        <?php include_once "./includes/header.php"; ?>
        <div class="main" style="margin-top:15vh;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 p-0">
                        <i class="fa fa-trash"></i>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, nostrum perspiciatis
                        dicta assumenda quos atque expedita officiis! Nulla neque eius incidunt excepturi sint
                        sapiente? Ullam omnis fuga reiciendis suscipit molestias.
                    </div>
                    <div class="col-lg-8 p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <?php include "./includes/post-update.php"; ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="posts-container">
                                        <?php
                                        $sql = "SELECT posts.id AS 'POST_ID', posts.users_id AS 'POST_USER_ID', posts.post_title AS 'POST_TITLE', posts.post_data AS 'POST_DATA', posts.post_date AS 'POST_DATE', posts.post_time AS 'POST_TIME', posts.total_likes AS 'TOTAL_LIKES', posts.total_comments AS 'TOTAL_COMMENTS', users.username AS 'POST_USERNAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM posts, users, profiles WHERE (posts.users_id = users.id AND profiles.users_id = users.id) AND (posts.users_id IN (SELECT follows FROM followers WHERE users_id = {$_SESSION['user_id']}) OR posts.users_id = {$_SESSION['user_id']}) ORDER BY posts.post_date DESC, posts.post_time DESC;";
                                        $result_posts = $conn->query($sql);
                                        if ($result_posts->num_rows > 0) {
                                            while ($post = $result_posts->fetch_assoc()) {
                                                $post_id = $post['POST_ID'];
                                                $user_post_id = $post['POST_USER_ID'];
                                                $post_title = $post['POST_TITLE'];
                                                $post_data = $post['POST_DATA'];
                                                $post_date = $post['POST_DATE'];
                                                $post_time = $post['POST_TIME'];
                                                $total_likes = $post['TOTAL_LIKES'];
                                                $total_comments = $post['TOTAL_COMMENTS'];
                                                $usernames = $post['POST_USERNAME'];
                                                $profile_photos = $post['PROFILE_PHOTO']; ?>
                                                <?php include "./includes/post-item.php"; ?>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                            <div class="container-fluid d-flex justify-content-center mt-5 text-muted">
                                                <h1 class="display-4">Follow! To see their thoughts...</h1>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 p-0">
                        <?php include "./includes/chat-section.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\"><button type=\"button\" class=\"btn btn-sm\"><i class=\"fa fa-trash\"></i> Remove</button></span>" +
                            "</span>").insertAfter("#preview");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

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