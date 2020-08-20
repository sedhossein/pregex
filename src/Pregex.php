<?php
/**
 * Created by PhpStorm.
 * User: sedhossein
 * Date: 11/21/2018
 * Time: 10:48 AM
 */

namespace Sedhossein\Pregex;

use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class Pregex
 * Collection of Regex for validating, filtering, sanitizing and finding Persian strings
 * @package Sedhossein\Pregex
 */
class Pregex implements PersianValidator
{
    /**
     * Persian numbers
     * @var string
     */
    private static $persian_number_codepoints = '\x{06F0}-\x{06F9}';

    /**
     * Arabic numbers
     * @var string
     */
    private static $arabic_numbers_codepoints = '\x{0660}-\x{0669}';

    private static $banks_names = [
        'bmi' => '603799',
        'banksepah' => '589210',
        'edbi' => '627648',
        'bim' => '627961',
        'bki' => '603770',
        'bank-maskan' => '628023',
        'postbank' => '627760',
        'ttbank' => '502908',
        'enbank' => '627412',
        'parsian-bank' => '622106',
        'bpi' => '502229',
        'karafarinbank' => '627488',
        'sb24' => '621986',
        'sinabank' => '639346',
        'sbank' => '639607',
        'shahr-bank' => '502806',
        'bank-day' => '502938',
        'bsi' => '603769',
        'bankmellat' => '610433',
        'tejaratbank' => '627353',
        'refah-bank' => '589463',
        'ansarbank' => '627381',
        'mebank' => '639370',
        'resalat' => '504172',
    ];

    public function IsPersianNumber(string $number): bool
    {
        return preg_match("/(^[" . self::$persian_number_codepoints . "]+$)/u", $number);
    }

    public function IsArabicNumber(string $number): bool
    {
        return preg_match("/(^[" . self::$arabic_numbers_codepoints . "]+$)/u", $number);
    }

    public function IsPersianOrArabicNumber(string $number): bool
    {
        return preg_match("/(^[" .
            self::$arabic_numbers_codepoints .
            self::$persian_number_codepoints .
            "]+$)/u", $number);
    }

    public function IsEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function IsCellphone(string $number): bool
    {
        return preg_match('/^(^((98)|(\+98)|0)?(9){1}[0-9]{9})+$/', $number);
    }

    public function IsIban(string $value): bool
    {
        if (empty($value)) {
            return false;
        }

        $ibanReplaceValues = [];
        $value = preg_replace('/[\W_]+/', '', strtoupper($value));
        if ((4 > strlen($value) || strlen($value) > 34) || (is_numeric($value [0]) || is_numeric($value [1])) || (!is_numeric($value [2]) || !is_numeric($value [3]))) {
            return false;
        }

        $ibanReplaceChars = range('A', 'Z');
        foreach (range(10, 35) as $tempvalue) {
            $ibanReplaceValues[] = strval($tempvalue);
        }

        $tmpIBAN = substr($value, 4) . substr($value, 0, 4);
        $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);
        $tmpValue = intval(substr($tmpIBAN, 0, 1));
        for ($i = 1; $i < strlen($tmpIBAN); $i++) {
            $tmpValue *= 10;
            $tmpValue += intval(substr($tmpIBAN, $i, 1));
            $tmpValue %= 97;
        }

        return $tmpValue != 1 ? false : true;
    }

    public function IsNationalCode(string $value): bool
    {
        if (
            preg_match('/^\d{8,10}$/', $value) == false ||
            preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)
        ) {
            return false;
        }

        $sub = 0;
        switch (strlen($value)) {
            case 8:
                $value = '00' . $value;
                break;
            case 9:
                $value = '0' . $value;
                break;
        }

        for ($i = 0; $i <= 8; $i++) {
            $sub = $sub + ($value[$i] * (10 - $i));
        }

        $control = ($sub % 11) < 2 ? $sub % 11 : 11 - ($sub % 11);

        return $value[9] == $control ? true : false;
    }

    public function IsCardNumber(string $value): bool
    {
        if (!preg_match('/^\d{16}$/', $value) || !in_array(substr($value, 0, 6), static::$banks_names)) {
            return false;
        }

        $sum = 0;
        for ($position = 1; $position <= 16; $position++) {
            $temp = $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }

        return $sum % 10 === 0;
    }

    public function IsPostalCode(string $value): bool
    {
        return preg_match("/^(\d{5}-?\d{5})$/", $value);
    }

    public function IsPersian(string $value): bool
    {
        return preg_match("/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\x{002E}\s]+$/u", $value);
    }
}