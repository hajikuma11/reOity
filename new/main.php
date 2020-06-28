<?php
//アクセストークン
$token_access = file_get_contents('token.txt');

//リクエストjsonデータの処理
$json_req = file_get_contents('php://input');
$obj_req = json_decode($json_req);

//イベントタイプ
$event_type = $obj_req->{"events"}[0]->{"type"};

//イベントタイプごとの処理
if ($event_type == "message") {//テキスト

  //メッセージデータ
  $msg = $obj_req->{"events"}[0]->{"message"}->{"text"};
  //先頭及び末尾の空白などの余分な要素を削除
  $msg = trim($msg);

} elseif ($event_type == "postback") {//ポストバック

  //ポストバックデータ
  $msg = $obj_req->{"events"}[0]->{"postback"}->{"data"};

} else {

  exit;

}

//リプライトークン
$token_reply = $obj_req->{"events"}[0]->{"replyToken"};

switch ($msg) {
  case preg_match('/weather=>/',$msg):
    require_once(__DIR__.'/function/weather.php');
    break;

  case preg_match('/bus=>/',$msg):
    require_once(__DIR__.'/function/bus.php');
    break;

  case preg_match('/decimal=>/',$msg):
    require_once(__DIR__.'/function/decimal.php');
    break;

  case preg_match('/janken=>/',$msg):
    require_once(__DIR__.'/function/janken.php');
    break;

  default:
    require_once(__DIR__.'/function/aum.php');
    break;
}

//送信
require_once(__DIR__.'/function/send.php');
send($content_reply,$token_access);