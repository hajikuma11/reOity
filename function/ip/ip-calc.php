<?php
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


$network_addr_arr = [];
$broadcast_addr_arr = [];
for ($i=0;$i<4;$i++) {
  $res_net = $subnetmask_arr[$i] & $ip_dec_arr[$i];
  $hanten = substr(decbin(~bindec($subnetmask_arr[$i])), -8);
  $network_addr_arr[] = bindec($res_net);
  $broadcast_addr_arr[] = bindec($hanten | $ip_dec_arr[$i]);
}

$net_dec = '0b';
$broad_dec = '0b';
for ($i=0;$i<4;$i++) {
  $net_dec .= str_pad(decbin($network_addr_arr[$i]), 8, '0', STR_PAD_LEFT);
  $broad_dec .= str_pad(decbin($broadcast_addr_arr[$i]), 8, '0', STR_PAD_LEFT);
}

$host_a = bindec($net_dec);
$host_b = bindec($broad_dec);
$bit = 0b1;
$a_arr = str_split(decbin($host_a + $bit),8);
$b_arr = str_split(decbin($host_b - $bit),8);

$a_str = '';
$b_str = '';
for ($i=0;$i<4;$i++) {
  $a_str .= bindec($a_arr[$i]).'.';
  $b_str .= bindec($b_arr[$i]).'.';
}
$host_arr = [rtrim($a_str,'.'), rtrim($b_str,'.')];

require_once('createResult.php');
require_once(__DIR__.'/../back/back.php');

$addr_class_arr = ['A','B','C','D(IPマルチキャスト用)','E(実験用)'];
$flex_main = createFlex($ip[0],$mask,implode(".",$network_addr_arr),$host_arr,implode(".",$broadcast_addr_arr),$addr_class_arr[strpos($ip_dec_arr[0],'0')]);
$flex_back = back();

$content_reply = [
  'replyToken' => $token_reply,
  'messages' => [$flex_main, $flex_back]
];
