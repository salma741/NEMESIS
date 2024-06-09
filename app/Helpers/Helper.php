<?php

function NumberFormat($number)
{
    return number_format($number, 0,',','.');
}

function DateFormat($date, $Format = "DD-MMMM-Y H:m:s"){
    return \Carbon\Carbon::parse($date)->isoFormat($Format);
}

function AddDay($date, $days){
    $carbonObject = \Carbon\Carbon::parse($date);
    
    return $carbonObject->addDays($days);

}
