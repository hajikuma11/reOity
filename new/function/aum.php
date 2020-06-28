<?php
//オウム返し
$aum = [
  'type' => 'text',
  'text' => $msg
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$aum]
];