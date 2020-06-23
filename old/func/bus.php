<?php
    date_default_timezone_set('Asia/Tokyo');
//現在の時間
    $hours = date("H");
    $timestamp = date("y-m-d");

    function searchTimetable($file,$hours) {
        //phpQuery読み込み
        require_once dirname(__FILE__).'/phpQuery-onefile.php';


        $html = file_get_contents($file);
        $doc = phpQuery::newDocument($html);

        $timeListFrame = pq($doc)->find('dl.time-list-frame');

        $time = $timeListFrame->find('span.time')->text();

        $time_arr = explode("\n",$time);

        $hours_arr = preg_grep("/".$hours.":/",$time_arr);

        return $hours_arr;
    }

    $kudu = '京阪樟葉駅';
    $naga = 'JR長尾駅';
    $kita = '北山中央';

//京阪樟葉駅 => 北山中央
    if ($txt == 'bus:kuduha->kitayama' || $txt == '今くき') {
        $htmlFile = 'https://www.navitime.co.jp/bus/diagram/timelist?departure=00046521&arrival=00046541&line=00013539&date='.$timestamp;
        $timeTable_arr = searchTimetable($htmlFile,$hours);

        $busSt = $kudu;
        $busEn = $kita;
    }

//北山中央 => 京阪樟葉駅
    elseif ($txt == 'bus:kitayama->kuduha' || $txt == '今きく') {
        $htmlFile = 'https://www.navitime.co.jp/bus/diagram/timelist?departure=00046541&arrival=00046521&line=00013539&date='.$timestamp;
        $timeTable_arr = searchTimetable($htmlFile,$hours);

        $busSt = $kita;
        $busEn = $kudu;
    }

//JR長尾駅 => 北山中央
    elseif ($txt == 'bus:nagao->kitayama' || $txt == '今なき') {
        $htmlFile = 'https://www.navitime.co.jp/bus/diagram/timelist?departure=00046618&arrival=00046541&line=00013845&date='.$timestamp;
        $timeTable_arr = searchTimetable($htmlFile,$hours);

        $busSt = $naga;
        $busEn = $kita;
    }

//北山中央 => JR長尾駅
    elseif ($txt == 'bus:kitayama->nagao' || $txt == '今きな') {
        $htmlFile = 'https://www.navitime.co.jp/bus/diagram/timelist?departure=00046541&arrival=00046618&line=00013845&date='.$timestamp;
        $timeTable_arr = searchTimetable($htmlFile,$hours);

        $busSt = $kita;
        $busEn = $naga;
    }

    /**JSON置き換えターゲット
     * JOSYA    乗車バス停名
     * GESYA    下車バス停名
     * STH      何時から
     * ENH      何時まで
     */
    $busJson = file_get_contents(dirname(__FILE__).'/flexMsg/bus.json');

    $busJson = str_replace('JOSYA',$busSt,$busJson);
    $busJson = str_replace('GESYA',$busEn,$busJson);

    $hkHan = '平日';
    if (date("N") >= 6) {
        $hkHan = '休日';

    }
    $busJson = str_replace('HEIKYU',$hkHan,$busJson);
    $busJson = str_replace('STH',$hours,$busJson);
    $busJson = str_replace('ENH',($hours+1),$busJson);

    $busJson = json_decode($busJson,true);


    $timeCnt = count($timeTable_arr);

    for ($i=0;$i<$timeCnt;$i++) {

        if ($i % 2 == 0) {

            $boxCon[] = [
                'type' => 'text',
                'text' => array_shift($timeTable_arr),
                'size' => 'xxl',
                'color' => '#333333',
                'align' => 'end'
            ];

            $boxCon[] = [
                'type' => 'text',
                'text' => '発',
                'size' => 'md',
                'color' => '#333333',
                'flex' => 0,
                'gravity' => 'bottom',
            ];

        } else {
            $boxCon[] = [
                'type' => 'text',
                'text' => array_shift($timeTable_arr),
                'size' => 'xl',
                'color' => '#333333',
                'gravity' => 'bottom',
                'align' => 'end'
            ];

            $boxCon[] = [
                'type' => 'text',
                'text' => '着',
                'size' => 'md',
                'color' => '#333333',
                'gravity' => 'bottom',
                'flex' => 0
            ];

            $busJson['body']['contents'][] = [
                'type' => 'box',
                'layout' => 'vertical',
                'margin' => 'md',
                'spacing' => 'sm',
                'contents' => [
                    [
                        'type' => 'box',
                        'layout' => 'horizontal',
                        'contents' => $boxCon
                    ]
                ]
            ];
            $boxCon = array();
            $busJson['body']['contents'][] = [
                'type' => 'separator',
                'margin' => 'xs',
                'color' => '#aaaaaa'
            ];
        }



    }

    $msgData = [
        'type' => 'flex',
        'altText' => '地域選択',
        'contents' => $busJson
    ];
