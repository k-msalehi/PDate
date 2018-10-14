<?php
class PDate
{
    private $config =
        [
        'dateTime'    => null,
        'y'           => null,
        'm'           => null,
        'd'           => null,
        'h'           => 0,
        'i'           => 0,
        's'           => 0,
        'inFormat'    => 'Y-m-d',
        'outFormat'   => 'y-M-d',
        'local'       => null,
        'calendar'    => 'persian',
        'outTimeZone'  => null,
    ];

    public function __construct()
    {
        $this->config['inTimeZone'] = date_default_timezone_get();

    }

    public function setConfig($config)
    {
        $this->config = array_merge($this->config, $config);
    }

    public function checkDate($config, $baseCalType)
    {
        if (isset($config['dateTime'])) {
            $time = DateTime::createFromFormat($config['inFormat'], $config['dateTime'], new DateTimeZone($config['inTimeZone']));
        } else {
            if (empty($config['y']) || empty($config['m']) || empty($config['d'])) {
                throw new Exception("y, m and d are required parameters");
            }
            //months num starts from 0
            $config['m'] = $config['m'] - 1;

            $time = IntlCalendar::createInstance($config['inTimeZone'], "$config[local]@calendar=$baseCalType");

            $time->set($config['y'], $config['m'], $config['d'], $config['h'], $config['i'], $config['s']);
        }

        return $time;

    }

    public function g2p($config = [])
    {
        $config = array_merge($this->config, $config);
        $time   = $this->checkDate($config, 'gregorian');

        $formatter = new IntlDateFormatter($config['local'] . "@calendar={$config['calendar']}", IntlDateFormatter::SHORT, IntlDateFormatter::LONG, $config['outTimeZone'], IntlDateFormatter::TRADITIONAL, $config['outFormat']);

        // $formatter->setPattern($config['outFormat']);
        $time = $formatter->format($time);
        return $time;
    }

    public function p2g($config = [])
    {
        $config = array_merge($this->config, $config);
        $time   = $this->checkDate($config, 'persian');

        $formatter = new IntlDateFormatter($config['local'] . "@calendar={$config['calendar']}", IntlDateFormatter::FULL, IntlDateFormatter::FULL, $config['outTimeZone'], IntlDateFormatter::GREGORIAN, $config['outFormat']);

        //$formatter->setPattern($config['outFormat']);
        $time = $formatter->format($time);

        return $time;
    }

    public function now($config = [])
    {
        $config = array_merge($this->config, $config);

        $time = IntlCalendar::createInstance($config['outTimeZone'], 'fa_IR');

        $time = IntlDateFormatter::formatObject($time, $config['outFormat'], $config['local']);

        return $time;
    }
}
