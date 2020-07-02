<?php
$flex_temp = <<<EOF
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
              'text' => 'TITLE',
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
                              'text' => 'CLIMATE',
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
                              'text' => 'RAIN',
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
                              'text' => 'MAXTEMP',
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
                              'text' => 'MINTEMP',
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
                      'text' => 'TIMESTAMP',
                      'color' => '#aaaaaa',
                      'size' => 'xs',
                      'align' => 'end'
                  ]
              ]
          ]
      ]
  ]
],

EOF;

function createFlex($ts, $t_arr, $c_arr, $r_arr, $max_arr, $min_arr) {
  global $flex_temp;

  //初期化
  $flex_contents = '';

  for ($i = 0;$i < 7;$i++) {
    $flex = str_replace('TIMESTAMP', $ts, $flex_temp);
    $flex = str_replace('TITLE', $t_arr[$i], $flex);
    $flex = str_replace('CLIMATE', $c_arr[$i], $flex);
    $flex = str_replace('RAIN', $r_arr[$i], $flex);
    $flex = str_replace('MAXTEMP', $max_arr[$i], $flex);
    $flex = str_replace('MINTEMP', $min_arr[$i], $flex);
    $flex_contents .= $flex;
  }

  $flex_data = [
    'type' => 'flex',
    'altText' => '週間天気予報',
    'contents' => [
        'type' => 'carousel',
        'contents' => [$flex_contents]
    ]
  ];

  return $flex_data;
}