<?php

if (preg_match('/[012]/', $msg, $user_hand) != false) {
  $hands = ['0'=>'グー！','1'=>'チョキ！','2'=>'パー！'];

  $bot_hand = rand(0,2);

  $flex_bot = [
    'type' => 'text',
    'text' => $hands[$bot_hand]
  ];

  $result = ($user_hand[0] - $bot_hand + 3) % 3;

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

require_once('select.php');
$flex_sel = select();

$flex_txt = [
  'type' => 'text',
  'text' => 'じゃーんけーん！'
];

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex_txt, $flex_sel]
];