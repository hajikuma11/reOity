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

/**
 * 生成したコンテンツを送信する関数
 *
 * @param array $content
 * @return void
 */
function send ($content) {
  global $token_access;

  $ch = curl_init('https://api.line.me/v2/bot/message/reply');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json; charser=UTF-8',
      'Authorization: Bearer ' . $token_access
  ));
  $result = curl_exec($ch);
  if ($result != "{}") {
    error_log('[@reOity@]'.$result);
  }
  curl_close($ch);
}

/**
 * メイン処理を行う関数
 */
function main () {
  send($content);
}

main();