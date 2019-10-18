<?php

namespace Tests\Unit;

use Tests\TestCase;
use Sedhossein\Pregex\Pregex;

/**
 * Class PregexTest
 * @package Tests\Unit
 */
final class PregexTest extends TestCase
{
    /**
     * @dataProvider valid_persian_texts
     * @param string $sample_string
     */
    public function test_valid_persian_text($sample_string)
    {
        $this->assertEquals(1, \Tests\Unit\Pregex::is_persian_text($sample_string));
    }


    /**
     * @dataProvider invalid_persian_texts
     * @param $sample_string
     */
    public function test_invalid_persian_text($sample_string)
    {
        $this->assertEquals(0, Pregex::is_persian_text($sample_string));
    }

    /**
     * @return array
     */
    public function valid_persian_texts()
    {
        return [
            ['بسم الله'],
            ['تست با فاصله و نیم‌فاصله '],
            ['تست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟'],
            ['۰۱۲۳۴۵۶۷۸۹ اعدادی فارسی اند'],
            ['٠١٢٣٤٥٦٧٨٩اعدادی عربی-فارسی اند'],
            ['قطعاً همه مئمنیم درّ گران بهاییْ هستندُ جهتِ تستیـ بهتر'],
            ['آمار اختلاص چندین٪ کم شده'],
            ['حروفی همچون ٪هٔيأؤئء'],
            ['ویرگول ها ٪هٔيأؤئء٫٬همراهی '],
            [' + = ! ? /\ , $ '],
            ['گچپژ'],
        ];
    }

    /**
     * @return array
     */
    public function invalid_persian_texts()
    {
        return [
            ['persian'],
            ['تست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ab یالا؟'],
            ['qwتست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟'],
            ['qwتست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟ew'],
            ['1234 اعدادی فارسی اند'],
            ['٠56اعدادی عربی-فارسی اند'],
        ];
    }


    /**
     * testing persian and arabic numbers
     */
    public function test_is_persian_number()
    {
        $falsy_strings = [
            '٢٣٤٥٦٧٨٩ ٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦٧٨٩,٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦٧٨٩.٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦12٧٨٩',
            '٢٣٤٥٦٧٨٩qw',
            'as٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦0٧٨٩',
        ];
        foreach ($falsy_strings as $string)
            $this->assertEquals(Pregex::is_persian_number($string), 0);


        $true_strings = [
            '۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰',
            '۱۲۶۷',
        ];
        foreach ($true_strings as $string)
            $this->assertEquals(Pregex::is_persian_number($string), 1);
    }
}
