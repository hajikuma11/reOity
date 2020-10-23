<?php
$val_arr = explode('=',$msg);
$base = (int)$val_arr[0];
$num = $val_arr[1];

if (strlen((string)$num) > 15) {
  $error = [
    'type' => 'text',
    'text' => '１５桁以下の値のみ対応しています。'
  ];
  $content_reply = [
    'replyToken' => $token_reply,
    'messages' => [$error]
  ];
  send($content_reply,$token_access);
  exit();
}

$color = [
  '2' => '#F5F5F5',
  '8' => '#F5F5F5',
  '10' => '#F5F5F5',
  '16' => '#F5F5F5'
];
$color[$base] = '#bbbbbb';

$two_data = base_convert($num, $base, 2);
$eig_data = base_convert($num, $base, 8);
$ten_data = base_convert($num, $base, 10);
$sit_data = base_convert($num, $base, 16);

require_once('createJson.php');
require_once(__DIR__.'/../back/back.php');

$flex_main = createFlex($base, $color, $two_data, $eig_data, $ten_data, $sit_data);
$flex_back = back();

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex_main, $flex_back]
];