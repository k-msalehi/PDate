<?php
include 'PDate.php';

$config = [
    'dateTime'  => '2018-10-11',
    'local'     => 'fa_IR',
    'inTimeZone'  => 'Asia/Tehran',//if not set it uses your ini gonfig
    'outTimeZone'  => 'Asia/Tehran',//if not set it uses your ini gonfig
    'local'     => 'en_US'

];
//or
$config = [
    'y'=>2018,
    'm'=>10,
    'd'=>11,
    'local'     => 'fa_IR',//if not set it uses your ini gonfig
    'inTimeZone'  => 'Asia/Tehran',//if not set it uses your ini gonfig
    'outTimeZone'  => 'Asia/Tehran',//if not set it uses your ini gonfig
];

$pDate = new PDate();
$pDate->setConfig($config);

echo $date->g2p(); //output: 1397-7-19
echo $date->now(); //output: 1397-7-21
