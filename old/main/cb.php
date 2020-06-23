<?php
//phpQuery読み込み
require_once __DIR__.'/phpQuery-onefile.php';

//メッセージを扱えるように処理
if (strstr($text,"cb:")) {
    $text = substr($text,3);
}
if (strstr($text,'草:')) {
    $text = mb_substr($text,2);
}

//contributionのURLを指定
$url = 'https://github.com/users/'.$text.'/contributions';

//phpQueryの処理
$html = file_get_contents($url);
$doc = phpQuery::newDocument($html);
$confirm = $doc['h2']->text();

//もしアカウントがなければ
if ($confirm[0] == '') {

    $messageData = [
        'type' => 'text',
        'text' => "GitHubアカウントが\n見つかりません"
    ];

}

//アカウントがあるなら
else {

    //contribution数の処理
    $trmcon = trim($confirm);

    $consArr = explode(' ',$trmcon);

    $user_cbs_val = $consArr[0];

    //JSON形成
    $cbjson = file_get_contents(__DIR__."/flexJson/cb.json");
    $cbjson = str_replace('CB_YOUR_ID',$text,$cbjson);
    $cbjson = str_replace('CB_CON_VALUE',$user_cbs_val,$cbjson);
    $cbjson = json_decode($cbjson,true);

    //草の処理
    $contents = $doc["g"];
    $cnt = 0;
    $pushcnt = 1;
    $daycnt = 0;
    $fill = array();
    $nowdate = date('w') + 1;
    $vertical_origin = [

        'type' => 'box',
        'layout' => 'horizontal',
        'margin' => 'xs',
        'contents' => [

            [
                'type' => 'box',
                'layout' => 'vertical',
                'margin' => 'xs',
                'contents' => [
                    'text' => 'text'
                ]
            ]
        ]
    ];
    array_pop($vertical_origin['contents'][0]['contents']);

    $vertical = $vertical_origin;

    //草の数の配列を作成
    foreach ($contents as $val) {
        $val = pq($val);
        foreach ($val as $gtag) {
            if ($cnt != 0) {
                $gtag = pq($gtag)->find('rect');
                foreach ($gtag as $rect) {
                    if ($pushcnt <= 366 + $nowdate && $pushcnt > 308 + $nowdate) {
                        $fill_data = pq($rect)->attr('fill');

                        if ($daycnt == 7) {

                            $cbjson["body"]["contents"][7]["contents"][] = $vertical;

                            $daycnt = 0;
                            $vertical = $vertical_origin;

                            $cbjson["body"]["contents"][7]["contents"][] = ['type' => 'separator','margin' => 'xs'];
                        }

                        $ins_val = [
                            'type' => 'text',
                            'text' => '▮',
                            'size' => 'sm',
                            'color' => $fill_data,
                            'align' => 'center'
                        ];

                        $vertical['contents'][0]['contents'][] = $ins_val;

                        ++$daycnt;
                    }

                    ++$pushcnt;
                }
            } else {
                $cnt++;
            }
        }
    }

    $cbjson["body"]["contents"][7]["contents"][] = $vertical;

    $messageData = [
        'type' => 'flex',
        'altText' => '草の図',
        'contents' => $cbjson
    ];
    
}

