<?php
$beacon_type = $obj_req->{"events"}[0]->{"beacon"}->{"type"};

if ($beacon_type == "enter") {
  $msg = [
    'type' => 'text',
    'text' => "近くにいますね。"
  ];
} else {
  $msg = [
    'type' => 'text',
    'text' => "離れましたね。"
  ];
}

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$msg]
];