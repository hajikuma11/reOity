<?php
$txt = [
  'type' => 'text',
  'text' => 'You lose!'
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$txt]
];
send($content_reply,$token_access);
exit();