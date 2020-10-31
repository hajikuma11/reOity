<?php
//テスト用メッセージ
$msg = '224.168.1.10/28';
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


$network_addr_arr = [];
$broadcast_addr_arr = [];
for ($i=0;$i<4;$i++) {
  $res_net = $subnetmask_arr[$i] & $ip_dec_arr[$i];
  $hanten = substr(decbin(~bindec($subnetmask_arr[$i])), -8);
  $network_addr_arr[] = bindec($res_net);
  $broadcast_addr_arr[] = bindec($hanten | $ip_dec_arr[$i]);
}

echo 'NetworkAddress:'.implode(".",$network_addr_arr);
echo "\n";
echo 'BroadcastAddress:'.implode(".",$broadcast_addr_arr);
echo "\n";
echo "Subnets:".(2**(32-$mask));
echo "\n";
$addr_class_arr = ['A','B','C','D(IPマルチキャスト用)','E(実験用)'];
echo "AddressClass:".$addr_class_arr[strpos($ip_dec_arr[0],'0')];