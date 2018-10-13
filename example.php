<?php
include 'PDate.php';

$config = [
    'dateTime'  => '2018-10-11',
    'local'     => 'fa_IR',
    'timeZone'  => 'Asia/Tehran',
    'local'     => 'en_US'

];
//or
$config = [
    'y'=>2018,
    'm'=>10,
    'd'=>11,
    'local'     => 'fa_IR',
    'timeZone'  => 'Asia/Tehran',
    'local'     => 'en_US'
];

$pDate = new PDate();
$pDate->setConfig($config);

echo $date->g2p(); //output: 1397-7-19
echo $date->now(); //output: 1397-7-21
