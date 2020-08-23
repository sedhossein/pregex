<?php

use Sedhossein\Pregex\Pregex;

$arabicNumbers = ["١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩", "٠"];
$persianNumbers = ["۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹", "۰"];

$input = implode("", $arabicNumbers) . ":" . implode("", $persianNumbers);
$result = (new Pregex)->IsPersianOrArabicNumber($input) ?
    "Yes, It's a persian or arabic number" : "No, It's not a persian or arabic number";
var_dump($result); // Yes, It's a persian or arabic number

$result = (new Pregex)->IsPersianOrArabicNumber("123456") ?
    "Yes, It's a persian or arabic number" : "No, It's not a persian or arabic number";
var_dump($result); // No, It's not a persian or arabic number

$result = (new Pregex)->IsPersianNumber(implode("", $persianNumbers)) ?
    "Yes, It's a persian number" : "No, It's not a persian number";
var_dump($result); // Yes, It's a persian number

$result = (new Pregex)->IsCellphone("09123456789") ?
    "Yes, It's a persian cellphone" : "No, It's not a persian cellphone";
var_dump($result); // Yes, It's a persian cellphone

$result = (new Pregex)->IsPersianText("سد حسین هستم") ?
    "Yes, It's a persian text" : "No, It's not a persian text";
var_dump($result); // Yes, It's a persian text
