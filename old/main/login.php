<?php
$set = 'mysql:host=mysql1017.db.sakura.ne.jp;dbname=oity_data;charset=utf8';
$user = 'oity';
$password = '1999-1111';
try {
    $dbh = new PDO($set,$user,$password);
} catch (PDOException $e) {
    echo 'Can not access database!!';
    exit;
}