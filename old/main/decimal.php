<?php
/**
 * 文字列を識別できるように処理
 */
$pos = strpos($text,'数');
$s_text = substr($text,$pos+3);


/**
 * メイン
 */
$two = "2進数";
$eig = "8進数";
$ten = "10進数";
$sixt = "16進数";

if ($s_text >= 1) {
    if (strstr($s_text,'.')) {
        $messageData = [
            'type' => 'text',
            'text' => "エラー\n1以上の小数点形式には対応していません。\n'2'or'10'進数0.'～～'\nのように入力してください"
        ];
    } else {
        /**
         * 2進数から変換
         */
        if (strstr($text,'2進数')) {
            $number = 2;
            $two = "元の値:".$two;
            $twodata =$s_text;
            $tendata =bindec($s_text);
            $eigdata =decoct($tendata);
            $sixtdata =dechex($tendata);

            $messageData = [
                'type' => 'flex',
                'altText' => $number.'進数から変換',
                'contents' => [
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
                                'text' => $number.'進数の値を変換',
                                'weight' => 'bold',
                                'size' => 'xl',
                                'margin' => 'md'
                            ],
                            [
                                'type' => 'text',
                                'text' => $number.'進数の値をほかの進数の値に変換します',
                                'size' => 'xs',
                                'color' => '#555555',
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
                                                'text' => "$two",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$twodata",
                                                'size' => 'md',
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
                                                'text' => "$eig",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$eigdata",
                                                'size' => 'md',
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
                                                'text' => "$ten",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$tendata",
                                                'size' => 'md',
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
                                                'text' => "$sixt",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$sixtdata",
                                                'size' => 'md',
                                                'color' => '#111111',
                                                'align' => 'end'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'separator',
                                'margin' => 'xs'
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'margin' => 'md',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '注意 =>大きすぎる値は対応していません',
                                        'size' => 'xs',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }
        /**
         * 8進数から変換
         */
        elseif (strstr($text,'8進数')) {
            $number = 8;
            $eig = "元の値:".$eig;
            $eigdata =$s_text;
            $tendata =octdec($s_text);
            $twodata =decbin($tendata);
            $sixtdata =dechex($tendata);

            $messageData = [
                'type' => 'flex',
                'altText' => $number.'進数から変換',
                'contents' => [
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
                                'text' => $number.'進数の値を変換',
                                'weight' => 'bold',
                                'size' => 'xl',
                                'margin' => 'md'
                            ],
                            [
                                'type' => 'text',
                                'text' => $number.'進数の値をほかの進数の値に変換します',
                                'size' => 'xs',
                                'color' => '#555555',
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
                                                'text' => "$two",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$twodata",
                                                'size' => 'md',
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
                                                'text' => "$eig",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$eigdata",
                                                'size' => 'md',
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
                                                'text' => "$ten",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$tendata",
                                                'size' => 'md',
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
                                                'text' => "$sixt",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$sixtdata",
                                                'size' => 'md',
                                                'color' => '#111111',
                                                'align' => 'end'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'separator',
                                'margin' => 'xs'
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'margin' => 'md',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '注意 =>大きすぎる値は対応していません',
                                        'size' => 'xs',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }
        /**
         * 16進数から変換
         */
        elseif (strstr($text,'16進数')) {
            $number = 16;
            $sixt = "元の値:".$sixt;
            $sixtdata =$s_text;
            $tendata =hexdec($s_text);
            $twodata =decbin($tendata);
            $eigdata =decoct($tendata);

            $messageData = [
                'type' => 'flex',
                'altText' => $number.'進数から変換',
                'contents' => [
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
                                'text' => $number.'進数の値を変換',
                                'weight' => 'bold',
                                'size' => 'xl',
                                'margin' => 'md'
                            ],
                            [
                                'type' => 'text',
                                'text' => $number.'進数の値をほかの進数の値に変換します',
                                'size' => 'xs',
                                'color' => '#555555',
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
                                                'text' => "$two",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$twodata",
                                                'size' => 'md',
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
                                                'text' => "$eig",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$eigdata",
                                                'size' => 'md',
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
                                                'text' => "$ten",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$tendata",
                                                'size' => 'md',
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
                                                'text' => "$sixt",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$sixtdata",
                                                'size' => 'md',
                                                'color' => '#111111',
                                                'align' => 'end'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'separator',
                                'margin' => 'xs'
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'margin' => 'md',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '注意 =>大きすぎる値は対応していません',
                                        'size' => 'xs',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }
        /**
         * 10進数から変換
         */
        elseif (strstr($text,'進数') or strstr($text,'10進数')) {
            $number = 10;
            $ten = "元の値:".$ten;
            $tendata =$s_text;
            $twodata =decbin($s_text);
            $eigdata =decoct($s_text);
            $sixtdata =dechex($s_text);

            $messageData = [
                'type' => 'flex',
                'altText' => $number.'進数から変換',
                'contents' => [
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
                                'text' => $number.'進数の値を変換',
                                'weight' => 'bold',
                                'size' => 'xl',
                                'margin' => 'md'
                            ],
                            [
                                'type' => 'text',
                                'text' => $number.'進数の値をほかの進数の値に変換します',
                                'size' => 'xs',
                                'color' => '#555555',
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
                                                'text' => "$two",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$twodata",
                                                'size' => 'md',
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
                                                'text' => "$eig",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$eigdata",
                                                'size' => 'md',
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
                                                'text' => "$ten",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$tendata",
                                                'size' => 'md',
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
                                                'text' => "$sixt",
                                                'size' => 'sm',
                                                'color' => '#000000'
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => "$sixtdata",
                                                'size' => 'md',
                                                'color' => '#111111',
                                                'align' => 'end'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'separator',
                                'margin' => 'xs'
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'margin' => 'md',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '注意 =>大きすぎる値は対応していません',
                                        'size' => 'xs',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }

    }
} else {

    $data = $s_text;
    $cnt = 0;

    if (strstr($text,'10進数')) {

        $val = '0.';
        while ($data != 0 && $cnt <= 15) {
            $data = $data * 2;
            if ($data >= 1) {
                $val .= '1';
                $data = $data - 1;
            } else {
                $val .= '0';
            }
            $cnt++;
        }
        $messageData = [
            'type' => 'text',
            'text' => "[2]$val"
        ];

    } elseif (strstr($text,'2進数')) {
        if (strlen($s_text) > 15) {
            $reData = '111111111111111111111';
        } else {
            $reData = 0;
            for ($i=1;$i<=strlen(substr($s_text,2));$i++) {
                if ($s_text[$i+1] == 1) {
                    $sum2 = 1;
                    for ($j=0;$j<$i;$j++) {
                        $sum2 = $sum2 / 2;
                    }
                    $reData += $sum2;
                }
            }
            $messageData = [
                'type' => 'text',
                'text' => "[10]$reData"
            ];
        }
    } else {
        $messageData = [
            'type' => 'text',
            'text' => "エラー\n2進数'0.～'\n10進数'0.～'\nの2種類が対応しています。"
        ];
    }

}

if (strlen($val) > 15 || strlen($reData) > 15) {
    $messageData = [
        'type' => 'text',
        'text' => "申し訳ありません。\n正確な計算が不可能です。"
    ];
}
