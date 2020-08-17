<?php
/**
 * Created by PhpStorm.
 * User: sedhossein
 * Date: 11/21/2018
 * Time: 10:48 AM
 */

namespace Sedhossein\Pregex;

/**
 * Class Pregex
 * Collection of Regex for validating, filtering, sanitizing and finding Persian strings
 * @package Sedhossein\Pregex
 */
class Pregex
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

    /**
     * Persian Alphabet
     * @var string
     */
    private static $persian_alpha_codepoints = ' \x{0621}-\x{0628}\x{062A}-\x{063A}\x{0641}-\x{0642}\x{0644}-\x{0648}\x{064E}-\x{0651}\x{0655}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06BE}\x{06CC}';

    /**
     * This ranges include all kind of space,
     * specially ZERO WIDTH NON-JOINER that use as half space
     * and massively are using in Persian texts
     * and NARROW NO-BREAK SPACE that is similar to previous character.
     * @var string
     */
    private static $space_codepoints = ' \x{0020}\x{2000}-\x{200F}\x{2028}-\x{202F}';

    /**
     * Persian(Arabic) punctuation marks
     * @var string
     */
    private static $punctuation_marks_codepoints = '\x{060C}\x{061B}\x{061F}\x{0640}\x{066A}\x{066B}\x{066C}';

    /**
     * Most used Arabic characters in Persian texts.
     * @var string
     */
    private static $additional_arabic_characters_codepoints = ' \x{0629}\x{0643}\x{0649}-\x{064B}\x{064D}\x{06D5}\x{0647}\x{0654}';

    /**
     * Some Chars That They Are Not Exists In Above Limit Uni-Codes
     * @var string
     */
    private static $special_chars = 'اآًَُِّْـ‌»«،؛؟هٔيأؤئء٬٫٪';

    /**
     * Writing Symptoms Characters
     * @var string
     */
    private static $writing_symptoms = '؟+=!@#$%^&*,،`"';

    /**
     *  Check The All Conditions For An Persian/Arabic Texts,
     *  Like: numbers, alphabets, marks, symptoms and so on ...
     * @return string
     */
    protected static function get_text_regex(): string
    {
        return self::combine_regex_exps([
            self::$persian_alpha_codepoints,
            self::$space_codepoints,
            self::$persian_number_codepoints,
            self::$punctuation_marks_codepoints,
            self::$additional_arabic_characters_codepoints,
            self::$arabic_numbers_codepoints,
            self::$special_chars,
            self::$writing_symptoms,
        ]);
    }

    /**
     * Validate Persian Number
     * @param $number
     * @return bool
     */
    public function IsPersianNumber(string $number): bool
    {
        return preg_match("/(^[" . self::$persian_number_codepoints . "]*$)/u", $number);
    }

    /**
     * Validate Arabic Number
     * @param $number
     * @return bool
     */
    public function IsArabicNumber(string $number): bool
    {
        return preg_match("/(^[" . self::$arabic_numbers_codepoints . "]*$)/u", $number);
    }

    public function IsPersianOrArabicNumber(string $number): bool
    {
        return preg_match("/(^[" .
            self::$arabic_numbers_codepoints .
            self::$persian_number_codepoints .
            "]*$)/u", $number);
    }

    /**
     * Validate persian texts with arabic chars
     * @param $string
     * @return boolean
     */
    public static function is_persian_text(string $string): bool
    {
        return preg_match(self::get_text_regex(), $string);
    }

    /**
     * @param $string $email
     * @return boolean
     */
    public function is_valid_email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $number
     * @return bool
     */
    public function is_mobile_number(string $number): bool
    {
        return (
            (bool)preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $number)
            || (bool)preg_match('/^(9){1}[0-9]{9}+$/', $number)
        );
    }

    /**
     * @param $value
     * @return bool
     */
    public function is_valid_sheba($value): bool
    {
        $ibanReplaceValues = [];
        if (!empty($value)) {
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
            if ($tmpValue != 1) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    public function is_melli_code($value): bool
    {
        if (
            preg_match('/^\d{8,10}$/', $value) == false ||
            preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)
        ) {
            return false;
        }
        $sub = 0;
        if (strlen($value) == 8) {
            $value = '00' . $value;
        } elseif (strlen($value) == 9) {
            $value = '0' . $value;
        }
        for ($i = 0; $i <= 8; $i++) {
            $sub = $sub + ($value[$i] * (10 - $i));
        }
        if (($sub % 11) < 2) {
            $control = ($sub % 11);
        } else {
            $control = 11 - ($sub % 11);
        }

        return $value[9] == $control ? true : false;
    }

    /**
     * @param $value
     * @return bool
     */
    public function is_card_number($value): bool
    {
        if (!preg_match('/^\d{16}$/', $value)) {
            return false;
        }
        $sum = 0;
        for ($position = 1; $position <= 16; $position++) {
            $temp = $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }
        return (bool)($sum % 10 === 0);
    }

    /**
     * @param $value
     * @return bool
     */
    public function is_postal_card($value): bool
    {
        return (bool)preg_match("/^(\d{5}-?\d{5})$/", $value);
    }

    /**
     *  Just Check The Persian/Arabic Numbers
     * @return string
     */
    protected static function get_number_regex(): string
    {
        return "/(^[" .
            self::$arabic_numbers_codepoints .
            "]*$|^[" .
            self::$persian_number_codepoints .
            "]*$)/u";
    }

    /**
     * Combine And Join The Multi Regex together For Make Final Regex
     * in PERL Style Regular Expressions Mood
     * @param $arguments
     * @return string
     */
    private static function combine_regex_exps($arguments): string
    {
        $combined = '/[';

        foreach ($arguments as $argument) {
            $combined .= $argument;
        }

        return $combined . ']+$/um'; //support unicode and multi-line
    }
}