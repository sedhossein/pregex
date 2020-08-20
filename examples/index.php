<?php

use Sedhossein\Pregex\Pregex;

$arabicNumbers = ["١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩", "٠"];
$persianNumbers = ["۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹", "۰"];

$input = implode("", $arabicNumbers) . ":" . implode("", $persianNumbers);

$result = (new Pregex)->IsPersianNumber($input) ?
    "yes, It's a persian number" :
    "No, It's not a persian number";

var_dump($result);
