<?php
$txt = [
  'type' => 'text',
  'text' => 'You win!'
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$txt]
];
send($content_reply,$token_access);
exit();