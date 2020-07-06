<?php
$txt = [
  'type' => 'text',
  'text' => 'You win!'
];

require_once('moreback.php');
$flex_moreback = moreback();

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex_bot, $txt, $flex_moreback]
];

send($content_reply,$token_access);
exit();