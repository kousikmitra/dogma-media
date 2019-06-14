<?php
session_start();
$error = false;
require_once __DIR__ . '/FbChatMock.php';
$chat = new FbChatMock();
if (isset($_GET['sent_to']) and $chat->getUsername($_GET['sent_to'])) {
  $_SESSION['sent_to'] = (int)$_GET['sent_to'];
} else {
  $error = true;
}
require_once "../includes/functions.php";
require_once __DIR__ . "/../database/dbconnection.php";

// Load the messages initially
$messages = $chat->getMessages($_SESSION['user_id'], $_SESSION['sent_to']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo $_SESSION['user_id']; ?></title>
  <!--    <link href="/style/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/style/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />-->
  <link href="jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
  <!--    <link href="/style/non-responsive.css" rel="stylesheet" type="text/css" />-->
  <link href="core.css" rel="stylesheet" type="text/css" />
  <link href="style.css" rel="stylesheet" type="text/css" />
  <?php require_once "../includes/links.php"; ?>
</head>

<body>
  <div class="container-main">
    <?php include_once "./header.php"; ?>
    <div class="main" style="margin-top:10vh;">
      <div class="container" style="max-width:80vw;">
        <div class="row" style="">
          <div class="col-3 offset-1">
            <div class="known-peoples">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">People you know!</h4>
                  <small class="card-text">Click to send a message</small>
                </div>
                <ul class="chat-peoples list-group list-group-flush">
                  <?php
                  $sql = "SELECT followers.users_id AS 'USER_ID', followers.follows AS 'FOLLOW_ID', users.username AS 'USERNAME', users.name AS 'NAME', profiles.profile_photo AS 'PROFILE_PHOTO' from followers, users, profiles WHERE followers.follows = users.id AND users.id = profiles.users_id AND followers.users_id= {$_SESSION['user_id']};";
                  $followings = $conn->query($sql);
                  if ($followings->num_rows > 0) {
                    while ($follow = $followings->fetch_assoc()) {
                      ?>
                      <a href="<?php echo "?sent_to=".$follow['FOLLOW_ID']; ?>"><li class="list-group-item px-2">
                        <img src="<?php echo get_dir_url() . "../profile_images/" . $follow['PROFILE_PHOTO'] ?>" class="profile-icon mr-1" alt=""><?php echo $follow['USERNAME'] ?>
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
          </div>
          <?php
          if (!$error) {
              ?>
            <div class="col-8">
              <div class="container-fluid p-0" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);">
                <div class="rounded-circle">

                  <div class="msg-wgt-header">
                    <a id="sent-user" href="<?php echo "../profile.php?user_id=" . $_GET['sent_to'] ?>" data="<?php echo $_GET['sent_to'] ?>"><?php echo $chat->getUsername($_GET['sent_to']); ?></a>
                  </div>
                  <div id="chat-window" class="msg-wgt-body px-2 mt-2">
                    <table>
                      <?php
                      if (!empty($messages)) {
                          foreach ($messages as $message) {
                              $msg = htmlentities($message['message'], ENT_NOQUOTES);
                              $user_name = ucfirst($message['username']);
                              $sent = date('F j, Y, g:i a', strtotime($message['sent_on']));
                              $profile_id = $message['users_id'];
                              echo <<<MSG
              <tr class="msg-row-container">
                <td>
                  <div class="msg-row">
                    <img src="chat_avatar.png" class="avatar rounded-circle"></div>
                    <div class="message">
                      <span class="user-label"><a href="../profile.php?user_id=$profile_id" style="color: #6D84B4;">{$user_name}</a> <span class="msg-time">{$sent}</span></span><br/>{$msg}
                    </div>
                  </div>
                </td>
              </tr>
MSG;
                          }
                      } else {
                          echo '<span style="margin-left: 25px;">No chat messages available!</span>';
                      } ?>
                    </table>
                  </div>
                  <div class="msg-wgt-footer">
                    <textarea id="chatMsg" class="mb-n1" data="<?php echo $_GET['sent_to']; ?>" placeholder="Type your message. Press shift + Enter to send"></textarea>
                  </div>
                </div>
                <?php
          }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript" src="jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
  </body>
  <script>
    $(document).ready(function(e) {
      $('#chat-window').animate({
        scrollTop: $('#chat-window').get(0).scrollHeight
      }, 2000);
    });
  </script>

  </html>