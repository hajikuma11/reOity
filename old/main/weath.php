<?php
require_once __DIR__.'/phpQuery-onefile.php';
date_default_timezone_set('Asia/Tokyo');

if ($text == 'weekosaka') {
    $URL = 'https://www.jma.go.jp/jp/week/331.html';
    $loc = '大阪府 ';
} elseif ($text == 'weekkyoto') {
    $URL = 'https://www.jma.go.jp/jp/week/333.html';
    $loc = '京都府 ';
} elseif ($text == 'weekhyogo') {
    $URL = 'https://www.jma.go.jp/jp/week/332.html';
    $loc = '兵庫県 ';
} elseif ($text == 'weekwakayama') {
    $URL = 'https://www.jma.go.jp/jp/week/336.html';
    $loc = '和歌山県';
}

$html = file_get_contents($URL);
$doc = phpQuery::newDocument($html);

$contents = $doc[".for"]->text();

$contArr = explode("\n", $contents);

if (date("H") < 17 && date("H") > 10) {
    $timestmp = date("Y/m/d") . " 11:00";
} elseif (date("H") > 16 && date("H") <= 23) {
    $timestmp = date("Y/m/d") . " 17:00";
} elseif (date("H") < 11) {
    $timestmp = date("Y/m/d",strtotime("1day")) . " 17:00";
} else {
    $timestmp = 'error';
}

$txt = $tenk = $kous = $max = $min = "";
$cntKous = $cntmax = $endcnt = 0;

for ($i=0;$i<50;$i++) {
   $cont = trim(preg_replace('/[\t|\s{,}]/', '', $contArr[$i]));
   if ($cont == "") {
   } else {
       if (strstr($cont,"晴")||strstr($cont,"曇")||strstr($cont,"雨")||strstr($cont,"雪")) {
            $cont = str_replace("晴","☀️",$cont);
           $cont = str_replace("曇","☁️",$cont);
           $cont = str_replace("雨","☔️",$cont);
           $cont = str_replace("雪","❄️",$cont);
            $tenk .= $cont."&";
       } else if (strstr($cont,"/")) {
            $cont2 = substr($cont,0, 2);
            if (is_numeric($cont2)) {
            } else {
                $cont2 = substr($cont,2,2);
            }
            $kous .= $cont2."&";
            $cntKous++;
       } else if ($cntKous > 0 && $cntKous < 7) {
            $kous .= $cont."&";
            $cntKous++;
       } else if ($cntKous >= 7 && $cntmax <7) {
            if (strstr($cont,"(") == false) {
            $max .= $cont."&";
            $cntmax++;
            }
       } else {
           if (strstr($cont,"(") == false) {
               $min .= $cont."&";
               $endcnt++;
           }
       }
   }
}

$tenkArr = explode("&", $tenk);
$kousArr = explode("&",$kous);
$maxArr = explode("&",$max);
$minArr = explode("&",$min);

$one = 1;

if (date("H") >= 11) {
    $d = date("d",strtotime($one." day"));
    $w = date("w",strtotime($one." day"));
}  else {
    $w = date("w");
    $d = date("d");
}
$m = date("m");
$week_name = array("日", "月", "火", "水", "木", "金", "土");



for ($i=0;$i<7;$i++) {
    if ($i >= 1) {
        if (date("H") >= 11) {
            $in = $i + 1;
            $w = date("w",strtotime($in." day"));
            $d = date("d",strtotime($in." day"));
            $m = date("m",strtotime($in." day"));
        } else {
            $w = date("w",strtotime($i." day"));
            $d = date("d",strtotime($i." day"));
            $m = date("m",strtotime($i." day"));
        }
    }

    $day[] = $loc.$m."月".$d."日 (".$week_name[$w].")";
    $weatherData[] = $tenkArr[$i];
    if (strstr('0/',$kousArr[$i])) {
        $kousArr[$i] = str_replace('0/','0',$kousArr[$i]);
    }
    $forRain[] = $kousArr[$i]."%";
    $maxTemp[] = $maxArr[$i]."°C";
    $minTemp[] = $minArr[$i]."°C";
                /* $day = 日付
                 * $weatherData = 天気
                 * $forRain = 降水確率
                 * $maxTemp = 最高気温
                 * $minTemp = 最低気温
                 * $timestmp = 更新日時
                 * */
}
$messageData = [
    'type' => 'flex',
    'altText' => 'flexmessage',
    'contents' => [
        'type' => 'carousel',
        'contents' => [
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[0],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[0],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[0],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[0],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[0],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[1],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[1],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[1],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[1],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[1],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[2],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[2],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[2],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[2],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[2],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[3],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[3],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[3],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[3],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[3],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[4],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[4],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[4],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[4],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[4],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[5],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[5],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[5],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[5],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[5],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'type' => 'bubble',
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ],
                'body' => [
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => '週間天気予報',
                            'weight' => 'bold',
                            'color' => '#1DB446',
                            'size' => 'sm'
                        ],
                        [
                            'type' => 'text',
                            'text' => $day[6],
                            'weight' => 'bold',
                            'size' => 'xl',
                            'margin' => 'md'
                        ],
                        [
                            'type' => 'text',
                            'text' => '気象庁のデータを参照しています',
                            'size' => 'xs',
                            'color' => '#aaaaaa',
                            'wrap' => true
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'sm'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'margin' => 'sm',
                            'spacing' => 'xs',
                            'contents' => [
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'margin' => 'xxl',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '天気',
                                            'size' => 'xl',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $weatherData[6],
                                            'size' => 'xl',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '降水確率',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $forRain[6],
                                            'size' => 'sm',
                                            'color' => '#00008d',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最高気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $maxTemp[6],
                                            'size' => 'sm',
                                            'color' => '#ea5532',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '最低気温',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $minTemp[6],
                                            'size' => 'sm',
                                            'color' => '#00a497',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '更新日時',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $timestmp,
                                    'color' => '#aaaaaa',
                                    'size' => 'xs',
                                    'align' => 'end'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];