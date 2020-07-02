<?php
function createFlex($ts, $t_arr, $c_arr, $r_arr, $max_arr, $min_arr) {
  for ($i = 0;$i < 7;$i++) {
    $flex_temp = file_get_contents(__DIR__.'/flextemp.txt');
    $flex = str_replace('TIMESTAMP', $ts, $flex_temp);
    $flex = str_replace('TITLE', $t_arr[$i], $flex);
    $flex = str_replace('CLIMATE', $c_arr[$i], $flex);
    $flex = str_replace('RAIN', $r_arr[$i], $flex);
    $flex = str_replace('MAXTEMP', $max_arr[$i], $flex);
    $flex = str_replace('MINTEMP', $min_arr[$i], $flex);
    $flex = file_put_contents(__DIR__.'/flex'.$i.'.php',$flex);
    require_once(__DIR__.'/flex'.$i.'.php');
    $flex_contents[] = $flex_temp;
    unlink(__DIR__.'/flex'.$i.'.php');
  }

  $flex_data = [
    'type' => 'flex',
    'altText' => '週間天気予報',
    'contents' => [
        'type' => 'carousel',
        'contents' => $flex_contents
    ]
  ];

  return $flex_data;
}