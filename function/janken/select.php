<?php
function select() {
  $sel_json = file_get_contents(__DIR__.'/json/select.json');
  $sel_arr = json_decode($sel_json,true);
  
  $flex_sel = [
    'type' => 'flex',
          'altText' => 'じゃんけん選択肢',
          'contents' => $sel_arr
  ];

  return $flex_sel;
}