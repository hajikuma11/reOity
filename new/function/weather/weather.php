<?php
//Webスクレイピング用ライブラリ
require_once __DIR__.'/phpQuery-onefile.php';

//指定された都道府県毎にURLと名前を決定
switch (true) {
  case preg_match('/osaka/', $msg):
    $url = 'https://www.jma.go.jp/jp/week/331.html';
    $name = '大阪府';
  break;

  case preg_match('/kyoto/', $msg):
    $url = 'https://www.jma.go.jp/jp/week/331.html';
    $name = '京都府';
  break;

  case preg_match('/hyogo/', $msg):
    $url = 'https://www.jma.go.jp/jp/week/331.html';
    $name = '兵庫県';
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
  break;
}

//更新日時の生成
date_default_timezone_set('Asia/Tokyo');
if (11 <= date("H") && date("H") <= 16) {
  $timestamp = date("Y/m/d")." 11:00";
} elseif (17 <= date("H") && date("H") <= 23) {
  $timestamp = date("Y/m/d")." 17:00";
} elseif (date("H") < 11) {
  $timestamp = date("Y/m/d", strtotime("-1 day"))." 17:00";
} else {
  $timestamp = 'error';
}

//Webスクレイピング

//データを取得する
$html = file_get_contents($url);
$html_data = phpQuery::newDocument($html);
$html_contents = $html_data[".for"]->text();
$contents_arr = explode("\n", $html_contents);

//空要素を削除
$contents_arr = array_filter($contents_arr, "strlen");

//カウントの初期化
$rain_cnt = $maxtemp_cnt = 0;

//コンテンツをそれぞれの要素で格納する
for ($i = 0;$i < count($contents_arr);$i++) {
  //コンテンツをトリムする
  $content = trim(preg_replace('/[\t|\s{,}]/', '', $contents_arr[$i]));

  //内容がないなら次のコンテンツへ
  if ($content == '') {
    continue;
  }

  //気象情報
  if (strstr($content,"晴") || strstr($content,"曇") || strstr($content,"雨") || strstr($content,"雪")) {
    $content = str_replace("晴","☀️",$content);
    $content = str_replace("曇","☁️",$content);
    $content = str_replace("雨","☔️",$content);
    $content = str_replace("雪","❄️",$content);
    $climate_arr[] = $content;
    continue;
  }

  //降水確率
  if (0 <= $rain_cnt && $rain_cnt < 7) {
    $rain_arr[] = $content.'%';
    $rain_cnt++;
    continue;
  }

  //気温
  if (strstr($cont,"(")) {
    continue;
  }
  //最高気温
  if (7 <= $rain_cnt && $maxtemp_cnt < 7) {
    $maxtemp_arr[] = $content.'°C';
    $maxtemp_cnt++;
    continue;
  }

  //最低気温
  $mintemp_arr[] = $content.'°C';
}

//タイトル生成

//今日からの１週間か明日からの１週間か
if (11 <= date("H")) {
  $day_num = 1;
} else {
  $day_num = 0;
}

//曜日用配列
$week_name = ["日", "月", "火", "水", "木", "金", "土"];

for ($i = 0 + $day_num;$i < 7 + $day_num;$i++) {
  $month = date("m",strtotime($i."day"));
  $day = date("d",strtotime($i."day"));
  $week = date("w",strtotime($i."day"));

  $title[] = $name.' '.$month.'月'.$day.'日 ('.$week_name[$week].')';
}

//フレックスメッセージの生成

require_once('createJson.php');

$flex = createFlex($timestamp, $title, $climate_arr, $rain_arr, $maxtemp_arr, $mintemp_arr);

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex]
];