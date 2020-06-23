<?php
//変数定義
$msgNum = 1;
$msgData = '';
$msgData2 = '';
$msgData3 = '';

//アクセストークン
$token = 'HjUjwJORNXxUyK/BJ3zw5+IVAnZ9lOcUHkgTxN7FGECcmS3jnIAndMcuUfW5qpazytxUVR62hXsqpv00JeXU9kjw9WLqesWYATfEmXabOoEt/FeYJPk2d4UJstPKwrlvRfdRHVpiucEX3K1n17qYDAdB04t89/1O/w1cDnyilFU=';

//送られてきたJSON形式のデータをデコード
$jsnString = file_get_contents('php://input');
error_log($jsnString);
$jsnObj = json_decode($jsnString);

//JSONデータから各種データを抜き出す
$txt = $jsnObj->{"events"}[0]->{"message"}->{"text"};
$replyToken = $jsnObj->{"events"}[0]->{"replyToken"};
$lineSrc = $jsnObj->{"events"}[0]->{"source"};
$userID = $lineSrc->{"userId"};

//ポストバックのメッセージの場合
if ($jsnObj->events[0]->type == 'postback') {
    if ($jsnObj->events[0]->postback->data != 'value') {
        $text = $jsnObj->events[0]->postback->data;
    }
}

//メッセージをトリムしておく
$txt = trim($txt);


if (strstr($txt,'wthr:')) {
    include_once dirname(__FILE__).'/func/weather.php';
}
elseif (strstr($txt,'bus:')) {
    include_once dirname(__FILE__).'/func/bus.php';
}
elseif (strstr($txt,'tmtbl:')) {
    include_once dirname(__FILE__).'/func/timeTable.php';
}

if ($msgData != 'flag') {

    //レスポンスボディの組み立て
    if ($msgNum == 2) {
        $res = [
            'replyToken' => $replyToken,
            'messages' => [$msgData,$msgData2]
        ];
    } else if ($msgNum == 3) {
        $res = [
            'replyToken' => $replyToken,
            'messages' => [$msgData,$msgData2,$msgData3]
        ];
    } else {
        $res = [
            'replyToken' => $replyToken,
            'messages' => [$msgData]
        ];
    }

//ログ出力
    error_log('[[[KAIHATU]]]'.json_encode($res));

//Responseを送信する

    $ch = curl_init('https://api.line.me/v2/bot/message/reply');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($res));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charser=UTF-8',
        'Authorization: Bearer ' . $token
    ));
    $result = curl_exec($ch);
    error_log('[[[KAIHATU]]]'.$result);
    curl_close($ch);

} else {
    error_log('[[[KAIHATU]]]can not deal message');
}

