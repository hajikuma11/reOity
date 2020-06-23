<?php
if ($text == '19991111') {

    $messageData = [
        'type' => 'template',
        'altText' => 'selectstep',
        'template' => [
            'type' => 'buttons',
            'title' => 'SelectCode',
            'text' => 'ALL_READY',
            'actions' => [
                        [
                            'type' => 'postback',
                            'style' => 'primary',
                            'label' => 'Weather',
                            'text' => ':weathK&K:',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'postback',
                            'label' => 'Uschedule',
                            'text' => ':UsheH&H:',
                            'data' => 'value'
                        ]
            ]
        ]
    ];
}

elseif ($text == ':weathK&K:') {

    $messageData = [
        'type' => 'template',
        'altText' => 'SelectWeath',
        'template' => [
            'type' => 'buttons',
            'title' => 'ForecastWeath',
            'text' => 'Where？',
            'actions' => [
                [
                    'type' => 'uri',
                    'label' => '『Kawachinagano』',
                    'uri' => 'https://goo.gl/SDVp4x'
                ],
                [
                    'type' => 'uri',
                    'label' => '『Kobe』',
                    'uri' => 'https://goo.gl/ZAHEuF'
                ]
            ]
        ]
    ];
}

elseif ($text == 'userid') {
$messageData = [
   'type' => 'text',
   'text' => $userID
];
}

elseif ($text == 'quickreply') {
$messageData = [
    'type' => 'text',
    'text' => 'うまくできとるかいな？',
    'quickReply' => [
        'items' => [
            [
            'type' => 'action',
            'action' => [
              'type' => 'message',
              'label' => 'はい',
              'text' => 'はい'
                ]
            ],
            [
            'type' => 'action',
            'action' => [
              'type' => 'message',
              'label' => 'いいえ',
              'text' => 'いいえ'
                ]
            ]
        ]
    ]
];
}