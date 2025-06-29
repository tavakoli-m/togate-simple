<?php

use Morilog\Jalali\Jalalian;

function convertPersianToEnglish(string $number) : string
{
    $number = str_replace('۰', '0', $number);
    $number = str_replace('۱', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);
    return $number;
}


function convertEnglishToPersian(string $number) : string
{
    $number = str_replace('0', '۰', $number);
    $number = str_replace('1', '۱', $number);
    $number = str_replace('2', '۲', $number);
    $number = str_replace('3', '۳', $number);
    $number = str_replace('4', '۴', $number);
    $number = str_replace('5', '۵', $number);
    $number = str_replace('6', '۶', $number);
    $number = str_replace('7', '۷', $number);
    $number = str_replace('8', '۸', $number);
    $number = str_replace('9', '۹', $number);
    return $number;
}

function convertPhoneNumber(int|string|null $number) : int|string|null
{
    if (!$number) {
        return null;
    }

    $number = convertPersianToEnglish($number);

    if ($number[0] == "0") {
        $number = substr($number, 1, 10);
    }
    return $number;
}

function jalaliDate($date, $format = '%A, %d %B %y')
{
    $date = Jalalian::forge($date)->format($format);
    return $date;
}
