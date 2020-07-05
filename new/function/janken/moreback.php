<?php
function moreback() {
  $json = file_get_contents(__DIR__.'/json/moreback.json');
  $arr = json_decode($json,true);
  
  $flex = [
      'type' => 'flex',
          'altText' => 'もう一度する？',
          'contents' => $arr
  ];

  return $flex;
}
