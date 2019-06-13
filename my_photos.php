<div class="container-fluid container-gallery">

    <div class="gallery">
        <?php
        $sql = "SELECT post_images.id AS 'POST_IMAGES_ID', post_images.posts_id AS 'POST_ID', images AS 'IMAGES', posts.total_likes AS 'TOTAL_LIKES', posts.total_comments AS 'TOTAL_COMMENTS' FROM post_images, posts WHERE posts.id = post_images.posts_id AND posts.users_id = {$_SESSION['user_id']};";
        $post_images = $conn->query($sql);
        if ($post_images->num_rows > 0) {
            while ($post_image = $post_images->fetch_assoc()) {
                $post_id = $post_image['POST_ID'];
                $likes = $post_image['TOTAL_LIKES'];
                $comments = $post_image['TOTAL_COMMENTS'];
                $images = explode(';', $post_image['IMAGES']);
                if (count($images) > 0) {
                    foreach ($images as $image) {
                        ?>
            <div class="gallery-item" tabindex="0">

                <a href="<?php echo "./post.php?post_id=".$post_id; ?>"></a><img src="<?php echo $image; ?>" class="gallery-image" alt="">

                <div class="gallery-item-info">

                    <ul>
                        <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fa fa-heart" aria-hidden="true"></i> <?php echo $likes; ?></li>
                        <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fa fa-comment" aria-hidden="true"></i> <?php echo $comments; ?></li>
                    </ul>

                </div>

            </div>
<?php
                    }
                }
            }
        }
?>
        </div>
        <!-- End of gallery -->

        <div class="loader"></div>

    </div>
    <!-- End of container -->