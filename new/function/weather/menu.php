<?php

$json = file_get_contents(__DIR__.'/json/menu.json');
$arr = json_decode($json,true);

$flex_data = [
'type' => 'flex',
'altText' => '週間天気予報',
'contents' => [
    'type' => 'carousel',
    'contents' => $arr
]
];

$content_reply = [
    'replyToken' => $token_reply,
    'messages' => [$flex_data]
];
send($content_reply,$token_access);
exit();