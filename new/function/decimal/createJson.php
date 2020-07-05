<?php
function createFlex($base, $color_arr, $two_d, $eig_d, $ten_d, $sit_d) {
  $flex_data =
  [
    "type" => "bubble",
    "body" => [
      "type" => "box",
      "layout" => "vertical",
      "contents" => [
        [
          "type" => "text",
          "text" => $base." 進数の値を変換",
          "weight" => "bold",
          "size" => "xl",
          "margin" => "md"
        ],
        [
          "type" => "text",
          "text" => "コピーしたい数値をタップ",
          "size" => "xs"
        ],
        [
          "type" => "separator",
          "margin" => "sm"
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "margin" => "sm",
          "spacing" => "xs",
          "contents" => [
            [
              "type" => "filler"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "margin" => "sm",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "2 進数",
                  "size" => "sm",
                  "color" => "#000000",
                  "align" => "center",
                  "gravity" => "center",
                  "flex" => 0
                ],
                [
                  "type" => "text",
                  "size" => "lg",
                  "color" => "#111111",
                  "align" => "end",
                  "text" => "$two_d"
                ]
              ],
              "backgroundColor" => "$color_arr[0]",
              "action" => [
                "type" => "message",
                "label" => "$two_d",
                "text" => "$two_d"
              ]
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "8 進数",
                  "size" => "sm",
                  "color" => "#000000",
                  "align" => "center",
                  "gravity" => "center",
                  "flex" => 0
                ],
                [
                  "type" => "text",
                  "text" => "$eig_d",
                  "size" => "lg",
                  "color" => "#111111",
                  "align" => "end"
                ]
              ],
              "backgroundColor" => "$color_arr[1]",
              "margin" => "md",
              "action" => [
                "type" => "message",
                "label" => "$eig_d",
                "text" => "$eig_d"
              ]
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "10 進数",
                  "size" => "sm",
                  "color" => "#000000",
                  "align" => "center",
                  "gravity" => "center",
                  "flex" => 0
                ],
                [
                  "type" => "text",
                  "text" => "$ten_d",
                  "size" => "lg",
                  "color" => "#111111",
                  "align" => "end"
                ]
              ],
              "backgroundColor" => "$color_arr[2]",
              "margin" => "md",
              "action" => [
                "type" => "message",
                "label" => "$ten_d",
                "text" => "$ten_d"
              ]
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "16 進数",
                  "size" => "sm",
                  "color" => "#000000",
                  "align" => "center",
                  "gravity" => "center",
                  "flex" => 0
                ],
                [
                  "type" => "text",
                  "text" => "$sit_d",
                  "size" => "lg",
                  "color" => "#111111",
                  "align" => "end"
                ]
              ],
              "backgroundColor" => "$color_arr[3]",
              "margin" => "md",
              "action" => [
                "type" => "message",
                "label" => "$sit_d",
                "text" => "$sit_d"
              ]
            ]
          ]
        ],
        [
          "type" => "separator",
          "margin" => "md"
        ]
      ]
    ]
  ];

  return $flex_data;
}