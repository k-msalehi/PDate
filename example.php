<?php
include 'PDate.php';

$config = [
    'dateTime'  => '2018-10-11',
    'local'     => 'en_US',//default: php.ini config
    'inTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'inFormat' => 'Y-m-d',
    'outTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'outFormat' => 'y-M-d'

];
//or
$config = [
    'y'=>2018,
    'm'=>10,
    'd'=>11,
    'local'     => 'en_US',//default: php.ini config
    'inTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'outTimeZone'  => 'Asia/Tehran',//default: php.ini config
    'inFormat' => 'Y-m-d',
    'outFormat' => 'y-M-d'

];

$pDate = new PDate(); //or $pDate = new PDate($config)
$pDate->setConfig($config);

//NOTE: p2g() and g2p() methods aregumants are same
echo $date->g2p(); //output: 1397-7-19 (get date from $config)
echo $date->g2p([2018 , 11 , 10]); //output: 1397-7-19
echo $date->g2p('2018-11-10'); //output: 1397-7-19
echo $date->g2p('2018-11-10', 'y-M-d'); //output: 1397-7-19

echo $date->now(); //output: 1397-7-21
echo $date->now('y-M-d'); //output: 1397-7-21

//an example from pArchive output
var_dump($pDate->pArchive(3));
/**
putput:
array (size=3)
  0 => 
    array (size=4)
      0 => string '2018-10-23' (length=10)
      1 => string '2018-11-9' (length=9)
      'year' => int 1397
      'month' => int 8
  1 => 
    array (size=4)
      0 => string '2018-9-23' (length=9)
      1 => string '2018-10-22' (length=10)
      'year' => int 1397
      'month' => int 7
  2 => 
    array (size=4)
      0 => string '2018-8-23' (length=9)
      1 => string '2018-9-22' (length=9)
      'year' => int 1397
      'month' => int 6
*/

?>
