<?php
require_once('select.php');
$flex_sel = select();

$flex_txt = [
  'type' => 'text',
  'text' => 'あーいこーで！'
];

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex_bot, $flex_txt, $flex_sel]
];

send($content_reply,$token_access);
exit();