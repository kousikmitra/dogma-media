<?php
session_start();

if (isset($_POST['msg']) and isset($_POST['sent_to']) and ($_POST['sent_to'] == $_SESSION['sent_to'])) {
  require_once __DIR__ . '/FbChatMock.php';
  
  $user_id = (int) $_SESSION['user_id'];
  $sent_to = (int) $_SESSION['sent_to'];
  // Escape the message string
  $msg = htmlentities($_POST['msg'],  ENT_NOQUOTES);
  
  $chat = new FbChatMock();
  $result = $chat->addMessage($user_id, $sent_to, $msg);
}
?>