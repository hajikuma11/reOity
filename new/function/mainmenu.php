{
  "type": "bubble",
  "size": "mega",
  "header": {
    "type": "box",
    "layout": "vertical",
    "contents": [
      {
        "type": "text",
        "text": "> どの機能を使いますか？",
        "align": "start",
        "weight": "bold"
      }
    ],
    "paddingAll": "10px"
  },
  "body": {
    "type": "box",
    "layout": "vertical",
    "contents": [
      {
        "type": "box",
        "layout": "vertical",
        "contents": [
          {
            "type": "box",
            "layout": "vertical",
            "contents": [
              {
                "type": "text",
                "text": "週間天気予報",
                "color": "#F5F5F5",
                "size": "xl",
                "flex": 4,
                "weight": "bold",
                "style": "normal",
                "decoration": "none",
                "align": "center",
                "gravity": "bottom"
              }
            ],
            "backgroundColor": "#00A0E9",
            "paddingAll": "10px",
            "cornerRadius": "45px",
            "borderWidth": "2px",
            "borderColor": "#ffffff",
            "action": {
              "type": "postback",
              "label": "週間天気予報",
              "data": "weather=>",
              "displayText": "週間天気予報を使う"
            }
          },
          {
            "type": "box",
            "layout": "vertical",
            "contents": [
              {
                "type": "text",
                "text": "バス時刻表",
                "color": "#F5F5F5",
                "size": "xl",
                "flex": 4,
                "weight": "bold",
                "style": "normal",
                "decoration": "none",
                "align": "center",
                "gravity": "bottom"
              }
            ],
            "backgroundColor": "#00A0E9",
            "paddingAll": "10px",
            "cornerRadius": "45px",
            "borderWidth": "2px",
            "borderColor": "#ffffff",
            "margin": "lg",
            "action": {
              "type": "postback",
              "label": "バス時刻表",
              "data": "bus=>",
              "displayText": "バス時刻表機能を使う"
            }
          }
        ]
      },
      {
        "type": "box",
        "layout": "horizontal",
        "contents": [
          {
            "type": "box",
            "layout": "vertical",
            "contents": [
              {
                "type": "text",
                "text": "進数変換",
                "align": "center",
                "gravity": "bottom",
                "decoration": "none",
                "style": "normal",
                "size": "lg",
                "color": "#F5F5F5",
                "weight": "bold"
              }
            ],
            "borderColor": "#ffffff",
            "borderWidth": "2px",
            "cornerRadius": "45px",
            "paddingAll": "5px",
            "backgroundColor": "#00A0E9",
            "action": {
              "type": "postback",
              "label": "進数変換",
              "data": "decimal=>",
              "displayText": "進数変換機能を使う"
            }
          },
          {
            "type": "separator",
            "margin": "md",
            "color": "#ffffff"
          },
          {
            "type": "box",
            "layout": "vertical",
            "contents": [
              {
                "type": "text",
                "text": "じゃんけん",
                "align": "center",
                "gravity": "bottom",
                "decoration": "none",
                "style": "normal",
                "weight": "bold",
                "size": "lg",
                "color": "#F5F5F5"
              }
            ],
            "borderColor": "#ffffff",
            "borderWidth": "2px",
            "cornerRadius": "45px",
            "paddingAll": "5px",
            "margin": "md",
            "backgroundColor": "#00A0E9",
            "action": {
              "type": "postback",
              "label": "じゃんけん",
              "data": "janken=>",
              "displayText": "じゃんけん！"
            }
          }
        ],
        "margin": "lg"
      }
    ],
    "backgroundColor": "#0367D3",
    "paddingStart": "20px",
    "paddingEnd": "20px",
    "paddingTop": "10px",
    "paddingBottom": "10px"
  }
}