<?php
/**
 * PHP PDate library
 * @package PDate
 * @author Mohammad Salehi Koleti
 * @see https://github.com/pars0097/PDate
 * @license https://opensource.org/licenses/lgpl-3.0.html LGPL 3
 */
class PDate
{
    private $config =
        [
        'dateTime' => null,
        'y' => null,
        'm' => null,
        'd' => null,
        'h' => 0,
        'i' => 0,
        's' => 0,
        'inFormat' => 'Y-m-d',
        'outFormat' => 'y-M-d',
        'local' => null,
        'calendar' => 'persian',
        'outTimeZone' => null,
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
                throw new Exception('if you left `$config[\'dateTime\']` null then y, m and d are MUST set');
            }
            //months num starts from 0
            $config['m']--;
            $time = IntlCalendar::createInstance($config['inTimeZone'], "$config[local]@calendar=$baseCalType");
            $time->set((int) $config['y'], (int) $config['m'], (int) $config['d'], (int) $config['h'], (int) $config['i'], (int) $config['s']);
        }
        // var_dump($time);exit();
        if ($time) {
            return $time;
        }
        throw new Exception('invalide date/time entered!');
    }
    public function g2p($config = [])
    {
        $config = array_merge($this->config, $config);
        $time = $this->checkDate($config, 'gregorian');
        $formatter = new IntlDateFormatter($config['local'] . "@calendar={$config['calendar']}", IntlDateFormatter::SHORT, IntlDateFormatter::LONG, $config['outTimeZone'], IntlDateFormatter::TRADITIONAL, $config['outFormat']);
        // $formatter->setPattern($config['outFormat']);
        $time = $formatter->format($time);
        return $time;
    }
    public function p2g($config = [])
    {
        $config = array_merge($this->config, $config);
        $time = $this->checkDate($config, 'persian');
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

    /**
     * @link vtwo.org/1688952
     */
    public function gLeapYear($year)
    {
        if (($year % 4 == 0) and (($year % 100 != 0) or ($year % 400 == 0))) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * @link vtwo.org/1688952
     */
    public function pLeapYear($year)
    {
        $ary = array(1, 5, 9, 13, 17, 22, 26, 30);
        $b = $year % 33;
        if (in_array($b, $ary)) {
            return true;
        }

        return false;
    }

    /**
     * return start and end of each jalali month in gregorian date
     *
     * date can get set in `$config['dateTime']`.
     * if `$tillNow` parameters set to null archive starts from current date.
     *<NOTE>when use $this->p2g it works only if you set $config['y/d/m'] and set $config['dateTime'] to null (its automatic), at the end of method $config['dateTime'] set to previews value</NOTE>
     *
     * @param int $monthNum number of dates to return
     * @param bool $tillNow if `$tillNow = true` last date of archive set to day of current month, esle last day set to the end of current month.
     * if you want to change last date of archive you MUST set `$tillNow = false` AND set value of `$confog['dateTime']`.
     * default: true
     * @param array $config config
     */
    public function pArchive($monthNum, $tillNow = true, $config = [])
    {
        //temporary set $config['dateTime'] to null to avoid bad output from $this->p2g().
        $temp = isset($config['dateTime']) ? $config['dateTime'] : null;
        $config['dateTime'] = null;
        $config = array_merge($this->config, $config);

        $dates = [];
        if ($tillNow) {
            $pY = $this->now(['outFormat' => 'Y']);
            $pM = $this->now(['outFormat' => 'M']);
            $pD = $this->now(['outFormat' => 'd']);

            $startDate = $this->p2g(['y' => $pY, 'm' => $pM, 'd' => 1]);
            $endDate = $this->p2g(['y' => $pY, 'm' => $pM, 'd' => $pD]);
            $dates[] = [$startDate, $endDate, 'year' => (int) $pY, 'month' => (int) $pM];
        } elseif (isset($config['y']) && isset($config['m']) && isset($config['d'])) {
            //$this->setConfig($config);
            $time = $this->checkDate($config, 'persian');

            $pY = $config['y'];
            $pM = $config['m'];
            $pD = $config['d'];

            $startDate = $this->p2g(['y' => $pY, 'm' => $pM, 'd' => 1]);
            $endDate = $this->p2g(['y' => $pY, 'm' => $pM, 'd' => $pD]);
            $dates[] = [$startDate, $endDate, 'year' => (int) $pY, 'month' => (int) $pM];
        } else {
            $pY = $this->now(['outFormat' => 'Y']);
            $pM = $this->now(['outFormat' => 'M']);
            $pM++;
            $monthNum++;
        }
        $monthNum--;
        for ($i = 0; $i < $monthNum; $i++) {
            $pM--;
            if ($pM == 0) {
                $pM = 12;
                $pY--;
            }
            if ($pM >= 1 && $pM <= 6) {
                $pD = 31;
            } elseif ($pM >= 7 && $pM <= 11) {
                $pD = 30;
            } elseif ($pM == 12) {
                $pD = ($this->pLeapYear($pY)) ? 30 : 29;
            }
            $startDate = $this->p2g(['y' => $pY, 'm' => $pM, 'd' => 1]);
            $endDate = $this->p2g(['y' => $pY, 'm' => $pM, 'd' => $pD]);

            $dates[] = [$startDate, $endDate, 'year' => (int) $pY, 'month' => (int) $pM];
        }

        $config['dateTime'] = $temp;
        return $dates;
    }
}
