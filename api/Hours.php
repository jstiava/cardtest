<?php

class Hours {
    // Properties
    public $min = null;
    public $breaks = [];
    public $max = null;

    // Methods
    function add($extrema) {
        $start = $extrema[0];
        $end = $extrema[1];

        if ($this->min == null) {
            $this->min = $start;
            $this->breaks = [];
            $this->max = $end;
            return;
        }
    
        array_push($this->breaks, $start, $this->max);
        $this->max = $end;
        return;
    }

}

