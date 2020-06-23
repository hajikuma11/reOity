<?php
//***交通機関選択**************************************************************************************************************************************************************************
if ($text == '時刻' or $text == 'じこく') {

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
                            'text' => '交通機関を選択',
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
                                            'text' => '一定の時間ごとの時刻表を表示します',
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
                    'layout' => 'horizontal',
                    'spacing' => 'sm',
                    'contents' => [
                        [
                            'type' => 'button',
                            'style' => 'primary',
                            'height' => 'sm',
                            'action' => [
                                'type' => 'postback',
                                'label' => 'バス',
                                'text' => 'バス',
                                'data' => 'empty'
                            ]
                        ],
                        [
                            'type' => 'button',
                            'style' => 'primary',
                            'height' => 'sm',
                            'action' => [
                                'type' => 'postback',
                                'label' => '電車',
                                'text' => '電車',
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

}

//***電車の駅選択**************************************************************************************************************************************************************************
elseif ($text == 'Train' or $text == '電車' or $text == 'train') {

    $messageData = [
        'type' => 'template',
        'altText' => '駅選択',
        'template' => [
            'type' => 'buttons',
            'title' => '発車駅',
            'text' => 'どこ発？',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => '長尾駅発',

                    'text' => 'NagaoSt',
                    'data' => 'value'
                ],
                [
                    'type' => 'postback',
                    'label' => '京橋駅発',

                    'text' => 'KyobashiSt',
                    'data' => 'value'
                ],
                [
                    'type' => 'postback',
                    'label' => '楠葉駅発(未実装)',

                    'text' => 'KuzuhaSt',
                    'data' => 'value'
                ]
            ]
        ]
    ];
}

//***京橋発長尾方面**************************************************************************************************************************************************************************
elseif ($text == 'KyobashiSt' or $text == '京橋発' or $text == '京橋から') {

  $messageData = [
      'type' => 'template',
      'altText' => '時間帯選択',
      'template' => [
          'type' => 'buttons',
          'title' => '京橋発松井山手・木津方面',
          'text' => '何時くらい？',
          'actions' => [
                      [
                          'type' => 'postback',
                          'label' => '６～８時',
                          'text' => '6~8kh',
                          'data' => 'value'
                      ],
                      [
                          'type' => 'postback',
                          'label' => '９～１１時',
                          'text' => '9~11kh',
                          'data' => 'value'
                      ],
                      [
                          'type' => 'postback',
                          'label' => '１２～１４時',
                          'text' => '12~14kh',
                          'data' => 'value'
                      ],
                      [
                          'type' => 'postback',
                          'label' => 'それ以降の時刻',
                          'text' => 'kh2',
                          'data' => 'value'
                      ]
          ]
      ]
  ];
}
elseif ($text == 'kh2') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '京橋発松井山手・木津方面',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '１５～１７時',
                            'text' => '15~17kh',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１８～２０時',
                            'text' => '18~20kh',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '２１～２４時',
                            'text' => '21~24kh',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}

//***長尾駅の向き**************************************************************************************************************************************************************************
elseif ($text == 'NagaoSt' or $text == '長尾駅発') {

    $messageData = [
        'type' => 'template',
        'altText' => '向き選択',
        'template' => [
            'type' => 'buttons',
            'title' => '方面を選択',
            'text' => 'どっち方面？',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => '松井山手・木津方面',

                    'text' => '木津方面',
                    'data' => 'value'
                ],
                [
                    'type' => 'postback',
                    'label' => '京橋方面',

                    'text' => '京橋方面',
                    'data' => 'value'
                ]
            ]
        ]
    ];
}

//***バスの行き先選択***********************************************************************************************************************************************************************
elseif ($text == 'Localbus' or $text == 'バス' or $text == 'bus') {

    $messageData = [
        'type' => 'template',
        'altText' => 'バス行先選択',
        'template' => [
            'type' => 'buttons',
            'title' => 'バスの行き先',
            'text' => 'どこからどこ行き？',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => '北山中央　→→　長尾駅',

                    'text' => 'goNag',
                    'data' => 'value'
                ],
                [
                    'type' => 'postback',
                    'label' => '　長尾駅　→→　北山中央',

                    'text' => 'goKita',
                    'data' => 'value'
                ],
                [
                    'type' => 'postback',
                    'label' => '　楠葉駅　→→　北山中央',

                    'text' => 'goKitafK',
                    'data' => 'value'
                ],
                [
                    'type' => 'postback',
                    'label' => '北山中央　→→　樟葉駅',

                    'text' => 'goKuz',
                    'data' => 'value'
                ]
            ]
        ]
    ];
}

//***北山中央から長尾駅行き時間帯選択*******************************************************************************************************************************************************************
elseif ($text == 'goNag') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '北山中央→→→長尾駅',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '９～１１時',
                            'text' => '9~11bd',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１２～１４時',
                            'text' => '12~14bd',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => 'それ以降の時刻',
                            'text' => 'goNag2',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}
elseif ($text == 'goNag2') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '北山中央→→→長尾駅',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '１５～１７時',
                            'text' => '15~17bd',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１８～２０時',
                            'text' => '18~20bd',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '２１時',
                            'text' => '21bd',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}

//***長尾駅から北山中央行き時間帯選択******************************************************************************************************************************************************************
elseif ($text == 'goKita') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '長尾駅→→→北山中央',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '６～８時',
                            'text' => '6~8bu',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '９～１１時',
                            'text' => '9~11bu',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１２～１４時',
                            'text' => '12~14bu',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => 'それ以降の時刻',
                            'text' => 'goKita2',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}
elseif ($text == 'goKita2') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '長尾駅→→→北山中央',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '１５～１７時',
                            'text' => '15~17bu',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１８～２０時',
                            'text' => '18~20bu',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '２１時',
                            'text' => '21bu',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}

//***北山中央から楠葉駅行き時間帯選択*******************************************************************************************************************************************************************
elseif ($text == 'goKuz') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '北山中央→→→楠葉駅',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '１０～１１時',
                            'text' => '10~11kk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１２～１４時',
                            'text' => '12~14kk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => 'それ以降の時刻',
                            'text' => 'goKuz2',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}
elseif ($text == 'goKuz2') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '北山中央→→→楠葉駅',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '１５～１７時',
                            'text' => '15~17kk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１８～２０時',
                            'text' => '18~20kk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '２１時～２３時',
                            'text' => '21~24kk',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}

//***楠葉駅から北山中央行き時間帯選択******************************************************************************************************************************************************************
elseif ($text == 'goKitafK') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '楠葉駅→→→北山中央',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '６～８時',
                            'text' => '6~8fk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '９～１１時',
                            'text' => '9~11fk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１２～１４時',
                            'text' => '12~14fk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => 'それ以降の時刻',
                            'text' => 'goKitafK2',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}
elseif ($text == 'goKitafK2') {

    $messageData = [
        'type' => 'template',
        'altText' => '時間帯選択',
        'template' => [
            'type' => 'buttons',
            'title' => '楠葉駅→→→北山中央',
            'text' => '何時くらい？',
            'actions' => [
                        [
                            'type' => 'postback',
                            'label' => '１５～１７時',
                            'text' => '15~17fk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '１８～２０時',
                            'text' => '18~20fk',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => '２１時～２３時',
                            'text' => '21~23fk',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}
