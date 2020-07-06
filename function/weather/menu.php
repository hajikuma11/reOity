<?php

$json = file_get_contents(__DIR__.'/json/menu.json');
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
send($content_reply,$token_access);
exit();