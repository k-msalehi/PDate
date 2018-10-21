# PDate
working with Persian (Jalali) date using php intl extension 

what PDate can do?
* convert gregorian to persian date
* convert persian to gregorian date
* get current persian date

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

possible `outFormat` values are documented at
[http://userguide.icu-project.org/formatparse/datetime](http://userguide.icu-project.org/formatparse/datetime).

`inFormat` is only available when you set `dateTime` parameter.

possible `inFormat` values are documented at
[http://uk3.php.net/manual/en/function.date.php](http://uk3.php.net/manual/en/function.date.php).
