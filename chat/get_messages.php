<?php
session_start();
require_once __DIR__ . '/FbChatMock.php';
$user_id = $_SESSION['user_id'];
$chat_id = $_GET['chat_id'];
$chat = new FbChatMock();
$messages = $chat->getMessages($user_id, $chat_id);
$chat_converstaion = array();

if (!empty($messages)) {
  $chat_converstaion[] = '<table>';
  foreach ($messages as $message) {
    $msg = htmlentities($message['message'], ENT_NOQUOTES);
    $user_name = ucfirst($message['username']);
    $profile_id = $message['users_id'];
    $sent = date('F j, Y, g:i a', strtotime($message['sent_on']));
    $chat_converstaion[] = <<<MSG
      <tr class="msg-row-container">
        <td>
          <div class="msg-row">
            <div class="avatar"></div>
            <div class="message">
              <span class="user-label"><a href="../profile.php?user_id=$profile_id" style="color: #6D84B4;">{$user_name}</a> <span class="msg-time">{$sent}</span></span><br/>{$msg}
            </div>
          </div>
        </td>
      </tr>
MSG;
  }
  $chat_converstaion[] = '</table><span id="chat-end"></span>';
} else {
  echo '<span style="margin-left: 25px;">No chat messages available!</span>';
}

echo implode('', $chat_converstaion);
?>