<?php
$json = file_get_contents(__DIR__.'/json/mainmenu.json');
$arr = json_decode($json,true);

$flex = [
  'type' => 'flex',
        'altText' => 'メインメニュー',
        'contents' => $arr
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex]
];