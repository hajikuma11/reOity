<?php

//***アクセストークン**********************************************************************************************************************************************************************
$accessToken = 'HjUjwJORNXxUyK/BJ3zw5+IVAnZ9lOcUHkgTxN7FGECcmS3jnIAndMcuUfW5qpazytxUVR62hXsqpv00JeXU9kjw9WLqesWYATfEmXabOoEt/FeYJPk2d4UJstPKwrlvRfdRHVpiucEX3K1n17qYDAdB04t89/1O/w1cDnyilFU=';

//***変数宣言****************************************************************************************************************************************************************************
$jsonString = file_get_contents('php://input');
$jsonObj = json_decode($jsonString);

$message = $jsonObj->{"events"}[0]->{"message"};
$text = $message->{"text"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
$line_source = $jsonObj->{"events"}[0]->{"source"};
$userID = $line_source->{"userId"};
$msgFlag = 0;

if ($jsonObj->events[0]->type == 'postback') {
    if ($jsonObj->events[0]->postback->data != 'value') {
        $text = $jsonObj->events[0]->postback->data;
    }
}
$text = trim($text);

//***天気予報********************************************************************************************************************************************************************************
if ($text == 'forecast' or $text == '天気予報' or $text == 'てんきよほう') {

    $json = file_get_contents(__DIR__.'/main/flexJson/calTenki.json');
    $json = json_decode($json,true);

    $messageData = [
        'type' => 'flex',
        'altText' => '地域選択',
        'contents' => $json
    ];

}

elseif ($text == 'weekosaka' or $text == 'weekkyoto' or $text == 'weekhyogo') {
    require_once __DIR__ . ("/main/weath.php");
}

//***交通機関選択**************************************************************************************************************************************************************************
elseif (strstr($text,'今')) {
    require_once __DIR__ . ("/main/now.php");
}

elseif ($text == 'Train' or $text == '電車' or $text == 'train' or $text == 'KyobashiSt'
    or $text == '京橋発' or $text == '京橋から' or $text == 'kh2' or $text == 'NagaoSt'
    or $text == '長尾駅発' or $text == 'Localbus' or $text == 'バス' or $text == 'bus'
    or $text == 'goNag' or $text == 'goNag2' or $text == 'goKita' or $text == 'goKita2'
    or $text == 'goKuz' or $text == 'goKuz2' or $text == 'goKitafK' or $text == 'goKitafK2'
    or $text == '時刻' or $text == 'じこく') {

    require_once __DIR__ . ("/main/Tr-Bs.php");
}

elseif ($text == 'オールなう' or $text == 'オールナウ' or $text == 'おナウ' or $text == 'おーるなう' or $text == 'AN') {
    require_once __DIR__ . ("/main/allNow.php");
}

elseif (strstr($text,'進数')) {
    require_once __DIR__ . ("/main/decimal.php");
}

elseif ($text == 'getprofile') {
    $AfterConID = substr($userID, 0, 2);
    $BeforeConID = substr($userID, 30, 32);
    $conID = $BeforeConID.$AfterConID;
    $messageData = [
        'type' => 'text',
        'text' => $conID
    ];
}

elseif ($text == 'ど田舎') {
    require_once __DIR__ . ("/main/weath.php");
}

elseif ($text == 'じゃんけん' or strstr($text,'gcp')) {
    require_once __DIR__ . ("/main/gcp.php");
}

elseif (strstr($text,"def:")) {
    require_once __DIR__ . ("/main/def.php");
}

elseif (strstr($text,"cb:") || strstr($text,'草:')) {
    require_once __DIR__ . ("/main/cb.php");
}

//***レスポンス系*****************************************************************************************************************************************************************************
if ($msgFlag == 1) {
    $response = [
        'replyToken' => $replyToken,
        'messages' => [$messageData,$messageData2]
    ];
} else if ($msgFlag == 2) {
    $response = [
        'replyToken' => $replyToken,
        'messages' => [$messageData,$messageData2,$messageData3]
    ];
} else {
    $response = [
        'replyToken' => $replyToken,
        'messages' => [$messageData]
    ];
}
    $ch = curl_init('https://api.line.me/v2/bot/message/reply');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charser=UTF-8',
        'Authorization: Bearer ' . $accessToken
    ));
    $result = curl_exec($ch);
    error_log("[[[KAIHATU]]]".$result);
    curl_close($ch);