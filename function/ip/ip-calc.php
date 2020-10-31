<?php
//テスト用メッセージ
$msg = '192.168.1.10/28';
preg_match('/([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})/',$msg,$ip);

if (preg_match('/([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})\/([0-9]{1,2})/',$msg,$msg_arr)) {
  $mask = $msg_arr[5];
} else {
  require_once(__DIR__.'/mask-q.php');
}

$subnetmask = [];
$subnetmask = array_pad($subnetmask, $mask, 1);
$subnetmask = array_pad($subnetmask, 32, 0);
$subnetmask_arr = str_split(implode("",$subnetmask), 8);

$ip_dec_arr = [str_pad(decbin($ip[1]), 8, '0', STR_PAD_LEFT),str_pad(decbin($ip[2]), 8, '0', STR_PAD_LEFT),str_pad(decbin($ip[3]), 8, '0', STR_PAD_LEFT),str_pad(decbin($ip[4]), 8, '0', STR_PAD_LEFT)];

for ($i=0;$i<4;$i++) {
  $res = $subnetmask_arr[$i] & $ip_dec_arr[$i];
  echo bindec($res);
  if ($i < 3) {
    echo '.';
  }
}