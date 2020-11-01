<?php
$json = file_get_contents(__DIR__.'/json/decimal-desc.json');
$arr = json_decode($json,true);

$flex = [
  'type' => 'flex',
        'altText' => '進数機能の説明',
        'contents' => $arr
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex]
];