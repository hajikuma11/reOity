<?php
function createFlex($ip_addr,$subnetmask,$network_addr,$host_addr_arr,$broadcast_addr,$ip_class) {
  $flex_contents =
  [
    "type" => "bubble",
    "body" => [
      "type" => "box",
      "layout" => "vertical",
      "contents" => [
        [
          "type" => "text",
          "text" => "計算結果",
          "size" => "lg"
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "contents" => [
            [
              "type" => "separator",
              "color" => "#000000"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "IPアドレス",
                  "size" => "xs"
                ]
              ],
              "backgroundColor" => "#dddddd",
              "justifyContent" => "center"
            ],
            [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "text",
                  "text" => $ip_addr,
                  "weight" => "bold"
                ]
              ],
              "justifyContent" => "center",
              "paddingStart" => "sm"
            ]
          ]
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "contents" => [
            [
              "type" => "separator",
              "color" => "#000000"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "サブネットマスク",
                  "size" => "xs"
                ]
              ],
              "backgroundColor" => "#dddddd",
              "justifyContent" => "center"
            ],
            [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "/".$subnetmask,
                  "weight" => "bold"
                ]
              ],
              "justifyContent" => "center",
              "paddingStart" => "sm"
            ]
          ],
          "margin" => "sm"
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "contents" => [
            [
              "type" => "separator",
              "color" => "#000000"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "ネットワークアドレス",
                  "size" => "xs"
                ]
              ],
              "backgroundColor" => "#dddddd",
              "justifyContent" => "center"
            ],
            [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "text",
                  "text" => $network_addr,
                  "weight" => "bold"
                ]
              ],
              "justifyContent" => "center",
              "paddingStart" => "sm"
            ]
          ],
          "margin" => "sm"
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "contents" => [
            [
              "type" => "separator",
              "color" => "#000000"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "ホストアドレス",
                  "size" => "xs"
                ]
              ],
              "backgroundColor" => "#dddddd",
              "justifyContent" => "center"
            ],
            [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "text",
                  "text" => $host_addr_arr[0]." ~ ".$host_addr_arr[1],
                  "weight" => "bold"
                ]
              ],
              "justifyContent" => "center",
              "paddingStart" => "sm"
            ]
          ],
          "margin" => "sm"
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "contents" => [
            [
              "type" => "separator",
              "color" => "#000000"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "ブロードキャストアドレス",
                  "size" => "xs"
                ]
              ],
              "backgroundColor" => "#dddddd",
              "justifyContent" => "center"
            ],
            [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "text",
                  "text" => $broadcast_addr,
                  "weight" => "bold"
                ]
              ],
              "justifyContent" => "center",
              "paddingStart" => "sm"
            ]
          ],
          "margin" => "sm"
        ],
        [
          "type" => "box",
          "layout" => "vertical",
          "contents" => [
            [
              "type" => "separator",
              "color" => "#000000"
            ],
            [
              "type" => "box",
              "layout" => "horizontal",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "IPアドレスクラス",
                  "size" => "xs"
                ]
              ],
              "backgroundColor" => "#dddddd",
              "justifyContent" => "center"
            ],
            [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "text",
                  "text" => "クラス".$ip_class,
                  "weight" => "bold"
                ]
              ],
              "justifyContent" => "center",
              "paddingStart" => "sm"
            ]
          ],
          "margin" => "sm"
        ]
      ]
    ]
  ];

  $flex_data = [
    'type' => 'flex',
    'altText' => 'サブネット計算',
    'contents' => $flex_contents
  ];

  return $flex_data;
}