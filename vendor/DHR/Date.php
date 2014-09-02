<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-19
 * Time: 下午2:52
 */

namespace DHR;


class Date {

    public function differDate($from, $to)
    {
        $fromTimeStamp = strtotime($from);
        $toTimeStamp = strtotime($to);
        $differTimeStamp = $toTimeStamp - $fromTimeStamp;
        $differDays = $differTimeStamp/60/60/24;
        $differYears = floor($differDays/365);
        $differMonth = floor(($differDays/31)) - $differYears*12;
        $differDays = $differDays - ($differYears*365 + $differMonth*31);

        if($differYears==1)
            return $differYears . " year ago";
        else if ($differYears>1)
            return $differYears . " years ago";
        else if($differMonth == 1)
            return $differMonth. " month ago";
        else if($differMonth >1)
            return $differMonth . " months ago";
        else if($differDays == 1)
            return $differDays . " day ago";
        else if($differDays >1)
            return $differDays . " days ago";
        else
            return "";

    }
} 