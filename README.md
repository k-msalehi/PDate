# PDate
Persian (aka Jalali, Shamsi or Hijri Shamsi) calendar library using php intl extension 

what PDate can do?
* convert Gregorian date to persian date
* convert Persian date to gregorian date
* get current Persian date
* check Persian leap year
* check Gregorian leap year
* get start and end of each Persian month in gregorian date (can use for Jalali/Persian archive or monthly report)

default config is
```
[
    'dateTime'  => null,
    'y'         => null,
    'm'         => null,
    'd'         => null,
    'h'         => 0,
    'i'         => 0,
    's'         => 0,
    'inFormat'  => 'Y-m-d',
    'outFormat' => 'y-M-d',
    'local'     => null,
    'calendar'  => 'persian',
    'timeZone'  => null,
];
```

**if you set `dateTime`, then `y`, `m`, `d` have no affect**

`inFormat` is only available when you set value for `dateTime` parameter and use `g2p()` (Gregorian to Persian) method.
if you want to pass date and/or outFormat directy to `g2p()` and `p2g()` you have to use one of following chatecters as delimiter between date, month, day, hour, minute and second:
`-`, `:`, ` `(white space), `/`
examples of acceptable formats:
2018-10-9
2018/5/11 18:30:58
1397/5/11 18:30


you can set `pArchive()` last output date by setting `$tillNow` parameter to `false` and set third argument with date string(`Y-m-d`) or date array `[Y, m,d]` (in Persian date).
by default `$tillNow` is `true`

example:
```php
$pDate = new PDate();
$archive = $pDate->pArchive(3, false, [1397,4,31]); //start of archive is on 1397-1-1, end on 1397-4/31
var_dump($archive);
```
output:
```
array (size=3)
  0 => 
    array (size=4)
      0 => string '2018-6-22' (length=9) //1397-4-1
      1 => string '2018-7-22' (length=9) //1397-4-31
      'year' => int 1397
      'month' => int 4
  1 => 
    array (size=4)
      0 => string '2018-5-22' (length=9) //1397-3-1
      1 => string '2018-6-21' (length=9) //1397-3-31
      'year' => int 1397
      'month' => int 3
  2 => 
    array (size=4)
      0 => string '2018-4-21' (length=9) //1397-2-1
      1 => string '2018-5-21' (length=9) //1397-2-31
      'year' => int 1397
      'month' => int 2
```

possible `outFormat` values are documented at
[https://unicode-org.github.io/icu/userguide/format_parse/datetime/).

possible `inFormat` values are documented at
[http://uk3.php.net/manual/en/function.date.php](http://uk3.php.net/manual/en/function.date.php).
