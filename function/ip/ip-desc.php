<?php
$json = file_get_contents(__DIR__.'/json/ip-desc.json');
$arr = json_decode($json,true);

$flex = [
  'type' => 'flex',
        'altText' => 'サブネット計算機能の説明',
        'contents' => $arr
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex]
];