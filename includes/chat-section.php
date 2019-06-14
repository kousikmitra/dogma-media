<div class="known-peoples position-fixed w-100 h-100 ml-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">People you know!</h4>
                            <small class="card-text">Click to send a message</small>
                        </div>
                        <ul class="list-group list-group-flush">
                  <?php
                  $sql = "SELECT followers.users_id AS 'USER_ID', followers.follows AS 'FOLLOW_ID', users.username AS 'USERNAME', users.name AS 'NAME', profiles.profile_photo AS 'PROFILE_PHOTO' from followers, users, profiles WHERE followers.follows = users.id AND users.id = profiles.users_id AND followers.users_id= {$_SESSION['user_id']};";
                  $followings = $conn->query($sql);
                  if ($followings->num_rows > 0) {
                    while ($follow = $followings->fetch_assoc()) {
                      ?>
                      <a href="<?php echo "./chat/?sent_to=".$follow['FOLLOW_ID']; ?>"><li class="list-group-item px-2">
                        <img src="<?php echo get_dir_url() . "profile_images/" . $follow['PROFILE_PHOTO'] ?>" class="profile-icon mr-1" alt=""><?php echo $follow['USERNAME'] ?>
                      </li></a>
                    <?php
                  }
                } else {
                  ?>
                    <li class="list-group-item px-2">
                      <p class="">Follow someone to send a message</p>
                    </li>
                  <?php
                }
                ?>
                </ul>
                    </div>
                </div>