<?php

if ($text == 'じゃんけん') {
    $msgFlag = 1;

    $messageData = [
        'type' => 'text',
        'text' => 'じゃーんけーん'
    ];

    $messageData2 = [
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
                        'text' => 'どの手をだす？',
                        'weight' => 'bold',
                        'size' => 'xl'
                    ]
                ]
            ],
            'footer' => [
                'type' => 'box',
                'layout' => 'horizontal',
                'spacing' => 'sm',
                'contents' => [
                    [
                        'type' => 'button',
                        'style' => 'primary',
                        'height' => 'sm',
                        'action' => [
                            'type' => 'postback',
                            'label' => 'グー！',
                            'text' => 'グー！',
                            'data' => 'gcp:goo'
                        ]
                    ],
                    [
                        'type' => 'button',
                        'style' => 'primary',
                        'height' => 'sm',
                        'action' => [
                            'type' => 'postback',
                            'label' => 'チョキ！',
                            'text' => 'チョキ！',
                            'data' => 'gcp:cyoki'
                        ]
                    ],
                    [
                        'type' => 'button',
                        'style' => 'primary',
                        'height' => 'sm',
                        'action' => [
                            'type' => 'postback',
                            'label' => 'パー！',
                            'text' => 'パー！',
                            'data' => 'gcp:paa'
                        ]
                    ],
                    [
                        'type' => 'spacer',
                        'size' => 'sm'
                    ]
                ],
                'flex' => 0
            ]
        ]
    ];

} else {
    if (strstr($text,'gcp:')) {
        $text = substr($text, 4);
    }

    $bot_rslt = rand(0,2);


    if ($text == 'goo') {
        $usr_rslt = 0;
        $usr_text = 'グー';
    }
    if ($text == 'cyoki') {
        $usr_rslt = 1;
        $usr_text = 'チョキ';
    }
    if ($text == 'paa') {
        $usr_rslt = 2;
        $usr_text = 'パー';
    }

    if ($bot_rslt == 0) {
        $bot_text = 'グー';
    }
    if ($bot_rslt == 1) {
        $bot_text = 'チョキ';
    }
    if ($bot_rslt == 2) {
        $bot_text = 'パー';
    }

    if ($bot_rslt == $usr_rslt) {
        $msgFlag = 2;

        $messageData = [
            'type' => 'text',
            'text' => 'BOT:'.$bot_text.'あなた:'.$usr_text
        ];

        $messageData2 = [
            'type' => 'text',
            'text' => 'あーいこで'
        ];

        $messageData3 = [
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
                            'text' => '何を出す？',
                            'weight' => 'bold',
                            'size' => 'xl'
                        ]
                    ]
                ],
                'footer' => [
                'type' => 'box',
                'layout' => 'horizontal',
                'spacing' => 'sm',
                'contents' => [
                    [
                        'type' => 'button',
                        'style' => 'primary',
                        'height' => 'sm',
                        'action' => [
                            'type' => 'postback',
                            'label' => 'グー！',
                            'text' => 'gcp:goo',
                            'data' => 'empty'
                        ]
                    ],
                    [
                        'type' => 'button',
                        'style' => 'primary',
                        'height' => 'sm',
                        'action' => [
                            'type' => 'postback',
                            'label' => 'チョキ！',
                            'text' => 'gcp:cyoki',
                            'data' => 'empty'
                        ]
                    ],
                    [
                        'type' => 'button',
                        'style' => 'primary',
                        'height' => 'sm',
                        'action' => [
                            'type' => 'postback',
                            'label' => 'パー！',
                            'text' => 'gcp:paa',
                            'data' => 'empty'
                        ]
                    ],
                    [
                        'type' => 'spacer',
                        'size' => 'sm'
                    ]
                ],
                'flex' => 0
                ]
            ]
        ];

    } else {

    $win = 0;

    switch ($usr_rslt) {
        case 0:
            if ($bot_rslt == 1) {
                $win = 1;
            } else {
                $win = 2;
            }
            break;
        case 1:
            if ($bot_rslt == 2) {
                $win = 1;
            } else {
                $win = 2;
            }
            break;
        case 2:
            if ($bot_rslt == 0) {
                $win = 1;
            } else {
                $win = 2;
            }
            break;
    }

    if ($win == 1) {
        $msgFlag = 2;
        $messageData = [
            'type' => 'text',
            'text' => 'BOT:'.$bot_text.'あなた:'.$usr_text
        ];
        $messageData2 = [
            'type' => 'text',
            'text' => 'YOU WIN'
        ];
        $messageData3 = [
            'type' => 'text',
            'text' => 'やるやん。明日俺にリベンジさせて。'
        ];
    } else {
        $msgFlag = 2;
        $messageData = [
            'type' => 'text',
            'text' => 'BOT:'.$bot_text.'あなた:'.$usr_text
        ];
        $messageData2 = [
            'type' => 'text',
            'text' => 'YOU LOSE'
        ];
        $messageData3 = [
            'type' => 'text',
            'text' => '俺の勝ち！
何で負けたか、明日まで考えといてください。
そしたら何かが見えてくるはずです。'
        ];
    }
}
}


srand();