<div class="posts-container">
    <?php
    $sql = "SELECT posts.id AS 'POST_ID', posts.users_id AS 'POST_USER_ID', posts.post_title AS 'POST_TITLE', posts.post_data AS 'POST_DATA', posts.post_date AS 'POST_DATE', posts.post_time AS 'POST_TIME', posts.total_likes AS 'TOTAL_LIKES', posts.total_comments AS 'TOTAL_COMMENTS', users.username AS 'POST_USERNAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM posts, users, profiles WHERE posts.users_id = users.id AND profiles.users_id = users.id AND users.id = {$user_id} ORDER BY posts.post_date DESC, posts.post_time DESC;";
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
            <h1 class="display-4">Still Have not posted any thoughts!</h1>
        </div>
    <?php
}
?>
</div>