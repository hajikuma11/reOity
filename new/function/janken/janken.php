<?php

if (preg_match('/[012]/', $msg, $user_hand) != false) {
  $bot_hand = rand(0,2);

  $result = ($user_hand - $bot_hand + 3) % 3;
  switch ($result) {
    //あいこ
    case 0:
      require_once('draw.php');
    break;

    //負け
    case 1:
      require_once('lose.php');
    break;

    //勝ち
    case 2:
      require_once('win.php');
    break;
    
    default:
      $error = [
        'type' => 'text',
        'text' => '不正なパラメータです。'
      ];
      $content_reply = [
        'replyToken' => $token_reply,
        'messages' => [$error]
      ];
      send($content_reply,$token_access);
      exit();
    break;
  }
}

$sel_json = file_get_contents(__DIR__.'/json/select.json');
$sel_arr = json_decode($sel_json,true);

$flex_sel = [
  'type' => 'flex',
        'altText' => 'じゃんけん選択肢',
        'contents' => $sel_arr
];
$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex_sel]
];