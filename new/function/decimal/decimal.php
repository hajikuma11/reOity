<?php
$val_arr = explode('=',$msg);
$base = (int)$val_arr[0];
$num = (int)$val_arr[1];

require_once('createJson.php');