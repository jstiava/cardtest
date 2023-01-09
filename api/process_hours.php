<?php

require 'Hours.php';

// Only feed in first two characters

$getDayIndex = array();
$getDayIndex['M'] = 0;
$getDayIndex['Mo'] = 0;
$getDayIndex['Tu'] = 1;
$getDayIndex['W'] = 2;
$getDayIndex['We'] = 2;
$getDayIndex['Th'] = 3;
$getDayIndex['F'] = 4;
$getDayIndex['Fr'] = 4;
$getDayIndex['Sa'] = 5;
$getDayIndex['Su'] = 6;

$days_regex = "/([\w]{2,8})[\s]*[-]?[\s]*([\w]{2,8})?[\s]*:[\s]/";
$hours_regex = "/(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)/";
$split_regex = "/(?:;|\n)+/";
$open_regex = "/([O][\S]*)/";
$closed_regex = "/([C][\S]*)/";
$date_regex = "/(\d{2})[\D](\d{2})[\D](\d{4})/";

function serialize_date($date) {

    $date_regex = $GLOBALS['date_regex'];

    preg_match_all($date_regex, $date, $parts);

    return $parts[3][0] + $parts[2][0] / 100 + $parts[1][0] / 10000;

}

function hour_to_24($hour, $type) {

    $type = @strval($type[0]);
    $type = strtoupper($type);

    $hour = @intval($hour[0]);

    if ($type == "AM" || $type == "A") {
        if ($hour == 12) {
            return 0;
        }

        return $hour;
    }

    if ($type == "PM" || $type == "P") {

      if ($hour == 12) {
        return $hour;
      }
      return $hour + 12;
    }


    return $hour;
};


function adjust_hour($hour) {

    $hour = @intval($hour);

    $hour = $hour - 4;

    if ($hour < 0) {
      $hour = 24 + $hour;
    }
    return $hour;
};

function get_day_range($start, $end) {

    $getDayIndex = $GLOBALS['getDayIndex'];

    if (empty($start)) {
        return false;
    }

    $start = @strval($start[0]);
    $start = substr($start, 0, 2);

    $end = @strval($end[0]);
    $end = substr($end, 0, 2);

    if ($start == "Da") {
        return [0, 6];
    }

    if ($start == "") {
        return false;
    }
    $start = $getDayIndex[$start];

    if ($end == "") {
        return [$start, $start];
    }

    $end = $getDayIndex[$end];
    return [$start, $end];
};

function get_hours_arr($hours) {

    $time_array = array_fill(-1, 24, false);

    $x_hour = hour_to_24($hours[2], $hours[4]);
    $x_adj = adjust_hour($x_hour);
    $x_min = @floatval($hours[3][0]) / 60;
    $y_hour = hour_to_24($hours[5], $hours[7]);
    $y_adj = adjust_hour($y_hour);
    $y_min = @floatval($hours[6][0]) / 60;

    return [$x_adj + $x_min, $y_adj + $y_min];

};

function process_hours($string) {

    $days_regex = $GLOBALS['days_regex'];
    $hours_regex = $GLOBALS['hours_regex'];
    $split_regex = $GLOBALS['split_regex'];
    $open_regex = $GLOBALS['open_regex'];
    $closed_regex = $GLOBALS['closed_regex'];

    if ($string == "") {
        return false;
    }

    // Split string into individual statements
    $strings = preg_split($split_regex, $string);
    $data = array();
    $data[0] = new Hours();
    $data[1] = new Hours();
    $data[2] = new Hours();
    $data[3] = new Hours();
    $data[4] = new Hours();
    $data[5] = new Hours();
    $data[6] = new Hours();


    $i = 0;
    foreach ($strings as $str) {
        preg_match_all($days_regex, $strings[$i], $days);
        preg_match_all($hours_regex, $strings[$i], $hours);
        $open = preg_match($open_regex, $strings[$i]) == 1;
        $closed = preg_match($closed_regex, $strings[$i]) == 1;

        $day_range = get_day_range($days[1], $days[2]);

        if ($day_range == false || $closed) {
            continue;
        }

        if ($open) {
            $data[$i]->add([0, 24]);
            continue;
        }

        $j = intval($day_range[0]);
        $moreToFill = true;
        $extrema = get_hours_arr($hours);
        while ($moreToFill) {

            if ($j == $day_range[1]) {
                $moreToFill = false;
            }
            
            $data[$j]->add($extrema);

            $j++;
            if ($j > 6) {
                $j = 0;
            }
        }

        $i++;
    }

    // set up 7 closed days
    // go through each string

    return $data;
    
};