<?php
function converTime($timestring, $hours = "") {
    if($hours !== "") {
        $time = date('d-m-Y',$timestring)." ".date($hours ,$timestring);
    } else {
        $time = date('d-m-Y', $timestring);
    }
    return $time;
}

function timeAgoInWords($timestring, $timezone = NULL) {
    $timeAgo = new TimeAgo($timezone);

    return $timeAgo->inWords($timestring, "now");
}

//echo timeAgoInWords(converTime("1427771280", "h:i "));


/**
 * This class can help you find out just how much time has passed between
 * two dates.
 *
 * It has two functions you can call:
 * inWords() which gives you the "time ago in words" between two dates.
 * dateDifference() which returns an array of years,months,days,hours,minutes and
 * seconds between the two dates.
 *

 */
class TimeAgo {
    // defines the number of seconds per "unit"
    private $secondsPerMinute = 60;
    private $secondsPerHour = 3600;
    private $secondsPerDay = 86400;
    private $secondsPerMonth = 2592000;
    private $secondsPerYear = 31104000;
    private $timezone;

    public function __construct($timezone = NULL) {
        // if the $timezone is null, we take 'Europe/London' as the default
        // this was done, because the parent construct tossed an exception
        if($timezone == NULL) {
            $timezone = 'Asia/Ho_Chi_Minh';
        }

        $this->timezone = $timezone;
    }

    public function inWords($past, $now = "now") {
        // sets the default timezone
        date_default_timezone_set($this->timezone);
        // finds the past in datetime
        $past = strtotime($past);
        // finds the current datetime
        $now = strtotime($now);

        // creates the "time ago" string. This always starts with an "about..."
        $timeAgo = "";

        // finds the time difference
        $timeDifference = $now - $past;

        // less than 29secs
        if($timeDifference <= 29) {
            $timeAgo = "1 phút trước";
        }
        // more than 29secs and less than 1min29secss
        else if($timeDifference > 29 && $timeDifference <= 89) {
            $timeAgo = "1 phút trước";
        }
        // between 1min30secs and 44mins29secs
        else if($timeDifference > 89 &&
            $timeDifference <= (($this->secondsPerMinute * 44) + 29)
        ) {
            $minutes = floor($timeDifference / $this->secondsPerMinute);
            $timeAgo = $minutes." phút trước";
        }
        // between 44mins30secs and 1hour29mins29secs
        else if(
            $timeDifference > (($this->secondsPerMinute * 44) + 29)
            &&
            $timeDifference < (($this->secondsPerMinute * 89) + 29)
        ) {
            $timeAgo = "1 giờ trước";
        }
        // between 1hour29mins30secs and 23hours59mins29secs
        else if(
            $timeDifference > (
                ($this->secondsPerMinute * 89) +
                29
            )
            &&
            $timeDifference <= (
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                29
            )
        ) {
            $hours = floor($timeDifference / $this->secondsPerHour);
            $timeAgo = $hours." giờ trước";
        }
        // between 23hours59mins30secs and 47hours59mins29secs
        else if(
            $timeDifference > (
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                29
            )
            &&
            $timeDifference <= (
                ($this->secondsPerHour * 47) +
                ($this->secondsPerMinute * 59) +
                29
            )
        ) {
            $timeAgo = "1 ngày trước";
        }
        // between 47hours59mins30secs and 29days23hours59mins29secs
        else if(
            $timeDifference > (
                ($this->secondsPerHour * 47) +
                ($this->secondsPerMinute * 59) +
                29
            )
            &&
            $timeDifference <= (
                ($this->secondsPerDay * 29) +
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                29
            )
        ) {
            $days = floor($timeDifference / $this->secondsPerDay);
            $timeAgo = $days." ngày trước";
        }
        // between 29days23hours59mins30secs and 59days23hours59mins29secs
        else if(
            $timeDifference > (
                ($this->secondsPerDay * 29) +
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                29
            )
            &&
            $timeDifference <= (
                ($this->secondsPerDay * 59) +
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                29
            )
        ) {
            $timeAgo = "1 tháng trước";
        }

        else {

            $timeAgo = converTime($past, "h:i");
        }

        return $timeAgo;
    }

    public function dateDifference($past, $now = "now") {
        // initializes the placeholders for the different "times"
        $seconds = 0;
        $minutes = 0;
        $hours = 0;
        $days = 0;
        $months = 0;
        $years = 0;

        // sets the default timezone
        date_default_timezone_set($this->timezone);

        // finds the past in datetime
        $past = strtotime($past);
        // finds the current datetime
        $now = strtotime($now);

        // calculates the difference
        $timeDifference = $now - $past;

        // starts determining the time difference
        if($timeDifference >= 0) {
            switch($timeDifference) {
                // finds the number of years
                case ($timeDifference >= $this->secondsPerYear):
                    // uses floor to remove decimals
                    $years = floor($timeDifference / $this->secondsPerYear);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference-($years * $this->secondsPerYear);

                // finds the number of months
                case ($timeDifference >= $this->secondsPerMonth && $timeDifference <= ($this->secondsPerYear-1)):
                    // uses floor to remove decimals
                    $months = floor($timeDifference / $this->secondsPerMonth);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference-($months * $this->secondsPerMonth);

                // finds the number of days
                case ($timeDifference >= $this->secondsPerDay && $timeDifference <= ($this->secondsPerYear-1)):
                    // uses floor to remove decimals
                    $days = floor($timeDifference / $this->secondsPerDay);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference-($days * $this->secondsPerDay);

                // finds the number of hours
                case ($timeDifference >= $this->secondsPerHour && $timeDifference <= ($this->secondsPerDay-1)):
                    // uses floor to remove decimals
                    $hours = floor($timeDifference / $this->secondsPerHour);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference-($hours * $this->secondsPerHour);

                // finds the number of minutes
                case ($timeDifference >= $this->secondsPerMinute && $timeDifference <= ($this->secondsPerHour-1)):
                    // uses floor to remove decimals
                    $minutes = floor($timeDifference / $this->secondsPerMinute);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference-($minutes * $this->secondsPerMinute);

                // finds the number of seconds
                case ($timeDifference <= ($this->secondsPerMinute-1)):
                    // seconds is just what there is in the timeDifference variable
                    $seconds = $timeDifference;
            }
        }

        $difference = array(
            "years" => $years,
            "months" => $months,
            "days" => $days,
            "hours" => $hours,
            "minutes" => $minutes,
            "seconds" => $seconds
        );

        return $difference;
    }
}
?>