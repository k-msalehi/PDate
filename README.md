# PDate
working with Persian ((Jalali) or (Shamsi)) date using php intl extension 

what PDate can do?
* convert Gregorian to persian date
* convert Persian to gregorian date
* get current Persian date
* check Persian leap year
* check Gregorian leap year
* get start and end of each Persian month in gregorian date (used for Jalali/Persian archive or monthly report)

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
`null` values replace with ini default values.

**priority of input date is with `dateTime` in `$config` `parameters`, it means if you set `dateTime`, then `y`, `m`, `d` have no affect**

`inFormat` is only available when you set `dateTime` parameter.

possible `outFormat` values are documented at
[http://userguide.icu-project.org/formatparse/datetime](http://userguide.icu-project.org/formatparse/datetime).

possible `inFormat` values are documented at
[http://uk3.php.net/manual/en/function.date.php](http://uk3.php.net/manual/en/function.date.php).
