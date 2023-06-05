<?php

class Hours
{
    // Properties
    public $min = null;
    public $breaks = [];
    public $max = null;

    private function add_helper($value) {

        // Case 1: no start
        if ($this->min == null) {
            $this->min = $value;
            $this->breaks = [];
            $this->max = null;
            return;
        }

        // Case 2: no end
        if ($this->max == null) {
            $this->max = $value;
            return;
        }

        // Case 3: swap max with value
        array_push($this->breaks, $this->max);
        $this->max = $value;
        return;
    }

    // Methods
    function add($extrema)
    {
        foreach ($extrema as $ext) {
            $this->add_helper($ext);
        }
    }

    
}

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
$hours_regex = "/(([\d]{1,2})[:]?([\d]{1,2})?[\s]*([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?[\s]*([\w]{1,2})[\s]*[,]?[\s]*)/";
$split_regex = "/(?:;|\n)+/";
$inner_split_regex = "/(?:,)+/";
$open_regex = "/([O][\S]*)/";
$closed_regex = "/([C][\S]*)/";
$date_regex = "/(\d{2})[\D](\d{2})[\D](\d{4})/";

function serialize_date($date)
{

    $date_regex = $GLOBALS['date_regex'];

    preg_match_all($date_regex, $date, $parts);

    return $parts[3][0] + $parts[2][0] / 100 + $parts[1][0] / 10000;
}

function hour_to_24($hour, $type)
{
        
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


function adjust_hour($hour)
{

    $hour = @intval($hour);

    $hour = $hour - 4;

    if ($hour < 0) {
        $hour = 24 + $hour;
    }
    return $hour;
};

function get_day_range($start, $end)
{

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

function get_hours_arr($hours)
{


    $inner_split_regex = $GLOBALS['inner_split_regex'];
    $hours_regex = $GLOBALS['hours_regex'];

    $final = [];


    $results = preg_split($inner_split_regex, $hours);


    foreach ($results as $result) {
        preg_match_all($hours_regex, $result, $finding);


        $x_hour = hour_to_24($finding[2], $finding[4]);
        $x_adj = adjust_hour($x_hour);
        $x_min = @floatval($finding[3][0]) / 60;

        $y_hour = hour_to_24($finding[5], $finding[7]);
        $y_adj = adjust_hour($y_hour);
        $y_min = @floatval($finding[6][0]) / 60;


        array_push($final, $x_adj + $x_min, $y_adj + $y_min);

    }


    return $final;
};

function process_hours($string)
{

    $days_regex = $GLOBALS['days_regex'];
    $hours_regex = $GLOBALS['hours_regex'];
    $split_regex = $GLOBALS['split_regex'];
    $open_regex = $GLOBALS['open_regex'];
    $closed_regex = $GLOBALS['closed_regex'];

    if ($string == "") {
        return false;
    }

    // Clean for em dashes
    $string = str_replace("–", "-", $string);

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
        
        // Regex expressions
        preg_match_all($days_regex, $str, $days);
        $open = preg_match($open_regex, $str) == 1;
        $closed = preg_match($closed_regex, $str) == 1;

        // Day range
        $day_range = get_day_range($days[1], $days[2]);

        // If closed, don't set
        if ($day_range == false || $closed) {
            continue;
        }

        // If open, add 24 hours
        if ($open) {
            $data[$i]->add([0, 24]);
            continue;
        }

        // Start hours compile
        $j = intval($day_range[0]);
        $moreToFill = true;

        $extrema = get_hours_arr($str);

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

    return $data;
};


function isOpen($object, $hour)
{

     if (!isset($object)) {
          return false;
     }

     if ($object->min === null) {
          return false;
     }

     if ($hour < $object->min) {
          return false;
     }

     $status = true;
     foreach ($object->breaks as $break) {
          if ($hour < $break) {
               return $status;
          }

          $status = !$status;
     }

     if ($hour < $object->max) {
          return true;
     }

     return false;
}


function distance_formula($x, $y)
{
     [$x1, $x2] = $x;
     [$y1, $y2] = $y;

     $value = 0;
     try {
          $value = sqrt(pow($x1 - $y1, 2) + pow($x2 - $y2, 2));
     } catch (Throwable $e) {
          return 10000;
     }

     return $value;
}



function update_merchants() {
     $args = [
          'post_type'   => 'merchants',
          'numberposts' => -1,
     ];
     $posts = get_posts($args);

     foreach ($posts as $post) {
          setup_postdata($post);

          // Update/save the post without making any changes
          wp_update_post(array(
               'ID' => $post->ID,
          ));

          // Reset the post data to ensure other functions/processes work correctly
          wp_reset_postdata();
     }

     return "success";
}