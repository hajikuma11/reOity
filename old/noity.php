<?php
//date_default_timezone_set('Asia/Tokyo');
//
//function todayWeather() {}
//
//function transLate() {}
//
//function date() {}
//
//function contribution() {}
//
//function report() {}

function push($token,$post) {

    $headers = [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json; charset=utf-8',
    ];

    // HTTPリクエストを設定
    $ch = curl_init('https://api.line.me/v2/bot/message/push');
    $options = [
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_BINARYTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_POSTFIELDS => $post,
    ];
    curl_setopt_array($ch, $options);

// 実行
    $result = curl_exec($ch);

// エラーチェック
    $errno = curl_errno($ch);
    if ($errno) {
        return;
    }

// HTTPステータスを取得
    $info = curl_getinfo($ch);
    $httpStatus = $info['http_code'];

    $responseHeaderSize = $info['header_size'];
    $body = substr($result, $responseHeaderSize);

    echo $httpStatus . ' ' . $body;
}

$accessToken = 'HjUjwJORNXxUyK/BJ3zw5+IVAnZ9lOcUHkgTxN7FGECcmS3jnIAndMcuUfW5qpazytxUVR62hXsqpv00JeXU9kjw9WLqesWYATfEmXabOoEt/FeYJPk2d4UJstPKwrlvRfdRHVpiucEX3K1n17qYDAdB04t89/1O/w1cDnyilFU=';

$messageData = [
  'to' => 'U59e8d04370fd44f663dd5045f0c4ee1b',
    'messages' => [
        [
            'type' => 'text',
            'text' => 'testですよ',
        ],
    ],
];

$messageData = json_encode($messageData);

push($accessToken,$messageData);