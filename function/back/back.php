<?php
function back() {
    $json = file_get_contents(__DIR__.'/json/back.json');
    $arr = json_decode($json,true);
    
    $flex = [
        'type' => 'flex',
            'altText' => 'もどる',
            'contents' => $arr
    ];

    return $flex;
}
