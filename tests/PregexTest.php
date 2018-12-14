<?php

namespace Tests\Unit;

use Tests\TestCase;
use Sedhossein\Pregex\Pregex;

final class PregexTest extends TestCase
{
    /**
     * A basic test .
     * @return void
     */
    public function testIs_persian_text()
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
            $this->assertEquals(Pregex::is_persian_text($string),1);

    }

//    public function test_helper()
//    {
//        $this->assertTrue(true);
//    }

}
