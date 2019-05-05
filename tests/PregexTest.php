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
     * A basic test .
     * @return void
     */
    public function test_is_persian_text()
    {
        $sample_strings = [
            'بسم الله',
            'تست با فاصله و نیم‌فاصله ',
            'تست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟',
            '۰۱۲۳۴۵۶۷۸۹ اعدادی فارسی اند',
            '٠١٢٣٤٥٦٧٨٩اعدادی عربی-فارسی اند',
            'قطعاً همه مئمنیم درّ گران بهاییْ هستندُ جهتِ تستیـ بهتر',
            'آمار اختلاص چندین٪ کم شده',
            'گچپژ',
            'حروفی همچون ٪هٔيأؤئء',
            'ویرگول ها ٪هٔيأؤئء٫٬همراهی ',
            ' + = ! ? /\ , $ ',
        ];
        foreach ($sample_strings as $string)
            $this->assertEquals(Pregex::is_persian_text($string), 1);
    }


    /**
     * Test For Just Persian Numbers ( Not Arabic )
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