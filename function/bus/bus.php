<?php
$tmp_txt = [
  'type' => 'text',
  'text' => "This is\n".basename(__FILE__)
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$tmp_txt]
];