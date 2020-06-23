<?php
date_default_timezone_set('Asia/Tokyo');
$Ntime = date("G");
//==============================================
if (6 <= $Ntime && $Ntime <= 8) {
  $TM = '6~8';
}
elseif (9 <= $Ntime && $Ntime <= 11) {
  $TM = '9~11';
}
elseif (12 <= $Ntime && $Ntime <= 14) {
  $TM = '12~14';
}
elseif (15 <= $Ntime && $Ntime <= 17) {
  $TM = '15~17';
}
elseif (18 <= $Ntime && $Ntime <= 20) {
  $TM = '18~20';
}
elseif (21 <= $Ntime && $Ntime <= 23) {
  $TM = '21~24';
}
elseif (0 <= $Ntime && $Ntime <= 5) {
  $TM = '運行していないようです';
}
$TM1 = $TM;
$TM2 = $TM;
$TM3 = $TM;
$TM4 = $TM;
//===============================================
  $loc1 = "bu";
  if ($Ntime == "21") {
    $TM1 = '21';
  }
  elseif (22 <= $Ntime && $Ntime <= 23){
    $TM1 = '運行';
    $loc1 = 'していません';
  }
//===============================================
  $loc2 = "bd";
  if ($TM == "6~8"){
    $TM2 = '運行';
    $loc2 = 'していません';
  }
  elseif ($Ntime == "21") {
    $TM2 = '21';
  }
  elseif (22 <= $Ntime && $Ntime <= 23){
    $TM2 = '運行';
    $loc2 = 'していません';
  }
//===============================================
  $loc3 = "kk";
  if ($TM == "6~8"){
    $TM3 = 'データが';
    $loc3 = 'ありません';
  }
  elseif (10 <= $Ntime && $Ntime <= 11){
    $TM3 = '10~11';
  }
//===============================================
  $loc4 = "kh";

$messageData = [
    'type' => 'flex',
    'altText' => 'flexmessage',
    'contents' => [
        'type' => 'bubble',
        'body' => [
            'type' => 'box',
            'layout' => 'vertical',
            'contents' => [
                [
                    'type' => 'text',
                    'text' => 'どこからどこの時刻？',
                    'weight' => 'bold',
                    'size' => 'xl'
                ],
                [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'margin' => 'lg',
                    'spacing' => 'sm',
                    'contents' => [
                        [
                            'type' => 'box',
                            'layout' => 'baseline',
                            'spacing' => 'sm',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '今の時間帯の時刻表をお知らせします。',
                                    'wrap' => true,
                                    'color' => '#666666',
                                    'size' => 'sm',
                                    'flex' => 5
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'footer' => [
            'type' => 'box',
            'layout' => 'vertical',
            'spacing' => 'sm',
            'contents' => [
                [
                    'type' => 'button',
                    'style' => 'primary',
                    'height' => 'sm',
                    'action' => [
                        'type' => 'postback',
                        'label' => "長尾駅発 北山中央行",
                        'text' => $TM1.$loc1,
                        'data' => 'value'
                    ]
                ],
                [
                    'type' => 'button',
                    'style' => 'primary',
                    'height' => 'sm',
                    'action' => [
                        'type' => 'postback',
                        'label' => "北山中央発 長尾駅行",
                        'text' => $TM2.$loc2,
                        'data' => 'value'
                    ]
                ],
                [
                    'type' => 'button',
                    'style' => 'primary',
                    'height' => 'sm',
                    'action' => [
                        'type' => 'postback',
                        'label' => "北山中央発 樟葉駅行",
                        'text' => $TM3.$loc3,
                        'data' => 'value'
                    ]
                ],
                [
                    'type' => 'button',
                    'style' => 'primary',
                    'height' => 'sm',
                    'action' => [
                        'type' => 'postback',
                        'label' => "京橋駅発 長尾駅行",
                        'text' => $TM4.$loc4,
                        'data' => 'value'
                    ]
                ]
            ],
            'flex' => 0
        ]
    ]
];