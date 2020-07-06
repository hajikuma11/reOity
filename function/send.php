<?php
/**
 * 生成したコンテンツを送信する関数
 *
 * @param array $content
 * @return void
 */
function send($content,$token) {

  $ch = curl_init('https://api.line.me/v2/bot/message/reply');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json; charser=UTF-8',
      'Authorization: Bearer ' . $token
  ));
  $result = curl_exec($ch);
  if ($result != "{}") {
    error_log('[@reOity@]'.$result);
  }
  curl_close($ch);
}