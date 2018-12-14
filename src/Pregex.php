<?php
/**
 * Created by PhpStorm.
 * User: sedhossein
 * Date: 11/21/2018
 * Time: 10:48 AM
 */

namespace Sedhossein\Pregex;


class Pregex
{

    private static $persian_alpha_codepoints = ' \x{0621}-\x{0628}\x{062A}-\x{063A}\x{0641}-\x{0642}\x{0644}-\x{0648}\x{064E}-\x{0651}\x{0655}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06BE}\x{06CC}';
    private static $space_codepoints = ' \x{0020}\x{2000}-\x{200F}\x{2028}-\x{202F}' ;
    private static $persian_num_codepoints = '\x{06F0}-\x{06F9}';
    private static $punctuation_marks_codepoints = '\x{060C}\x{061B}\x{061F}\x{0640}\x{066A}\x{066B}\x{066C}';
    private static $additional_arabic_characters_codepoints = ' \x{0629}\x{0643}\x{0649}-\x{064B}\x{064D}\x{06D5}\x{0647}\x{0654}';
    private static $arabic_numbers_codepoints = '\x{0660}-\x{0669}';
    private static $special_chars = 'اآًَُِّْـ‌»«،؛؟هٔيأؤئء٬٫٪';
    private static $writing_symptoms = '+=!@#$%^&*,،`"';


    public static function get_char_regex()
    {
        return self::combine_regex_exps([
            self::$persian_alpha_codepoints,
            self::$additional_arabic_characters_codepoints
        ]) ;
    }

    public static function get_number_regex()
    {
        return self::combine_regex_exps([
            self::$arabic_numbers_codepoints ,
            self::$persian_num_codepoints
        ]);
    }

    public static function get_text_regex()
    {
        return self::combine_regex_exps([
            self::$persian_alpha_codepoints,
            self::$space_codepoints,
            self::$persian_num_codepoints,
            self::$punctuation_marks_codepoints,
            self::$additional_arabic_characters_codepoints,
            self::$arabic_numbers_codepoints,
            self::$special_chars,
            self::$writing_symptoms,
        ]);
    }


    public static function is_persian_number($number)
    {
        return preg_match(self::get_number_regex(), $number);
    }


    public static function is_persian_text($text)
    {
        return preg_match( self::get_text_regex() , $text);
    }

    public function is_persian_string($string)
    {
        return preg_match( self::get_char_regex(), $string);
    }


    private static function combine_regex_exps($arguments)
    {
        $combined = '/[';

        foreach ($arguments as $argument)
            $combined .= $argument;

        return $combined.']+$/um' ; //support unicode and multi line
    }


}
