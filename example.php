<?php
include 'PDate.php';

$config = [
    'dateTime'  => '2018-10-11',
    'local'     => 'fa_IR',//default: php.ini config
    'inTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'outTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'local'     => 'en_US'

];
//or
$config = [
    'y'=>2018,
    'm'=>10,
    'd'=>11,
    'local'     => 'fa_IR',//default: php.ini config
    'inTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'outTimeZone'  => 'Asia/Tehran',//default: php.ini config
];

$pDate = new PDate();
$pDate->setConfig($config);

echo $date->g2p(); //output: 1397-7-19
echo $date->now(); //output: 1397-7-21
