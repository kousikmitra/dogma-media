<div class="post-item card m-3 my-3">
    <div class="card-header d-flex align-items-center">
        <?php
        $sql = "SELECT users.id AS 'USERID', users.username AS 'USERNAME', users.name AS 'NAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM users, profiles WHERE users.id = profiles.users_id AND users.id={$user_post_id};";
        $result = $conn->query($sql);
        $result = $result->fetch_assoc();
        ?>
        <a class="d-flex align-items-center" href="<?php echo "./profile.php?user_id={$user_post_id}"; ?>"><img src="<?php echo get_dir_url()."profile_images/".$result['PROFILE_PHOTO']; ?>" class="profile-icon img-fluid rounded-circle" alt="">
            <h5 class="user-name font-weight-200 ml-3 mt-2"><?php echo $result['USERNAME']; ?></h5>
        </a>
        <small class="ml-auto"><?php echo get_time_difference("$post_date $post_time"); ?></small>
    </div>
    <div class="card-body p-0">
        <div class="post-text m-2">
            <h4 class="card-title"><?php echo $post_title; ?></h4>
            <p class="card-text">
                <?php echo $post_data; ?>
            </p>
        </div>
        <div class="post-imaes">
            <?php
            $sql = "SELECT `id`, `posts_id`, `images` FROM `post_images` WHERE posts_id={$post_id};";
            $post_images = $conn->query($sql);
            if ($post_images->num_rows == 1) {
                $images = $post_images->fetch_assoc();
                $images = explode(';', $images['images']); ?>
                <?php
                if (count($images) > 0) {
                    ?>
                    <a href="<?php echo "./post.php?post_id={$post_id}"; ?>"><img src="<?php echo $images[0]; ?>" class="post-img card-img-bottom m-auto p-1" alt=""></a>
                <?php
            }
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
                <?php
                $sql = "SELECT `id`, `posts_id`, `users_id` FROM `likes` WHERE posts_id={$post_id} AND users_id={$_SESSION['user_id']};";
                $likes = $conn->query($sql);
                if ($likes->num_rows == 1) {
                    $like_status = true;
                } else {
                    $like_status = false;
                }
                ?>
                <a href="<?php echo $post_id; ?>" class="like d-flex justify-content-center align-items-center">
                    <h5><i class="fa <?php echo ($like_status? 'liked' : 'unliked'); ?>" aria-hidden="true"></i>
                    <span id='like-text'>
                        <?php echo ($like_status? 'Unlike' : 'Like'); ?>
                    </span></h5>
                    <span class="likes badge badge-primary mb-1 ml-2"><?php echo $total_likes; ?></span>
                </a>
                
            </div>
            <div class="col-4 text-center d-flex justify-content-center align-items-center">
                <a href="<?php echo "./post.php?post_id={$post_id}"; ?>" class="d-flex justify-content-center align-items-center">
                <h5><i class="fa fa-align-center" aria-hidden="true"></i>
                    Comment</h5>
                <span class="badge badge-primary mb-1 ml-2"><?php echo $total_comments; ?></span>
                </a>
            </div>
            <div class="col-4 text-center d-flex justify-content-center align-items-center">
                <h5><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    Share</h5>
                <span class="badge badge-primary mb-1 ml-2">0</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <div class="post-comments">
                    <ul class="list-group list-group-flush">
                        <?php
                        $sql = "SELECT comments.id AS 'COMMENT_ID', comments.users_id AS 'USER_ID', comments.comment AS 'COMMENT', comments.comment_date AS 'COMMENT_DATE', comments.comment_time AS 'COMMENT_TIME', users.username AS 'COMMENT_USERNAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM comments, users, profiles WHERE users.id = comments.users_id AND posts_id={$post_id} ORDER BY comments.comment_date DESC, comments.comment_time DESC;";
                        $post_comments = $conn->query($sql);
                        if ($post_comments->num_rows > 0) {
                            if ($comment = $post_comments->fetch_assoc()) {
                                $comment_profile_photo = $comment['PROFILE_PHOTO'];
                                $comment_data = $comment['COMMENT'];
                                $comment_user_id = $comment['USER_ID'];
                                $comment_username = $comment['COMMENT_USERNAME'];
                                $comment_date = $comment['COMMENT_DATE'];
                                $comment_time = $comment['COMMENT_TIME'];
                                ?>
                                <li class="list-group-item d-flex">
                                    <img src="<?php echo get_dir_url()."profile_images/".$comment_profile_photo; ?>" class="profile-icon mr-2" alt="">
                                    <blockquote class="blockquote">
                                        <p class="mb-0"><?php echo $comment_data; ?></p>
                                        <footer class="blockquote-footer">by <a href="<?php echo "./profile.php?user_id={$comment_user_id}"; ?>"><cite><?php echo $comment_username; ?></cite></a></footer>
                                    </blockquote>
                                    <small class="ml-auto"><?php echo get_time_difference("$comment_date $comment_time"); ?></small>
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