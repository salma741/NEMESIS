<?php

function NumberFormat($number)
{
    return number_format($number, 0,',','.');
}

function DateFormat($date, $Format = "D-M-Y H:m:s"){
    return \Carbon\Carbon::parse($date)->isoFormat($Format);
}